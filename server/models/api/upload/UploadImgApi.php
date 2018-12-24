<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/16
 * Time: 11:43
 */
namespace app\models\api\upload;

use app\componments\utils\ApiException;

class UploadImgApi
{
    private $_maxsize='10';  //mb
    private $_allow_ext=['jpg','jpeg','png','bmp','gif'];

    private $_ext;

    /**
     * @return mixed
     */
    public function getExt()
    {
        return $this->_ext;
    }

    /**
     * @param mixed $ext
     */
    public function setExt($ext)
    {
        $this->_ext = $ext;
    }
    private $_dir;
    private $_filename;

    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->_dir;
    }

    /**
     * @param mixed $dir
     */
    public function setDir($dir)
    {
        $this->_dir = $dir;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->_filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->_filename = $filename;
    }

    /**
     * @return string
     */
    public function getMaxsize()
    {
        return $this->_maxsize;
    }

    /**
     * @param string $maxsize
     */
    public function setMaxsize($maxsize)
    {
        $this->_maxsize = $maxsize;
    }

    /**
     * @return array
     */
    public function getAllowExt()
    {
        return $this->_allow_ext;
    }

    /**
     * @param array $allow_ext
     */
    public function setAllowExt($allow_ext)
    {
        $this->_allow_ext = $allow_ext;
    }


    public function before(){
        if(!is_dir(IMG_PATH.$this->getDir())){
            mkdir(IMG_PATH.$this->getDir());
        }

        if(!isset($_FILES)){
            ApiException::run("上传错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }
        $arr=explode('/',$_FILES['file']['type']);
        if(!in_array($arr[1],$this->getAllowExt())){
            ApiException::run("格式错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }
        $this->setExt($arr[1]);

        $size=$_FILES['file']['size'];
        $mb=$size/1024/1024;

        if($mb>$this->getMaxsize()){
            ApiException::run("超过文件最大限制",'900001',__CLASS__,__METHOD__,__LINE__);
        }


    }

    public function run(){
        $this->before();

        move_uploaded_file($_FILES['file']['tmp_name'],IMG_PATH.$this->getDir().'/'.$this->getFilename().'.'.$this->getExt());

    }

    public function getFullPath(){
        return \Yii::$app->params['img_path'].$this->getDir().'/'.$this->getFilename().'.'.$this->getExt();
    }

    public function getFileNameWithExt(){
        return $this->getFilename().'.'.$this->getExt();
    }

}
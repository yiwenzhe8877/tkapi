<?php

namespace app\componments\image;


class MyImage {

    /**
     * @param string $backgroundImage  背景图（本地）
     * @param string $smallImage       小图（本地）
     * @param int $smallX              小图相对于背景图x轴位移
     * @param int $smallY              小图相对于背景图Y轴位移
     * @param string $output_path      输出图片的路径
     * @param string $output_filename  输出图片的名字
     * @return array
     */
    public function bindImages($backgroundImage='',$smallImage='',$smallX=0,$smallY=0,$output_path='',$output_filename='',$small_offsetX=0,$small_offsety=0)
    {
        if(empty($backgroundImage) || empty($smallImage))
        {
            return array('result'=>"fail",'msg'=>"图片参数为空");
        }

        if(empty($small_offsetX))
        {
            $small_offsetX=0;
        }
        if(empty($small_offsety))
        {
            $small_offsety=0;
        }

        if(empty($output_path))
        {
            $output_path='./';
        }
        if(empty($output_filename))
        {
            $output_filename=md5(time()).'.png';
        }
        //背景图片和小图的扩展
        $backgroundImage_arr = getimagesize($backgroundImage);

        $backgroundimg_mime =$backgroundImage_arr['mime'];

        switch ($backgroundimg_mime)
        {
            case 'image/gif':
                $backgroundimg_ext='gif';
                break;
            case 'image/jpeg':
                $backgroundimg_ext='jpg';
                break;
            case 'image/png':
                $backgroundimg_ext='png';
                break;
            default:
                $backgroundimg_ext='';
                break;
        }
        if(empty($backgroundimg_ext))
        {
            return ;
        }

        $smallImage_arr = getimagesize($smallImage);

        $smallImage_mime =$smallImage_arr['mime'];

        switch ($smallImage_mime)
        {
            case 'image/gif':
                $smallImage_ext='gif';
                break;
            case 'image/jpeg':
                $smallImage_ext='jpg';
                break;
            case 'image/png':
                $smallImage_ext='png';
                break;
            default:
                $smallImage_ext='';
                break;
        }
        if(empty($smallImage_ext))
        {
            return ;
        }


        switch($smallImage_ext)
        {
            case 'png':
                $smallImage_1 = imagecreatefrompng($smallImage);
                break;
            case 'jpg':
                $smallImage_1 = imagecreatefromjpeg($smallImage);
                break;
            case 'gif':
                $smallImage_1 = imagecreatefromgif($smallImage);
                break;
        }



        switch($backgroundimg_ext)
        {
            case 'png':
                $backgroundImage_1 = imagecreatefrompng($backgroundImage);
                break;
            case 'jpg':
                $backgroundImage_1 = imagecreatefromjpeg($backgroundImage);
                break;
            case 'gif':
                $backgroundImage_1 = imagecreatefromgif($backgroundImage);
                break;
        }

        //imagecreatefrompng()：创建一块画布，并从 PNG 文件或 URL 地址载入一副图像
        /*  $image_1 = imagecreatefromjpeg($backgroundImage);


          $image_2 = imagecreatefromjpeg($smallImage);*/

        $backgroundImage_3 = imageCreatetruecolor(imagesx($backgroundImage_1),imagesy($backgroundImage_1));

        $color = imagecolorallocatealpha($backgroundImage_3, 0, 0, 0,127);

        imagefill($backgroundImage_3, 0, 0, $color);
        imageColorTransparent($backgroundImage_3, $color);

        imagecopyresampled($backgroundImage_3,$backgroundImage_1,0,0,0,0,imagesx($backgroundImage_1),imagesy($backgroundImage_1),imagesx($backgroundImage_1),imagesy($backgroundImage_1));

        imagecopymerge($backgroundImage_3,$smallImage_1, $smallX,$smallY,0,0,imagesx($smallImage_1),imagesy($smallImage_1), 100);

        switch($backgroundimg_ext)
        {
            case 'png':
                $result=imagepng($backgroundImage_3, $output_path.$output_filename);

                break;
            case 'jpg':
                $result=imagejpeg($backgroundImage_3, $output_path.$output_filename);

                break;
            case 'gif':
                $result=imagegif($backgroundImage_3, $output_path.$output_filename);
                break;
        }



        if($result==true)
        {
            return array('result'=>"success",'msg'=>"合成成功",'imgurl'=>$output_path.$output_filename);
        }
        else
        {
            return array('result'=>"fail",'msg'=>"合成失败");
        }
    }


    function resize_image($img_src, $new_img_path, $new_width, $new_height)
    {
        $img_info = @getimagesize($img_src);
        if (!$img_info || $new_width < 1 || $new_height < 1 || empty($new_img_path)) {
            return false;
        }
        if (strpos($img_info['mime'], 'jpeg') !== false) {
            $pic_obj = imagecreatefromjpeg($img_src);
        } else if (strpos($img_info['mime'], 'gif') !== false) {
            $pic_obj = imagecreatefromgif($img_src);
        } else if (strpos($img_info['mime'], 'png') !== false) {
            $pic_obj = imagecreatefrompng($img_src);
        } else {
            return false;
        }
        $pic_width = imagesx($pic_obj);
        $pic_height = imagesy($pic_obj);
        if (function_exists("imagecopyresampled")) {
            $new_img = imagecreatetruecolor($new_width,$new_height);
            imagecopyresampled($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
        } else {
            $new_img = imagecreate($new_width, $new_height);
            imagecopyresized($new_img, $pic_obj, 0, 0, 0, 0, $new_width, $new_height, $pic_width, $pic_height);
        }
        if (preg_match('~.([^.]+)$~', $new_img_path, $match)) {
            $new_type = strtolower($match[1]);
            switch ($new_type) {
                case 'jpg':
                    imagejpeg($new_img, $new_img_path);
                    break;
                case 'gif':
                    imagegif($new_img, $new_img_path);
                    break;
                case 'png':
                    imagepng($new_img, $new_img_path);
                    break;
                default:
                    imagejpeg($new_img, $new_img_path);
            }
        } else {
            imagejpeg($new_img, $new_img_path);
        }
        imagedestroy($pic_obj);
        imagedestroy($new_img);
        return true;
    }

    //添加文字
    public function bindText($pic_path,$dis_path,$text,$offsetX,$offsetY,$ttf,$fontsize,$red,$green,$blue){

        $backgroundImage_arr = getimagesize($pic_path);

        $ext =$backgroundImage_arr['mime'];

        switch ($ext)
        {
            case 'image/gif':
                $ext='gif';
                break;
            case 'image/jpeg':
                $ext='jpg';
                break;
            case 'image/png':
                $ext='png';
                break;
            default:
                $ext='';
                break;
        }
        switch($ext)
        {
            case 'png':
                $img = imagecreatefrompng($pic_path);
                break;
            case 'jpg':
                $img = imagecreatefromjpeg($pic_path);
                break;
            case 'gif':
                $img = imagecreatefromgif($pic_path);
                break;
        }

        $black = imagecolorallocate($img, $red, $green, $blue);

        imagettftext($img, $fontsize, 0,$offsetX , $offsetY, $black, $ttf, $text);

        switch ($ext) {
            case 'jpg':
                imagejpeg($img, $dis_path);
                break;
            case 'gif':
                imagegif($img, $dis_path);
                break;
            case 'png':
                imagepng($img, $dis_path);
                break;
            default:
        }

        imagedestroy($img);
    }


    //保存远程图片到本地
    function saveRemoteImgToLocal($url,$save_dir='',$filename='',$type=0){
        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
            $filename=time().$ext;
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        //获取远程文件所采用的方法
        if($type){
            $ch=curl_init();
            $timeout=5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $img=curl_exec($ch);
            curl_close($ch);
        }else{
            ob_start();
            readfile($url);
            $img=ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
        $fp2=@fopen($save_dir.$filename,'a');
        fwrite($fp2,$img);
        fclose($fp2);
        unset($img,$url);
        return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
    }


}
?>
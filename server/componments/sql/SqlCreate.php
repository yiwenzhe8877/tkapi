<?php

namespace app\componments\sql;

use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\componments\utils\Filter;

class SqlCreate
{
    private  $_map=[
        "tkuser_base"=>'app\models\tkuser\base',
        "tkuser_withdrawlog"=>'app\models\tkuser\withdrawlog',

    ];
    private $_tableName='';
    private $_data=[];
    private $_coverData=[];
    private $_unsavefields=[];

    /**
     * @return array
     */
    public function getUnsavefields()
    {
        return $this->_unsavefields;
    }

    /**
     * @param array $unsavefields
     */
    public function setUnsavefields($unsavefields)
    {
        $this->_unsavefields = $unsavefields;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->_map;
    }

    /**
     * @param array $map
     */
    public function setMap($map)
    {
        $this->_map = $map;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }



    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->_data = $data;
    }

    /**
     * @return array
     */
    public function getCoverData()
    {
        return $this->_coverData;
    }

    /**
     * @param array $coverData
     */
    public function setCoverData($coverData)
    {
        $this->_coverData = $coverData;
    }


    /*
     * @param model在上面的map中
     * @param id 0表示新增 其他为更新
     * @param id 0表示新增 其他为更新
     *
     * */
    public  function run(){
       // Assert::isEmpty(['表名'=>$this->getTableName(),'数据'=>$this->getData()]);

        $clz=$this->getMap()[$this->getTableName()];

        $model=new $clz();

        foreach ($this->getData() as $k=>$v){
            if(in_array($k,$this->getUnsavefields())){
                continue;
            }

            $model->$k=Filter::sqlinject($v);
        }

        foreach ($this->getCoverData() as $m=>$n){
            $model->$m=Filter::sqlinject($n);
        }

        return $model->save();
    }
}
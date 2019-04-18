<?php

namespace app\componments\sql;

use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\componments\utils\DateUtils;
use app\componments\utils\Filter;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 21:56
 */

class SqlGet
{

    private $_fields='';
    private $_tableName='';
    private $_where=[];
    private $_orderBy='';

    private $_pageNum;

    /**
     * @return mixed
     */
    public function getPageNum()
    {
        return $this->_pageNum;
    }

    /**
     * @param mixed $pageNum
     */
    public function setPageNum($pageNum)
    {
        $this->_pageNum = $pageNum;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->_fields;
    }

    /**
     * @param mixed $fields
     */
    public function setFields($fields)
    {
        $this->_fields = $fields;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * @param mixed $tableName
     */
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getWhere()
    {
        return $this->_where;
    }

    /**
     * @param mixed $where
     */
    public function setWhere($where)
    {
        $this->_where = $where;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->_orderBy;
    }

    /**
     * @param mixed $orderBy
     */
    public function setOrderBy($orderBy)
    {
        $this->_orderBy = $orderBy;
    }


    public  function get_list(){
        $pagesize=\Yii::$app->params['page_size'];



        Assert::isNotPageNum($this->getPageNum());
        Assert::isEmpty(['表名'=>$this->getTableName()]);


        if($this->getFields()==''){
            $this->setFields("*");
        }



        $sql="select ".$this->getFields()." from ".\Yii::$app->params['table_prefix'].$this->getTableName();


        if(count($this->getWhere())>0){
            $sql.=' where ';
            foreach ($this->getWhere() as $k=>$v){
                $sql.=Filter::sqlinject($k).'"'.Filter::sqlinject($v).'"';
            }
        }


        if($this->getOrderBy()!=''){
            $sql.=' order By '.$this->getOrderBy();
        }
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        $count=count($result);

        $sql.=' limit '.($this->getPageNum()-1)*($pagesize).','.($pagesize);



        $command = $connection->createCommand($sql);
        $result = $command->queryAll();


        return [
            'page'=>$this->getPageNum(),
            'pageSize'=>$pagesize,
            'total'=>$count,
            'list'=>$result
        ];


    }
    public  function get_all(){


        if($this->getFields()==''){
            $this->setFields("*");
        }


        Assert::isEmpty(['表名'=>$this->getTableName()]);

        $sql="select ".$this->getFields()." from ".\Yii::$app->params['table_prefix'].$this->getTableName();

        if(count($this->getWhere())>0){
            $sql.=' where ';
            foreach ($this->getWhere() as $k=>$v){
                $sql.=Filter::sqlinject($k).'"'.Filter::sqlinject($v).'"';
            }
        }

        if($this->getOrderBy()!=''){
            $sql.=' order By '.$this->getOrderBy();
        }

        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return [
            'total'=>count($result),
            'list'=>$result,
        ];
    }

}
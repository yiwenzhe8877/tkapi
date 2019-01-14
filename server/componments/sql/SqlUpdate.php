<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/16
 * Time: 17:14
 */

namespace app\componments\sql;


use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\componments\utils\Filter;

class SqlUpdate
{
    private $_tableName;
    private $_where=[];
    private $_data=[];

    private  $_map=[
        "tkuser_base"=>'app\models\tkuser\base',
        'tkpay_transferlog'=>'app\models\tkpay\Transferlog',
    ];

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
     * @return mixed
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->_data = $data;
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

    public  function run()
    {



        $sql='update '.\Yii::$app->params['table_prefix'].$this->getTableName().' set ';

        foreach ($this->getData() as $k=>$v){
                $sql.=Filter::sqlinject($k).'="'.Filter::sqlinject($v).'",';
        }

        $sql=substr($sql,0,strlen($sql)-1);

        $sql.=' where ';

        foreach ($this->getWhere() as $k=>$v){
            $sql.=Filter::sqlinject($k).'"'.Filter::sqlinject($v).'"';
        }

        $result = \Yii::$app->getDb()->createCommand($sql)->execute();
        //$command = $connection->createCommand($sql);
       // $result = $command->execute();

        return $result;







    }

    public function changeonefield(){

        Assert::isEmpty(['表名'=>$this->getTableName()]);
        Assert::isEmpty(['setdata'=>$this->getData()]);
        Assert::isEmpty(['setwhere'=>$this->getWhere()]);

        $sql='update '.\Yii::$app->params['table_prefix'].$this->getTableName().' set ';


        foreach ($this->getData() as $k=>$v){
            $sql.=Filter::sqlinject($k).'='.$k.'+"'.Filter::sqlinject($v).'",';
        }

        $sql=substr($sql,0,strlen($sql)-1);

        $sql.=' where ';
        foreach ($this->getWhere() as $k=>$v){
            $sql.=Filter::sqlinject($k).'"'.Filter::sqlinject($v).'"';
        }

        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->execute();

        return $result;
    }

}
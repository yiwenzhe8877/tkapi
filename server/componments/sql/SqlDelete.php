<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/16
 * Time: 17:16
 */

namespace app\componments\sql;


use app\componments\utils\ApiException;
use app\componments\utils\Filter;

class SqlDelete
{
    private $_tableName;
    private $_where;

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
        $sql="update ".\Yii::$app->params['table_prefix'].$this->getTableName()." set del = 1 where ";


        if(count($this->getWhere())==0){
            ApiException::run("where参数错误",'900001');
        }

        foreach ($this->getWhere() as $k=>$v){

                $sql.=Filter::sqlinject($k).Filter::sqlinject($v);
        }


        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $result = $command->execute();

        return $result;
    }
}
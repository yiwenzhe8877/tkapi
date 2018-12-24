<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/28
 * Time: 16:55
 */

namespace app\componments\utils;


class TableUtils
{
    public static function getTableFields($table){

        $tableSchema = \Yii::$app->db->schema->getTableSchema($table);
        $fields = \yii\helpers\ArrayHelper::getColumn($tableSchema->columns, 'name', false);
        return $fields;
    }
    public static function getAllTableNames(){

        $connection = \Yii::$app->db;//get connection
        $dbSchema = $connection->schema;
//or $connection->getSchema();
        $tables = $dbSchema->getTableNames();//returns array of tbl schema's

        return $tables;
        /*foreach($tables as $tbl)
        {
            echo $tbl->rawName, ':<br/>', implode(', ', $tbl->columnNames), '<br/>';
        }*/
    }

}
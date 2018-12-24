<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/20
 * Time: 21:10
 */
namespace app\componments\testapi;

class ApiTest
{
    private $_case_admin=[
        ['data'=>['service'=>'adminuser.delete'],'code'=>'10010001'],
        ['data'=>['service'=>'adminuser.delete','admin_id'=>'1'],'code'=>'0'],
        ['data'=>['service'=>'adminuser.delete','admin_id'=>'123123'],'code'=>'10010001'],
    ];

    private $_case_admin_url="http://localhost/yiiapi/server/web/index.php/v1/index/index";

    /**
     * @return string
     */
    public function getCaseAdminUrl()
    {
        return $this->_case_admin_url;
    }


    /**
     * @return array
     */
    public function getCaseAdmin()
    {
        return $this->_case_admin;
    }

    /**
     * @param array $case_admin
     */
    public function setCaseAdmin($case_admin)
    {
        $this->_case_admin = $case_admin;
    }


}
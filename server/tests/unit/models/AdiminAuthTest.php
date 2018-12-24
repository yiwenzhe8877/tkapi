<?php
namespace models;

class AdiminAuthTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    // tests
    public function testSomeFeature()
    {
        $this->assertTrue(1==1);
    }

    public function testFunction1()
    {
        $this->assertTrue(3 > 1);
    }
    //这个是明显错误
    public function testFunction2()
    {
        $this->assertTrue(3 < 1);
    }
}
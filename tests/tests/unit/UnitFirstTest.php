<?php

class UnitFirstTest extends \Codeception\Test\Unit
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
    public function testLogin()
    {
        $login = new OnlineOrderLoginController();

        $login->submitLogin(null, null);
        $this->assertFalse("False Data Rejected");

        $login->submitLogin('2dcDe2E', '234196');
        $this->assertTrue('True Data Accpted');

    }
}
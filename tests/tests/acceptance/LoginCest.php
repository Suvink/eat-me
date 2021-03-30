<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        
    }

    // tests
    public function tryToTestLogin(AcceptanceTester $I)
    {
        $I->amOnPage('online/login');
        $I->fillField('#phone_number_input', "0771655198");
        $I->click('is-sent');
        $I->see('Your OTP here');
    }
}

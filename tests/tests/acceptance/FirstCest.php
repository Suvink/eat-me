<?php

class FirstCest
{
    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Eat Me');
    }
    public function secondpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/online/login');
        $I->see('login');
    }
}

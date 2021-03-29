<?php

class FirstCest
{
    public function HomePageWords(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('Eat Me');
    }
    public function OnlineLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/online/login');
        $I->see('login');
    }
    public function DineinLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/dinein/login');
        $I->see('login');
    }
    public function OnlineOrderWorks(AcceptanceTester $I)
    {
        //Only works for logged in customers
        $I->amOnPage('/online');
        $I->see('login');
    }
    public function DineinOrderWorks(AcceptanceTester $I)
    {
        //Only works for logged in customers
        $I->amOnPage('/online/login');
        $I->see('login');
    }
    public function StaffLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/staff/login');
        $I->see('login');
    }
    
}

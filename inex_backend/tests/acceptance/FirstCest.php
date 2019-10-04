<?php

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function frontpageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(3);
        $I->login('eat@me.com', 'govno666');
        $I->wait(6);
        $I->see('Download', '.MuiButton-label');
    }
}

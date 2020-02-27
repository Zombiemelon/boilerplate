<?php

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Response;

class FirstApiCest
{
    private static $__mock_webserver;

    public function _before(ApiTester $I)
    {
        self::$__mock_webserver = $I->setMockWebServer();
    }

    public function _after(ApiTester $I)
    {
        $I->stopMockWebServer();
    }

    //
    public function tryToTest(ApiTester $I)
    {
        self::$__mock_webserver->setResponseOfPath(
            '/testApi',
            new Response('Test API', [],200)
        );

        $I->sendGET('/testApi');

        $I->seeResponseEquals("Test API");
    }
}

<?php

namespace Tests;

use Nidux\App4LessPush\APIClient;
use Nidux\App4LessPush\Utils;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    function testPush()
    {
        $client = new APIClient('USERNAME','PASSWORD');

        $result = $client->sendPushNotification(
            'TOKEN1;TOKEN2;TOKEN3',
            'A NICE TITLE',
            'A VALID URL',
            'utm'
        );
        $this->assertTrue($result);
    }

    function testGuessIfApp4LessIsUsedNegative()
    {
        $result = Utils::isApp4Less();
        $this->assertFalse($result);
    }

    function testGuessIfApp4LessIsUsedPositive()
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'reskyt';
        $result = Utils::isApp4Less();

        $this->assertTrue($result);
    }
}

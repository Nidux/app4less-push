<?php


namespace Nidux\App4LessPush;


class Utils
{
    public static function isApp4Less() : bool
    {
        if (isset($_COOKIE['isApp4Less']) && $_COOKIE['isApp4Less'] == true) {
            return true;
        }

        //Looks for certain text in some specific headers
        $requestedWithHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? 'NOTHING';
        $refererHeader = $_SERVER['HTTP_REFERER'] ?? 'NOTHING';
        $informationToFindArray = [];
        $informationToFindArray[] = ['headerData' => $requestedWithHeader, 'textToFind' => 'reskyt' ];
        $informationToFindArray[] = ['headerData' => $requestedWithHeader, 'textToFind' => 'app4less' ];
        $informationToFindArray[] = ['headerData' => $refererHeader, 'textToFind' => 'reskyt' ];
        $informationToFindArray[] = ['headerData' => $refererHeader, 'textToFind' => 'app4less' ];

        foreach ($informationToFindArray as $informationToFind)
        {
            if(self::doesHeaderContainCertainString($informationToFind['headerData'], $informationToFind['textToFind']))
            {
                return true;
            }
        }
        return false;
    }

    private static function doesHeaderContainCertainString($dataFromHeader, $textToFind) : bool
    {
        return strpos($dataFromHeader, $textToFind) !== false;
    }

    public static function getAPPToken()
    {
        if (self::isApp4Less() && isset($_GET['token_app'])) {
            setcookie('token_app', $_GET['token_app'], time() + (86400), "/");
            return $_GET['token_app'];
        }
        return $_COOKIE['token_app'] ?? false;
    }

    public static function getAppUUID()
    {
        if (self::isApp4Less() && isset($_GET['uuid'])) {
            setcookie('uuid_app', $_GET['token_app'], time() + (86400), "/");
            return $_GET['uuid'];
        }
        return $_COOKIE['uuid_app'] ?? false;
    }
}
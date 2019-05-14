<?php

namespace Nidux\App4LessPush;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;


class APIClient
{
    
    private $userAPI;
    private $passwordAPI;
    private $urlAPI;


    /**
     * Client constructor.
     * @param string $userAPI API username
     * @param string $passwordAPI API Password
     * @param string $urlAPI (Optional) changes the API URL if needed
     */
    public function __construct($userAPI, $passwordAPI, $urlAPI = 'https://app.reskyt.com/api/')
    {
        $this->userAPI = $userAPI;
        $this->passwordAPI = $passwordAPI;
        $this->urlAPI = $urlAPI;
    }


    /**
     * Sends the push notification via the API
     * @param null $tokens It can be one token or multiple token separated by semicolon (;)
     * @param null $title
     * @param null $url
     * @param null $utm_campaign
     * @return bool True if the notification was sent, false if failed
     */
    public function sendPushNotification($tokens = null, $title = null, $url = null, $utm_campaign = null) : bool
    {
        $data = [
            "user" => $this->userAPI,
            "password" => $this->passwordAPI,
            "titulo" => $title,
            "url" => $url,
            "campaign" => $utm_campaign,
            "tokens" => $tokens
        ];
        return $this->sendApi('push', $data);
    }


    private function sendApi($action, $data) : bool
    {
        $client = new Client(['verify' => false ]);
        $response = null;
        try
        {
            $response = $client->request('POST', $this->urlAPI . $action, [
                'form_params' => $data
            ]);
        }
        catch (GuzzleException $e) {
            return false;
        }
        catch (Throwable $t)
        {
            return false;
        }

        return ($response->getBody()->getContents() == 1);
    }


}
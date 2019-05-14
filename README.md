# app4less-push
Provides a way to send push notifications to App4Less API and obtain the application token when using the mobile app. ***This is not an official package supported by App4less***

## Installation

You can install the package via composer:

``` bash
composer require nidux/app4less-push
```

## Usage

### Send Notifications

Initialize App4Less API Client

``` php
    use Nidux\App4LessPush\APIClient;
    $client = new APIClient('USERNAME','PASSWORD');
```

Send push notifications:

``` php
    $result = $client->sendPushNotification(
                'TOKEN1;TOKEN2;TOKEN3',
                'A NICE TTTLE',
                'A VALID URL',
                'utm'
            );
```

### Check if your site is being accessed within an App4Less app
``` php
    use Nidux\App4LessPush\Utils;
    $result = Utils::isApp4Less(); // True if yes
```

### Get Token App
``` php
    use Nidux\App4LessPush\Utils;
    $token = Utils::getAppUUID();
```

### Get UUID App
``` php
    use Nidux\App4LessPush\Utils;
    $uuid = Utils::getAppUUID();
```


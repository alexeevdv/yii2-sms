# yii2-sms
This extension allows SMS sending via different SMS providers


Installation
------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist alexeevdv/yii2-sms
```

or add

```
"alexeevdv/yii2-sms": "~1.0.0"
```

to the require section of your composer.json.


Configuration
--------------
```
use alexeevdv\sms\provider\SmsRu;
use alexeevdv\sms\Sms;

//...
   'components' => [
       'sms' => [
           'class' => Sms::class,
           'provider' => [
               'class' => SmsRu::class,
               'api_id' => '123456789',
           ],
       ],
   ],
//...

```

Usage
---------------

```

$result = Yii::$app->sms->send('1234567890', 'Hi there!');

```

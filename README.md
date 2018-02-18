# yii2-sms
This extension allows SMS sending via different SMS providers


Installation:
-------------

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


Configuration:
--------------
```
use alexeevdv\sms\provider\SmsRuProvider;
use alexeevdv\sms\Sms;

//...
   'components' => [
       'sms' => [
           'class' => Sms::class,
           'provider' => [
               'class' => SmsRuProvider::class,
               'api_id' => '123456789',
           ],
       ],
   ],
//...

```

Usage:
------

```

$result = Yii::$app->sms->send('1234567890', 'Hi there!');

```

Supported providers:
--------------------

* [http://sms.ru/](sms.ru)

  Class: \alexeevdv\sms\provider\SmsRuProvider
  Params:
  * `api_id` - Your api ID from sms.ru

* [http://smsc.ru/](smsc.ru)
  
  Class: \alexeevdv\sms\provider\SmscRuProvider
  Params:
  * `login` - Your login from smsc.ru
  * `psw` - Your plain text or MD5 hashed password from smsc.ru

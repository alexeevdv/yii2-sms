yii2-sms
==========

[![Build Status](https://travis-ci.org/alexeevdv/yii2-sms.svg?branch=master)](https://travis-ci.org/alexeevdv/yii2-sms) 
[![codecov](https://codecov.io/gh/alexeevdv/yii2-sms/branch/master/graph/badge.svg)](https://codecov.io/gh/alexeevdv/yii2-sms)
![PHP 5.6](https://img.shields.io/badge/PHP-5.6-green.svg) 
![PHP 7.0](https://img.shields.io/badge/PHP-7.0-green.svg) 
![PHP 7.1](https://img.shields.io/badge/PHP-7.1-green.svg) 
![PHP 7.2](https://img.shields.io/badge/PHP-7.2-green.svg)


This extension allows SMS sending via different SMS providers


Installation:
-------------

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist alexeevdv/yii2-sms "~1.0.0"
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

* [sms.ru](http://sms.ru/)

  Class: \alexeevdv\sms\provider\SmsRuProvider
  Params:
  * `api_id` - Your api ID from sms.ru

* [smsc.ru](http://smsc.ru/)
  
  Class: \alexeevdv\sms\provider\SmscRuProvider
  Params:
  * `login` - Your login from smsc.ru
  * `psw` - Your plain text or MD5 hashed password from smsc.ru

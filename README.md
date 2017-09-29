# RandomString
A simple class for generating random strings.

[![Build Status](https://travis-ci.org/didatus/RandomString.svg?branch=master)](https://travis-ci.org/didatus/RandomString)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/didatus/RandomString/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/didatus/RandomString/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/didatus/RandomString/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/didatus/RandomString/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a97f47fc-f369-4434-b0ee-b8901931b9e2/mini.png)](https://insight.sensiolabs.com/projects/a97f47fc-f369-4434-b0ee-b8901931b9e2)

#### Create RandomString Instance
```php
use Didatus\RandomString\RandomString;
$randomString = new RandomString();
```

#### Create RandomString Instance with own character pool and with excluding characters
```php
use Didatus\RandomString\RandomString;
$randomString = new RandomString('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', '1IO0');
``` 
Excluding characters can be helpful for generating readable coupons (without confusing 0 and O for example).

#### Generate a single random string
```php
$randomString = new RandomString();
$string = $randomString->getString(10);
```

#### Generate a single random alpha numeric string excluding confusing characters
```php
$randomString = new RandomString('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', '1IO0');
$string = $randomString->getString(10);
```

#### generate a list of five random tokens
```php
$randomString = new RandomString();
$strings = $randomString->getListOfString(10, 5);
```

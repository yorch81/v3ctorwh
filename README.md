# V3ctor WareHouse #

## Description ##
V3ctorWH is a REST API for V3 WareHouse Core.

## Requirements ##
* [PHP 5.4.1 or higher](http://www.php.net/)
* [MongoDb](http://www.mongodb.org/)
* [MySQL](https://www.mysql.com/)
* [Slim Framework](http://www.slimframework.com/)
* [V3Wh Core](https://github.com/yorch81/v3wh)

## Installation ##
Clone Repository
Execute php composer.phar install

Create config.php

```php
$hostname = 'DB_HOST';
$username = 'DB_USER';
$password = 'DB_PASSWORD';
$dbname   = 'DBNAME';
$key      = "KEY";
```
```php

## Notes ##
V3ctorWH is a Objects WareHouse in MongoDb

## Examples ##
To Create Object
$ curl -X POST -d '{"r" : 666}' http://my_url/entity?auth=key

To Get Object
$ curl http://my_url/entity/_id?auth=key

To Update Object
$ curl -H 'Content-Type:application/json' -X PUT -d '{"y" : 666}' http://my_url/entity/_id?auth=key

To Delete Object
$ curl -X DELETE http://my_url/entity/_id?auth=key

To Query Entity
$ curl -X POST -d '{"field" : "value"}' http://my_url/query/entity?auth=key
```
## Original Idea ##
Ernesto Celis de la Fuente.
https://celisdelafuente.net/

## References ##
https://en.wikipedia.org/wiki/Representational_state_transfer

P.D. Let's go play !!!





# cakephp-locale-type
[![LICENSE](https://img.shields.io/github/license/smartsolutionsitaly/cakephp-locale-type.svg)](LICENSE)
[![packagist](https://img.shields.io/badge/packagist-smartsolutionsitaly%2Fcakephp--locale--type-brightgreen.svg)](https://packagist.org/packages/smartsolutionsitaly/cakephp-locale-type)
[![issues](https://img.shields.io/github/issues/smartsolutionsitaly/cakephp-locale-type.svg)](https://github.com/smartsolutionsitaly/cakephp-locale-type/issues)
[![CakePHP](https://img.shields.io/badge/CakePHP-3.6%2B-brightgreen.svg)](https://github.com/cakephp/cakephp)

Locale type for [CakePHP](https://github.com/cakephp/cakephp)

## Installation
You can install _cakephp-locale-type_ into your project using [Composer](https://getcomposer.org).

``` bash
$ composer require smartsolutionsitaly/cakephp-locale-type
```

## Setup
Insert at the bottom of your _config/bootstrap.php_ file the following line:

``` php
Type::map('locale', 'SmartSolutionsItaly\CakePHP\Database\Type\LocaleType');
```

And add or edit the method __initializeSchema_ in your _Table_ classes.

``` php
protected function _initializeSchema(\Cake\Database\Schema\TableSchema $schema)
{
    $schema->setColumnType('your_column_name', 'locale');

    return $schema;
}
```

## License
Licensed under The MIT License
For full copyright and license information, please see the [LICENSE](LICENSE)
Redistributions of files must retain the above copyright notice.

## Copyright
Copyright (c) 2018-2019 Smart Solutions S.r.l. (https://smartsolutions.it)

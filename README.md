# PsyshBundle

A bundle to use the php REPL [Psysh](http://psysh.org/) with Symfony.

## Install

Install the package:
```shell
composer require-dev theofidry/psysh
```

Enable the bundle:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    public function registerBundles()
    {
        //...

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            //...
            $bundles[] = new Fidry\PsyshBundle\PsyshBundle();
        }

        return $bundles;
    }
}
```

## Usage

```shell
php app/console psysh
```

# License

[![license](https://img.shields.io/badge/license-MIT-red.svg?style=flat-square)](LICENSE)

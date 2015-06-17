# Install

### Install the package

You can use [Composer](https://getcomposer.org/) to install the bundle to your project:

```bash
composer require-dev theofidry/psysh
```

### Enable the bundle

Then, update your `app/config/AppKernel.php` file to enable the bundle:
```php
<?php
// app/config/AppKernel.php

public function registerBundles()
{
    //...

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        //...
        $bundles[] = new Fidry\PsyshBundle\PsyshBundle();
    }

    return $bundles;
}
```

Next chapter: [PsySH as a debugger](debugger.md)

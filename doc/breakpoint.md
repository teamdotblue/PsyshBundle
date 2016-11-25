# PsySH for breakpoints

As explained in PsySH documentation, it is possible to use PsySH as a debugger by evaluating it where you wish to have
a breakpoint. Once this breakpoint reached, a PsySH instance will be launched and then you can debug as you like at this
point.

However, this does not work natively with another web server than the PHP build-in web server, neither with Symfony
native server. To use it with symfony, you have to launch it manually:

```bash
php -S localhost:9000 vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/router_dev.php
```

To use a breakpoint with PsySH, use the following:

```php
psysh();
```

You can also pass additional parameters:

```php
psysh(['myVar' => $myVar);
```

Which will give you access to `$myVar` in the shell. But to avoid to have to pass all variables, you might simply want
to bind the shell to you current context:

```php
class Dummy
{
    function myFunction() {
        $x = 'hello World!';
        psysh([], $this);
        
        // you will have access to $x in your instance
    }
}
```


« [Reflect like a boss](reflect.md) • [Customize PsySH](custom.md) »

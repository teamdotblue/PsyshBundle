# Usage as an interactive shell

Note: the following use cases are for most perfectly valid outside of Symfony context.

### Create a function in the shell

Here is an example of a [generator](http://php.net/manual/en/language.generators.syntax.php).

```
$ php app/console psysh
>>> function generatorFactory() \
... { \
... for($i = 0; $i < 3; $i++) { \
... yield $i; \
... } \
... }
=> null
>>> $generator = generatorFactory()
>>> foreach($generator as $value) \
... { \
... echo "$value\n"; \
... }
0
1
2
=> null
```

### Declare function in a namespace

```
$ php app/console psysh
>>> namespace MyNamespace
=> null

# From now on we are in the `MyNamespace` namespace
# Example: if we declare a function which prints the namespace:
>>> function f() { return __NAMESPACE__."\n";}
=> null
# When we call it, it will display `"MyNamespace"`
>>> f()
=> "MyNamespace"

# To get out of the current namespace, just use:
>>> namespace {}
=> null
# Now we are at the root, if you try to call again `f()` you'll get an error:
>>> f()
PHP Fatal error:  Call to undefined function f() in eval()'d code on line 1

# If you wish to call it, you have to use its fully qualified name:
>>> MyNamespace\f()
=> "MyNamespace"
```

### Load functions from a file

Although it's convenient, if your function is false and you want to correct something, it's a pain to always redeclare
it. So another way is to declare your function in a `.php` file and load this file instead!


```
<?php

// test.php

function generatorFactory()
{
    for ($i = 0; $i < 3; $i++) {
        yield $i;
    }
}

function display()
{
    $generator = generatorFactory();
    foreach ($generator as $value) {
        echo "$value\n";
    }
}
```

```
$ php app/console psysh
>>> require('test.php')
=> 1
>>> display()
0
1
2
=> null
```

Note that the require is relative from *where* you launch the PsySH instance. Example if I go to the `vendor` folder, I
have to take into consideration the path:

```
$ php ../app/console psysh
>>> require('../test.php')
=> 1
```

### Load an autoloaded function from its name

With the example we loaded a function from it's file. But what if we want to load it from its fully qualified name? It
does not matter as long as the function is loaded in the PsySH shell context. For instance, since the PsySH shell is
loaded with the application autoloader, the following works:

```
$ php app/console psysh
>>> $kernel = new AppKernel('dev', true)   # create a Kernel instance
>>> $appBundle = new AppBundle\AppBundle() # create an instance of the AppBundle
```

If the class or function you want to use is not present in the shell context, you have to require it beforehand. Let's
take the example of our file again. This time we will declare our functions in a namespace, which is not
loaded by PsySH yet:

```
<?php

// test.php

namespace DummyNamespace;

function generatorFactory()
{
    for ($i = 0; $i < 3; $i++) {
        yield $i;
    }
}

function display()
{
    $generator = generatorFactory();
    foreach ($generator as $value) {
        echo __NAMESPACE__.": $value\n";
    }
}
```

New since the file is not autoloaded, we have to do it manually:
```
$ php app/console psysh
>>> require('test.php')
=> 1
>>> display() # Will fail! Since we are not in the namesapce DummyNamespace, we have to use its fullname
>>> DummyNamespace\display()
DummyNamespace: 0
DummyNamespace: 1
DummyNamespace: 2
=> null

# Another way to avoid calling the full name of the function every time, you can use the `use` statement:

```

# Handle dependency injections

Now you have seen the basics. But I see you coming saying that the examples above are easy, but how we deal with a
function or a class which needs services? The long and cumbersome way is to instantiate them one by one to finally
get what you want.

A better way is given by this command:
```
>>> ls
Variables: $container, $kernel, $parameters
```

Here's your Graal, you have access to the 3 main entry points of your application! Want to test a function service?
Get it via the container!

```
>>> ls
Variables: $container, $kernel, $parameters
```

Previous chapter: [Install](install.md)<br />
Next chapter: [Reflect like a boss](reflect.md)

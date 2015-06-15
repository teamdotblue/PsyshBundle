## Check documentation

```
$ php app/console psysh
>>> require('test.php')
=> 1
>>> doc DummyNamespace\display
function DummyNamespace\display()
```

As you can see, no documentation is actually displayed. This is because the function does not have any. Let's add some:

```php
<?php

// test.php

namespace DummyNamespace;

function generatorFactory()
{
    for ($i = 0; $i < 3; $i++) {
        yield $i;
    }
}

/**
 * This is some PHPDoc.
 *
 * Put anything here.
 *
 * @author Théo FIDRY <theo.fidry@gmail.com>
 * @covers ::apply
 *
 * @param int   $x
 * @param array $y
 *
 * @return \DateTime
 */
function display($x = 1, array $y = null)
{
    $generator = generatorFactory();
    foreach ($generator as $value) {
        echo __NAMESPACE__.": $value\n";
    }

    return new \DateTime();
}
```

Now:

```
>>> require('test.php')
=> 1
>>> doc \DummyNamespace\display
function DummyNamespace\display($x = 1, array $y = null)

Description:
  This is some PHPDoc.
  
  Put anything here.

Param:
  int    $x 
  array  $y 

Return:
  \DateTime 

Author: Théo FIDRY <theo.fidry@gmail.com>

Covers: ::apply
```

As you can see it display the whole PHPDoc properly formated, even if the tag are unknown like the `@cover` tag which
comes from PHPUnit.

You can also display the doc of PHP functions: `doc array_map`

## Reflect like a boss

`help ls`

```
> ls
Variables: $container, $kernel, $parameters

>>> ls -al $kernel

Class Constants:
  END_OF_LIFE          "05/2019"  
  END_OF_MAINTENANCE   "05/2018"  
  EXTRA_VERSION        ""         
  MAJOR_VERSION        "2"        
  MASTER_REQUEST       1          
  MINOR_VERSION        "7"        
  RELEASE_VERSION      "1"        
  SUB_REQUEST          2          
  VERSION              "2.7.1"    
  VERSION_ID           "20701"    

Class Properties:
  $booted           true                                                             
  $bundleMap        Array(14)                                                        
  $bundles          Array(14)                                                        
  $container        <appDevDebugProjectContainer #0000000014f7ea100000000053f3c597>  
  $debug            true                                                             
  $environment      "dev"                                                            
  $loadClassCache   null                                                             
  $name             "app"                                                            
  $rootDir          "/home/thfid/Sites/blog/app"                                     
  $startTime        1434440630.1913                                                  

Class Methods:
  __clone                          public function __clone()                                                                                                                                             
  __construct                      public function __construct($environment, $debug)                                                                                                                     
  boot                             public function boot()                                                                                                                                                
  buildContainer                   protected function buildContainer()                                                                                                                                   
  doLoadClassCache                 protected function doLoadClassCache($name, $extension)                                                                                                                
  dumpContainer                    protected function dumpContainer(Symfony\Component\Config\ConfigCache $cache, Symfony\Component\DependencyInjection\ContainerBuilder $container, $class, $baseClass)  
  getBundle                        public function getBundle($name, $first = true)                                                                                                                       
  getBundles                       public function getBundles()                                                                                                                                          
  getCacheDir                      public function getCacheDir()                                                                                                                                         
  getCharset                       public function getCharset()                                                                                                                                          
  getContainer                     public function getContainer()                                                                                                                                        
  getContainerBaseClass            protected function getContainerBaseClass()                                                                                                                            
  getContainerBuilder              protected function getContainerBuilder()                                                                                                                              
  getContainerClass                protected function getContainerClass()                                                                                                                                
  getContainerLoader               protected function getContainerLoader(Symfony\Component\DependencyInjection\ContainerInterface $container)                                                            
  getEnvParameters                 protected function getEnvParameters()                                                                                                                                 
  getEnvironment                   public function getEnvironment()                                                                                                                                      
  getHttpKernel                    protected function getHttpKernel()                                                                                                                                    
  getKernelParameters              protected function getKernelParameters()                                                                                                                              
  getLogDir                        public function getLogDir()                                                                                                                                           
  getName                          public function getName()                                                                                                                                             
  getRootDir                       public function getRootDir()                                                                                                                                          
  getStartTime                     public function getStartTime()                                                                                                                                        
  handle                           public function handle(Symfony\Component\HttpFoundation\Request $request, $type = 1, $catch = true)                                                                   
  init                             public function init()                                                                                                                                                
  initializeBundles                protected function initializeBundles()  
```

Show a function source code:

```
>>> show DummyNamespace\display
  > 27| function display($x = 1, array $y = null)
    28| {
    29|     $generator = generatorFactory();
    30|     foreach ($generator as $value) {
    31|         echo __NAMESPACE__.": $value\n";
    32|     }
    33| 
    34|     return new \DateTime();
    35| }

```

Previous chapter: [Usage as interactive debugger](basic-usage.md)<br />
Next chapter: [Usage as a breakpoint](breakpoint.md)

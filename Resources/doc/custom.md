# Customize PsySH

You may also want to add a custom command or change the parameters. To achieve that, simply override the
`psysh.shell` service declaration:

```yaml
services:
    psysh.shell:
        class: Psy\Shell
        calls:
            - method: setScopeVariables
              arguments:
                -
                    container: @service_container
                    session: @session
```

Now if you run `php app/console psysh` and then `ls`, you will see the variables `$container` and `$session`:

```
>>> ls
Variables: $container, $session
```

The default configuration is the following:

```
services:
    psysh.shell:
        class: Psy\Shell
        calls:
            - method: setScopeVariables
              arguments:
                -
                    kernel: @kernel
                    container: @service_container
                    parameters: @=service('service_container').getParameterBag().all()
```

Previous chapter: [PsySH for breakpoints](breakpoint.md)<br />
[Back to Table of Contents](./../../README.md#documentation)

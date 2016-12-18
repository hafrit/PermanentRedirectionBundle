# PermanentRedirectionBundle
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/4ca07fc1-6f79-485d-bcc0-6bb4eb421b88/mini.png)](https://insight.sensiolabs.com/projects/4ca07fc1-6f79-485d-bcc0-6bb4eb421b88)
This bundle enable you to create infinite number of redirection without using code.
- User bookmark a page of your site that does't exist anymore so he will have a beautiful 404 page.
- A link sent into an old mailing campaign and you want to redirect it instead of using controller redirection you can just configure your redirection.

## Install

### Step 1: Add to composer.json

```
"require" :  {
    // ...
    "hafrit/PermanentRedirectionBundle":"dev-master",
}
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new hafrit\PermanentRedirectionBundle\hafritPermanentRedirectionBundle(),
    );
}
```

### Step 2: imports the bundle services.yml
```yaml
# app/config/config.yml

imports:
    // ...
    - { resource: '@hafritPermanentRedirectionBundle/Resources/config/services.yml' }
```

## Usage: configure your permanent redirection

```yaml
# app/config/config.yml

hafrit_permanent_redirection:
    enable: boolean
    redirection_lists:
        - { source: "source_route_name", target: "target_route_name", status: "redirection_status", referenceType: integer, keepParameters: boolean }
        .
        .
        .
        - { source: "source_route_name", target: "hamdi", status: "301" }
        
```
## Parameters options:

```yaml
hafrit_permanent_redirection:
    enable: true/false     ~ # Required
    redirection_lists:
        - { 
        source:         ~ # Required                # route name to redirect,
        target:         ~ # Required                # target route name,
        status:         ~ # Required                # redirection status (301, 302, ...) @see Symfony\Component\HttpFoundation\Response.php isRedirect function         
        referenceType:  ~ # Optional Default 1      # @see Symfony\Component\Routing\Generator\UrlGeneratorInterface.php,             
        keepParameters: ~ # Optional Default false  # redirect to target route with the same source route route parameters
        }

```

## Example:

```yaml
hafrit_permanent_redirection:
    enable: true
    redirection_lists:
        - { source: "hello_world", target: "acme_hello_world", status: "301" } 
        # "hello_world" => http://localhost/hello-world will be redirected to http://localhost/acme-hello-world with redirection code 301
        - { source: "hello_with_parameters", target: "acme_hello_with_parameters", status: "302", keepParameters: true }
        # "hello_world" => http://localhost/hello/firstName/lastName will be redirected with the same first and last name to http://localhost/acme-hello/firstName/lastName with redirection code 302
```
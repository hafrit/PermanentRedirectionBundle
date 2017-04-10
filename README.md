# PermanentRedirectionBundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/5311cf99-0721-49de-887e-1b530451c650/mini.png)](https://insight.sensiolabs.com/projects/5311cf99-0721-49de-887e-1b530451c650)
[![Total Downloads](https://poser.pugx.org/hafrit/permanent-redirection-bundle/downloads)](https://packagist.org/packages/hafrit/permanent-redirection-bundle)
[![Latest Stable Version](https://poser.pugx.org/hafrit/permanent-redirection-bundle/v/stable)](https://packagist.org/packages/hafrit/permanent-redirection-bundle)
[![License](https://poser.pugx.org/hafrit/permanent-redirection-bundle/license)](https://packagist.org/packages/hafrit/permanent-redirection-bundle)

This bundle enable you to create infinite number of redirection without using code.
- User bookmark a page of your site that does't exist anymore so he will have a beautiful 404 page.
- A link sent into an old mailing campaign and you want to redirect it instead of using controller redirection you can just configure your redirection.

## Install

### Step 1: Add to composer.json

```
"require" :  {
    // ...
    "hafrit/permanent-redirection-bundle": "dev-master",
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
        - { source: "source_route_name", target: "target_route_name", status: "301" }
        
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
        keepParameters: ~ # Optional Default false  # redirect to target route with the same source route parameters
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

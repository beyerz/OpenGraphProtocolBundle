[![Packagist](https://img.shields.io/packagist/v/beyerz/open-graph-protocol-bundle.svg)](https://packagist.org/packages/beyerz/open-graph-protocol-bundle)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://travis-ci.org/beyerz/OpenGraphProtocolBundle.svg?branch=master)](https://travis-ci.org/beyerz/OpenGraphProtocolBundle)

# OpenGraphProtocolBundle

Easy Integration for Symfony2 projects requiring opengraph

The OpenGraphBundle enables easy integration for Symfony2 and twig views to incorporate the Open Graph Protocols

**Important Note:
If you are using symfony version less than 2.8, please stay with build v1.0 as v2.0 may not work correctly due to symfony using traits for container awareness**


# Installation

### Composer

```bash
composer require beyerz/open-graph-protocol-bundle
```

### Application Kernel

Add OpenGraphBundle to the `registerBundles()` method of your application kernel:

```php
public function registerBundles()
{
    return array(
        new Beyerz\OpenGraphProtocolBundle\OpenGraphProtocolBundle(),
    );
}
```

### Config

Enable loading of the OGP service and setting default values by adding the following to
the application's `config.yml` file:

A Base and facebook library are currently supported, but you can add as many libraries with as many default values
that you like

```yaml
#OGP Bundle
open_graph_protocol:
    libraries:
        base:
            class: Beyerz\OpenGraphProtocolBundle\Libraries\Base
            default_values:
                site_name: {{ default value for website name }}
                type: {{ default value for website type }}
                title: {{ default value for any page title }}
                url: {{ default value for any canonical url (acts as a fall back for bad pages) }}
                image: {{ default image for your site }}
                description: {{ default generic page description for your site }}
        facebook:
            class: Beyerz\OpenGraphProtocolBundle\Libraries\Facebook
            default_values: { app_id: {{ Your apps facebook id }} }
```

# Documentation

### View

Include the OGP Metas in the `head` tag of your layout.

With twig:

    {% block metas %}
            {{ ogp()|raw }}
    {% endblock %}

### Overriding Meta Values

Its common that you would want to change meta values like title, image, description etc...
This is easily done from within your page page controller (or any where that has access to the service container)

**From your Controller**
        
    $ogp = $this->get('beyerz.ogp.open_graph');
    $base = $ogp->get('base');
    $base->addMeta('title', "My dynamic title");
    $base->addMeta('url', $request->getSchemeAndHttpHost().$request->getRequestUri());
    $base->addMeta('description', "My dynamic description");
    
### Testing Tools
Facebook
* https://developers.facebook.com/tools/debug/

Twitter
* https://cards-dev.twitter.com/validator

OpenGraphProtocolBundle
=======================

Easy Integration for Symfony2 projects requiring opengraph

# OpenGraphProtocolBundle

The OpenGraphBundle enables easy integration for Symfony2 and twig views to incorporate the Open Grpah Protocols

## Installation

### Composer

    require: "beyerz/open-graph-protocol-bundle": "dev-master"

### Application Kernel

Add OpenGraphBundle to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new Beyerz\OpenGraphProtocolBundle\OpenGraphProtocolBundle(),
        );
    }

## Configuration

### Application config.yml

Enable loading of the OGP service and setting default values by adding the following to
the application's `config.yml` file:

A Base and facebook library are currently supported, but you can add as many libraries with as many default values
that you like

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

#### View

Include the OGP Metas in the `head` tag of your layout.

With twig:

    {% block metas %}
            {{ ogp()|raw }}
    {% endblock %}

#### Overriding Meta Values

Its common that you would want to change meta values like title, image, description etc...
This is easily done from within your page page controller (or any where that has access to the service container)

#####From your Controller
        
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

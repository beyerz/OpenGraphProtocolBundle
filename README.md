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

A default setter is provided, but you can define your own setter if you like
A Base and facebook library are currently supported, but you can add as many libraries with as many default values
that you like

    #OGP Bundle
    beyerz_open_graph_protocol:
        setter:
            class: Beyerz\SiteBundle\DependencyInjection\OpenGraphSetter
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
                class: Jobberjabber\Bundle\OpenGraphProtocolBundle\Libraries\Facebook
                default_values: { app_id: {{ Your apps facebook id }} }

#### View

Include the OGP Metas in the `head` tag of your layout.

With twig:

    {% block metas %}
            {% if ogp is defined %}
            	{{  array_to_meta(ogp)|raw }}
        	{% endif %}
    {% endblock %}

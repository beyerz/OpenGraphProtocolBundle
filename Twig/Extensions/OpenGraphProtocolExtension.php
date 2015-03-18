<?php
namespace Beyerz\OpenGraphProtocolBundle\Twig\Extensions;
use Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraph;

/**
 * @author Lance
 *
 */
class OpenGraphProtocolExtension extends \Twig_Extension {

    /**
     * @var \Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraph
     */
    private $openGraph;

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('ogp', array($this, 'renderMetaTags')));
    }

    /**
     * @param OpenGraph $openGraph
     */
    public function setOpenGraph(OpenGraph $openGraph){
        $this->openGraph = $openGraph;
    }

    /**
     * @return string
     */
    public function renderMetaTags() {
        //Flatten all the libraries
        $libraries = $this->openGraph->metaToArray();
        $html = '';

        foreach ($libraries as $metaProp=>$metaCont){
            $html .= '<meta property="' . $metaProp . '" content="' . $metaCont . '" />'.PHP_EOL;
        }
        return $html;
    }


    /* (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName() {
        return "opengraphprotocol_extension";
    }
}

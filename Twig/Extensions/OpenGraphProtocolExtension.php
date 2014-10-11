<?php
namespace Beyerz\OpenGraphProtocolBundle\Twig\Extensions;

/**
 * @author Lance
 *
 */
class OpenGraphProtocolExtension extends \Twig_Extension {

	public function getFunctions() {
		return array(
				new \Twig_SimpleFunction('array_to_meta', array($this, 'arrayToMeta')));
	}

	/**
	 *
	 * @param array $metaArray
	 * @return string
	 */
	public function arrayToMeta(array $metaArray) {
		$html = '';
		foreach ($metaArray as $metaProp=>$metaCont){
			$html .= '<meta property="' . $metaProp . '" content="' . $metaCont . '">';
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

?>
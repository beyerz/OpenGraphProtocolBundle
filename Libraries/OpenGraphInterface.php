<?php
namespace Beyerz\Bundle\OpenGraphProtocolBundle\Libraries;

/**
 * @author Lance Bailey
 *
 */
interface OpenGraphInterface {

	public function metaToArray();
	public function addMeta($property, $content);
	public function removeMeta();
}

?>
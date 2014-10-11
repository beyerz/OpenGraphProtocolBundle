<?php
namespace Beyerz\Bundle\OpenGraphProtocolBundle\Libraries;
use Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface;
/**
 * @author Lance Bailey
 * @property siteName
 */
class Base implements OpenGraphInterface {
	const BASE_NS_KEY = 'og:';

	protected $site_name;
	protected $title;
	protected $type;
	protected $url;
	protected $image;
	protected $description;

	public function metaToArray() {
		$properties = get_class_vars(__CLASS__);
		$metaArray = array();
		foreach($properties as $property=>$value){
			if(!empty($this->$property)){
				foreach ($this->$property as $prop=>$content){
					$metaArray[$prop] = $content;
				}
			}
		}
		return $metaArray;
	}

	public function addMeta($property, $content) {
		if(property_exists($this, $property)){
			$this->$property = array(self::BASE_NS_KEY . $property=>$content);
		}
	}
	public function removeMeta() {

	}

}

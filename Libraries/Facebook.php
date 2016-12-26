<?php
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

/**
 * @author Lance Bailey
 *
 */
class Facebook implements OpenGraphInterface {
	const BASE_NS_KEY = 'fb:';

	protected $app_id;

	public function metaToArray() {
		$properties = get_class_vars(get_called_class());
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

		return $this;
	}

	public function removeMeta() {
		return $this;
	}

}

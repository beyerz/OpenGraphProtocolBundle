<?php
/**
 * @author Lance Bailey
 *
 */
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

class Twitter implements OpenGraphInterface {
    const BASE_NS_KEY = 'twitter:';

    const CARD_TYPE_SUMMARY = "summary";
    const CARD_TYPE_SUMMARY_LARGE_IMAGE = "summary_large_image";
    const CARD_TYPE_PHOTO = "photo";
    const CARD_TYPE_GALLERY = "gallery";
    const CARD_TYPE_APP = "app";
    const CARD_TYPE_PLAYER = "player";
    const CARD_TYPE_PRODUCT = "product";

    protected $app_id;

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

        return $this;
    }

    public function removeMeta() {
        return $this;
    }
}
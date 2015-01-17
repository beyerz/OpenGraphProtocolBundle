<?php
/**
 * Created by PhpStorm.
 * @author: Lance Bailey
 * Date: 2015/01/17
 * Time: 07:46 PM
 */

namespace Beyerz\OpenGraphProtocolBundle\Libraries;


abstract class BaseOpenGraphLibrary implements OpenGraphInterface {

    /**
     * Return the library meta properties as an array
     * @return array
     */
    public function metaToArray()
    {
        $properties = get_object_vars($this);
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

    /**
     * Add/override a single meta property
     * @param $property
     * @param $content
     * @return $this
     */
    public function addMeta($property, $content)
    {
        if(property_exists($this, $property)){
            $this->$property = array($this->getLibraryNamespace() . $property=>$content);
        }

        return $this;
    }

    /**
     * Remove a meta that may have been set
     * @param $property
     * @return $this
     */
    public function removeMeta($property)
    {
        if(property_exists($this, $property)){
            $this->$property = array();
        }

        return $this;
    }

    /**
     * @return string
     */
    abstract protected function getLibraryNamespace();
}
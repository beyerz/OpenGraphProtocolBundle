<?php
/**
 * @author Lance Bailey
 *
 */
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

use Beyerz\OpenGraphProtocolBundle\Exceptions\TwitterCardException;
use Beyerz\OpenGraphProtocolBundle\Libraries\Twitter\Cards\Factory;

class Twitter extends BaseOpenGraphLibrary {
    const BASE_NS_KEY = 'twitter:';

    /**
     * @var BaseOpenGraphLibrary
     */
    protected $card = null;

    /**
     * Return the library meta properties as an array
     * @return array
     */
    public function metaToArray()
    {
        return $this->card->metaToArray();
    }

    /**
     * @param $property
     * @param $content
     * @return $this
     * @throws TwitterCardException
     * @throws \Beyerz\OpenGraphProtocolBundle\Exceptions\TwitterFactoryException
     */
    public function addMeta($property, $content)
    {
        if($property == 'card'){
            $this->card = Factory::build($content);
        }else{
            if(is_null($this->card)){
                throw new TwitterCardException("Card Type needs to be set before any meta values can be assigned");
            }
            $this->card->addMeta($property, $content);

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
        $this->card->removeMeta($property);
        return $this;
    }

    /**
     * @return string
     */
    protected function getLibraryNamespace(){
        return $this->card->getLibraryNamespace();
    }


}
<?php
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * @author Lance Bailey
 *
 */
class OpenGraph extends ContainerAware implements OpenGraphInterface {

    const FIELD_CLASS = 'class';
    const FIELD_DEFAULT_VALUES = 'default_values';

    /**
     * @var \Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraphInterface[]
     */
    private $libraries = array();

    /**
     * Load the defined libraries and set the defaults on each of them
     * @throws \Exception
     */
    public function prepareLibraryDefaults(){
        $libraries = $this->container->getParameter('libraries');
        //Initiate Library Classes and load defaults
        foreach($libraries as $library=>$defaults){
            //load class
            $this->addLibraryClass($library,$defaults[self::FIELD_CLASS]);
            $this->setLibDefaults($library,$defaults[self::FIELD_DEFAULT_VALUES]);
        }
    }

    /**
     * @param $alias
     * @param $nameSpace
     * @return mixed
     */
    private function addLibraryClass($alias,$nameSpace){
        if(!isset($this->libraries[$alias])){
            $class = new $nameSpace();
            $this->libraries[$alias] = $class;
        }
        return $this->libraries[$alias];
    }

    /**
     * @param string $alias
     * @param array $defaults
     * @throws \Exception
     */
    public function setLibDefaults($alias, array $defaults){
        //check if library was loaded and defaults are set in config
        if(isset($this->libraries[$alias])){
            //set default values
            if(!empty($defaults)){
                foreach ($defaults as $defKey => $defValue){
                    $this->libraries[$alias]->addMeta($defKey, $defValue);
                }
            }
        }
        else{
            throw new \Exception("Library $alias must be loaded before you can assign attributes");
        }
    }

    /**
     * @param string $alias
     * @return null | \Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraphInterface
     */
    public function get($alias){
        if(isset($this->libraries[$alias])){
            return $this->libraries[$alias];
        }
        return NULL;
    }

    public function all(){
        return $this->libraries;
    }

    /**
     *
     * @param string string $libName
     * @return \array(\Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface)
     */
    public function getLoadedLib($libName){
        return $this->libraries[$libName];
    }

    /**
     * @return array
     */
    public function metaToArray() {
        $metas = array();
        foreach ($this->libraries as $type=>&$lib){
            /* @var $lib \Beyerz\OpenGraphProtocolBundle\Libraries\BaseOpenGraphLibrary */
            $metas[$type] = $lib->metaToArray();
        }
        //flatten metas
        $flatMetas = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($metas)), TRUE);
        return $flatMetas;
    }

    /**
     * @param $property
     * @param $content
     * @return bool
     */
    public function addMeta($property, $content) {
        return FALSE;
    }

    /**
     * @return bool
     */
    public function removeMeta($property) {
        return FALSE;
    }

}

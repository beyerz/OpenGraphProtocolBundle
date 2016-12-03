<?php
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * @author Lance Bailey
 *
 */
class OpenGraph implements OpenGraphInterface {

    use ContainerAwareTrait;

    const FIELD_CLASS = 'class';
    const FIELD_DEFAULT_VALUES = 'default_values';

    /**
     *
     * @var array | \Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraphInterface
     */
    private $libraries = array();

    /**
     * Load the defined libraries and set the defaults on each of them
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

    private function addLibraryClass($alias,$nameSpace){
        if(!isset($this->libraries[$alias])){
            $class = new $nameSpace();
            $this->libraries[$alias] = $class;
        }
        return $this->libraries[$alias];
    }

    public function setLibDefaults($alias, $defaults){
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
     * @param $alias
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
     * @param string $libName
     * @return \array(\Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface)
     */
    public function getLoadedLib($libName){
        return $this->libraries[$libName];
    }

    public function metaToArray() {
        $metas = array();
        foreach ($this->libraries as $type=>&$lib){
            $metas[$type] = $lib->metaToArray();
        }
        //flatten metas
        $flatMetas = iterator_to_array(new \RecursiveIteratorIterator(new \RecursiveArrayIterator($metas)), TRUE);
        return $flatMetas;
    }

    public function addMeta($property, $content) {
        return FALSE;
    }
    public function removeMeta() {
        return FALSE;
    }

}

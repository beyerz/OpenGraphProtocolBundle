<?php
namespace Beyerz\Bundle\OpenGraphProtocolBundle\Libraries;

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface;
/**
 * @author Lance Bailey
 *
 */
class OpenGraph implements OpenGraphInterface {

	private $container;

	/**
	 *
	 * @var array(\Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface)
	 */
	private $ogpLibs = array();

	private $libraries = array();

	public function __construct(Container $container) {
		$this->container = $container;
		$this->libraries = $this->container->getParameter('libraries');
	}

	/**
	 * @return array of loaded libraries
	 */
	public function loadLibs(){
		$libTypes = array_keys($this->libraries);
		foreach ($libTypes as $libType){
			$this->addLib($libType, $this->libraries[$libType]['class']);
		}
		return $libTypes;
	}

	public function setLibDefaults($libName){
		//check if library was loaded and defaults are set in config
		if(isset($this->ogpLibs[$libName])){
			$lib = $this->getLoadedLib($libName);

			//set default values
			if(!empty($this->libraries[$libName]['default_values'])){
				foreach ($this->libraries[$libName]['default_values'] as $defKey => $defValue){
					/* @var $lib \Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface */
					$this->ogpLibs[$libName]->addMeta($defKey, $defValue);
				}
			}
		}
		else{
			throw new \Exception("Library $libName must be loaded before you can assign attributes");
		}
	}

	public function loadLib($libType) {
		$libTypes = array_keys($this->libraries);
		if (in_array($libType, $libTypes)) {
			$lib = $this->addLib($libType, $this->libraries[$libType]['class']);
			return $lib;
		} else {
			throw new InvalidTypeException(
					'OGP Library does not exist for : ' . $libType);
		}
	}

	/**
	 *
	 * @param string $libName
	 * @return \array(\Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraphInterface)
	 */
	public function getLoadedLib($libName){
		return $this->ogpLibs[$libName];
	}

	private function addLib($libName, $class) {
		if(!isset($this->ogpLibs[$libName])){
			$loadedClass = $this->loadNameSpace($class);
			$this->ogpLibs[$libName] = $loadedClass;
		}
		return $this->getLoadedLib($libName);
	}

	private function loadNameSpace($class) {
		if (false !== $pos = strrpos($class, '\\')) {
			// namespaced class name
			$namespace = substr($class, 0, $pos);
		}

		/* @var $kernel \AppKernel */
		$kernel = $this->container->get('kernel');
		$srcPath = $kernel->getRootDir() . "/../src";
		$loader = new UniversalClassLoader();
		// register classes with namespaces
		$loader->registerNamespaces(array($namespace => $srcPath,));

		// to enable searching the include path (e.g. for PEAR packages)
		$loader->useIncludePath(true);

		// activate the autoloader
		$loader->register();
		$loader->loadClass($class);
		return $loadedClass = new $class;
	}

	public function metaToArray() {
		$metas = array();
		foreach ($this->ogpLibs as $type=>&$lib){
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

<?php
namespace Beyerz\Bundle\OpenGraphProtocolBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use Symfony\Component\DependencyInjection\Container;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraph;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\ClassLoader\UniversalClassLoader;
/**
 * @author Lance Bailey
 *
 */
class OpenGraphProtocolListener{

	const DISABLED = 1;
    const ENABLED = 2;

    protected $twig;
    /**
     *
     * @var \Beyerz\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraph
     */
    protected $ogp;

    /**
     *
     * @var \Symfony\Component\DependencyInjection\Container
     */
    protected $container;

    public function __construct(\Twig_Environment $twig, OpenGraph $openGraph, Container $container){
    	$this->twig = $twig;
    	$this->ogp = $openGraph;
    	$this->container = $container;
    }

	public function onKernelRequest(GetResponseEvent $event) {
		//load all defined libraries
		$libs = $this->ogp->loadLibs();
		//set default values from config
		foreach ($libs as $lib){
			$this->ogp->setLibDefaults($lib);
		}
		//Allow user to manipulate object if required
		$setterParams = $this->container->getParameter('setter');
		$userClass = $setterParams['class'];
		$loadedClass = $this->loadNameSpace($userClass);
		/* @var $loadedClass \Beyerz\Bundle\OpenGraphProtocolBundle\DependencyInjection\OpenGraphSetter */
// 		$loadedClass->dynamicSet(&$this->ogp, $event);

		//convert all ogs to array for easy access
		$ogpContext = $this->ogp->metaToArray();

		//inject into twig
        $this->twig->addGlobal('ogp', $ogpContext);
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

}

?>
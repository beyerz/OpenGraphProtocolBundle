<?php
namespace Beyerz\OpenGraphProtocolBundle\DependencyInjection;

use Beyerz\OpenGraphProtocolBundle\DependencyInjection\OpenGraphSetterInterface;
use Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraph;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
/**
 * @author Lance
 *
 */
class OpenGraphSetter implements OpenGraphSetterInterface {

	/* (non-PHPdoc)
	 * @see \Beyerz\OpenGraphProtocolBundle\DependencyInjection\OpenGraphSetter::dynamicSet()
	 */
	public function dynamicSet(OpenGraph $openGraph, GetResponseEvent $event) {

		$base = $openGraph->getLoadedLib('base');
		$base->addMeta('description','Sample description text');
		echo "<pre>";
		var_dump($event->getRequest(), $event->getResponse());die();
	}
}
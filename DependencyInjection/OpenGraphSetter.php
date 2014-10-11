<?php
namespace Jobberjabber\Bundle\SiteBundle\DependencyInjection;

use Jobberjabber\Bundle\OpenGraphProtocolBundle\DependencyInjection\OpenGraphSetterInterface;
use Jobberjabber\Bundle\OpenGraphProtocolBundle\Libraries\OpenGraph;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
/**
 * @author Lance
 *
 */
class OpenGraphSetter implements OpenGraphSetterInterface {

	/* (non-PHPdoc)
	 * @see \Jobberjabber\Bundle\OpenGraphProtocolBundle\DependencyInjection\OpenGraphSetter::dynamicSet()
	 */
	public function dynamicSet(OpenGraph $openGraph, GetResponseEvent $event) {

		$base = $openGraph->getLoadedLib('base');
		$base->addMeta('description','Sample description text');
		echo "<pre>";
		var_dump($event->getRequest(), $event->getResponse());die();
	}
}
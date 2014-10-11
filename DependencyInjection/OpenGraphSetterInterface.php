<?php
namespace Beyerz\OpenGraphProtocolBundle\DependencyInjection;
use Beyerz\OpenGraphProtocolBundle\Libraries\OpenGraph;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
/**
 * @author Lance Bailey
 *
 */
interface OpenGraphSetterInterface {
	/**
	 * Use this function to set open graph attributes based on the event<br>
	 * No return is required, simply update the object<br>
	 * Setting an already set attribute will override the default that<br>
	 * was set in the config.
	 * @tutorial
	 * 				$base = $openGraph->getLoadedLib('base');<br>
					$base->addMeta('description','Sample description text');<br>

	 * @param OpenGraph $openGraph
	 * @param GetResponseEvent $event
	 */
	public function dynamicSet(OpenGraph $openGraph, GetResponseEvent $event);
}
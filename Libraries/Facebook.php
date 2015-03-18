<?php
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

/**
 * @author Lance Bailey
 *
 */
class Facebook extends BaseOpenGraphLibrary {
	const BASE_NS_KEY = 'fb:';
	protected $app_id;

	protected function getLibraryNamespace()
	{
		return self::BASE_NS_KEY;
	}
}

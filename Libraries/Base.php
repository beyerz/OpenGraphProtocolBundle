<?php
namespace Beyerz\OpenGraphProtocolBundle\Libraries;
/**
 * @author Lance Bailey
 */
class Base extends BaseOpenGraphLibrary {
	const BASE_NS_KEY = 'og:';

	protected $site_name;
	protected $title;
	protected $type;
	protected $url;
	protected $image;
	protected $description;

	protected function getLibraryNamespace()
	{
		return self::BASE_NS_KEY;
	}
}

<?php
/**
 * Created by PhpStorm.
 * User: Lance
 * Date: 2015/01/17
 * Time: 08:40 PM
 */
namespace Beyerz\OpenGraphProtocolBundle\Libraries\Twitter\Cards;
use Beyerz\OpenGraphProtocolBundle\Libraries\BaseOpenGraphLibrary;
use Beyerz\OpenGraphProtocolBundle\Libraries\Twitter;

class Summary extends BaseOpenGraphLibrary{

    protected $card = 'summary';
    protected $site;
    protected $description;
    protected $image;
    protected $url;

    /**
     * @return string
     */
    protected function getLibraryNamespace()
    {
        return Twitter::BASE_NS_KEY;
    }
}
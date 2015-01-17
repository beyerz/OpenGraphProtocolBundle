<?php
/**
 * Created by PhpStorm.
 * User: Lance
 * Date: 2015/01/17
 * Time: 08:42 PM
 */
namespace Beyerz\OpenGraphProtocolBundle\Libraries\Twitter\Cards;

use Beyerz\OpenGraphProtocolBundle\Libraries\BaseOpenGraphLibrary;
use Beyerz\OpenGraphProtocolBundle\Libraries\Twitter;

class Product extends BaseOpenGraphLibrary{

    /**
     * @return string
     */
    protected function getLibraryNamespace()
    {
        return Twitter::BASE_NS_KEY;
    }

}
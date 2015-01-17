<?php
/**
 * Created by PhpStorm.
 * User: Lance
 * Date: 2015/01/17
 * Time: 08:42 PM
 */

namespace Beyerz\OpenGraphProtocolBundle\Libraries\Twitter\Cards;
use Beyerz\OpenGraphProtocolBundle\Exceptions\TwitterFactoryException;

/**
 * Get the correct card object based on type
 * Class Factory
 */
class Factory {

    const CARD_TYPE_SUMMARY = "summary";
    const CARD_TYPE_SUMMARY_LARGE_IMAGE = "summary_large_image";
    const CARD_TYPE_PHOTO = "photo";
    const CARD_TYPE_GALLERY = "gallery";
    const CARD_TYPE_APP = "app";
    const CARD_TYPE_PLAYER = "player";
    const CARD_TYPE_PRODUCT = "product";

    /**
     * @param string $type Factory::CARD_TYPE_*
     * @return App|Gallery|Photo|Player|Product|Summary|SummaryLargeImage
     * @throws TwitterFactoryException
     */
    public static function build($type)
    {
        switch ($type) {
            case self::CARD_TYPE_SUMMARY:
                return new Summary();
                break;
            case self::CARD_TYPE_SUMMARY_LARGE_IMAGE:
                return new SummaryLargeImage();
                break;
            case self::CARD_TYPE_PHOTO:
                return new Photo();
                break;
            case self::CARD_TYPE_GALLERY:
                return new Gallery();
                break;
            case self::CARD_TYPE_APP:
                return new App();
                break;
            case self::CARD_TYPE_PLAYER:
                return new Player();
                break;
            case self::CARD_TYPE_PRODUCT:
                return new Product();
                break;
            default:
                throw new TwitterFactoryException('Unknown card type: ' . (string)$type);
        }
    }
}
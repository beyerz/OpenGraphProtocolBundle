<?php
/**
 * @author Lance Bailey
 *
 */
namespace Beyerz\OpenGraphProtocolBundle\Libraries;

class Twitter extends BaseOpenGraphLibrary {
    const BASE_NS_KEY = 'twitter:';

    const CARD_TYPE_SUMMARY = "summary";
    const CARD_TYPE_SUMMARY_LARGE_IMAGE = "summary_large_image";
    const CARD_TYPE_PHOTO = "photo";
    const CARD_TYPE_GALLERY = "gallery";
    const CARD_TYPE_APP = "app";
    const CARD_TYPE_PLAYER = "player";
    const CARD_TYPE_PRODUCT = "product";

    protected $card;

    protected function getLibraryNamespace()
    {
        return self::BASE_NS_KEY;
    }
}
<?php
/**
 * Doghouse_Carousel_Model_Item
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Model_Item extends Mage_Core_Model_Abstract
{

    /**
     * Event prefix for easier listening to save/load before/after events
     * @var string
     */
    protected $_eventPrefix = 'dhcarousel_item';

    /**
     * Construct carousel item.
     */
    protected function _construct()
    {
        $this->_init('dhcarousel/item');
    }
}

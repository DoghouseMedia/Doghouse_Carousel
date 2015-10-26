<?php
/**
 * Doghouse_Carousel_Model_Resource_Item_Collection
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Model_Resource_Item_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    /**
     * Construct the carousel item collection.
     */
    protected function _construct()
    {
        $this->_init('dhcarousel/item');
    }

}

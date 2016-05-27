<?php
/**
 * Doghouse_Carousel_Model_Group
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Model_Group extends Mage_Core_Model_Abstract
{

    /**
     * Event prefix for easier listening to save/load before/after events
     * @var string
     */
    protected $_eventPrefix = 'dhcarousel_group';

    /**
     * Construct carousel group.
     */
    protected function _construct()
    {
        $this->_init('dhcarousel/group');
    }

    /**
     * Deal with clearing this specific carousels cache
     *
     * @return $this
     */
    protected function _beforeSave()
    {
        $tag = array(Doghouse_Carousel_Block_Carousel::CACHE_GROUP . '_' . $this->getId());
        mage::helper('dhcarousel')->clearCache($tag);
        return $this;
    }

}

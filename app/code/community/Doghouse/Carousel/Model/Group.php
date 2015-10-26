<?php

class Doghouse_Carousel_Model_Group extends Mage_Core_Model_Abstract
{

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

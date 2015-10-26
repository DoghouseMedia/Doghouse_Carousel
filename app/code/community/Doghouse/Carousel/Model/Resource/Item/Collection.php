<?php

class Doghouse_Carousel_Model_Resource_Item_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct()
    {
        $this->_init('dhcarousel/item');
    }

}

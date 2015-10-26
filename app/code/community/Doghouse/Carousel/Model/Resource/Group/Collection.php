<?php

class Doghouse_Carousel_Model_Resource_Group_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct()
    {
        $this->_init('dhcarousel/group');
    }

    public function getValuesForForm()
    {
        foreach ($this->getItems() as $item) {
            $values[$item->getId()] = $item->getName();
        }
        return $values;
    }

}

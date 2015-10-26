<?php

class Doghouse_Carousel_Model_Resource_Item extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('dhcarousel/item', 'id');
    }

    protected function _prepareDataForSave(Mage_Core_Model_Abstract $object)
	{
		$currentTime = Varien_Date::now();
		if ((!$object->getId() || $object->isObjectNew()) && !$object->getCreatedAt()) {
			$object->setCreatedAt($currentTime);
		}
		$object->setUpdatedAt($currentTime);
		$data = parent::_prepareDataForSave($object);
		return $data;
	}

}

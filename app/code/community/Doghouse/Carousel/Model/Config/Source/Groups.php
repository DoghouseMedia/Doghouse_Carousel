<?php
/**
 * Doghouse_Carousel_Model_Config_Source_Groups
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Model_Config_Source_Groups extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	/**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function getAllOptions()
    {
        $collection = Mage::getModel('dhcarousel/group')->getCollection()->toOptionArray();
        array_unshift($collection, array('value'=> '', 'label'=> Mage::helper('adminhtml')->__('-- Please Select --')));
        return $collection;
    }
}

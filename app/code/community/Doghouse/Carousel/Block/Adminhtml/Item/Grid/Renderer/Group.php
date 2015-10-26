<?php

class Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Group
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $item)
    {
        $group = Mage::getResourceSingleton('dhcarousel/group_collection')
            ->getItemById($item->getGroupId());

        if($group) {
            return $group->getName();
        }
        return '';
    }

}
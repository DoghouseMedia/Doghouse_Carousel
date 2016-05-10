<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Group
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Group
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Render group item preview.
     *
     * @param Varien_Object $item
     * @return string
     */
    public function render(Varien_Object $item)
    {
        $group = Mage::getResourceSingleton('dhcarousel/group_collection')
            ->getItemById($item->getGroupId());

        if ($group) {
            return $group->getName();
        }
        return '';
    }
}

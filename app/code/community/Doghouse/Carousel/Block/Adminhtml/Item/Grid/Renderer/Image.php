<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Image
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    /**
     * Render preview for image item.
     *
     * @param Varien_Object $item
     * @return string
     */
    public function render(Varien_Object $item)
    {
        $url    = Mage::helper('dhcarousel')->getImage($item);
        $alt    = $item->getName();
        $title  = Mage::helper('dhcarousel')->getImage($item);

        return sprintf('<img src="%s" alt="%s" title="%s" width="200px" style="max-height:100px" class="small-image-preview v-middle" />', $url, $alt, $title);
    }

}

<?php

class Doghouse_Carousel_Block_Adminhtml_Item_Grid_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

	public function render(Varien_Object $item)
	{
		$url 	= Mage::helper('dhcarousel')->getImage($item);
		$alt 	= $item->getName();
		$title	= Mage::helper('dhcarousel')->getImage($item);

		return sprintf('<img src="%s" alt="%s" title="%s" width="200px" class="small-image-preview v-middle" />', $url, $alt, $title);
	}

}
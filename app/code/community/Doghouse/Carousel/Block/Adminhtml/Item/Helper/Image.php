<?php

class Doghouse_Carousel_Block_Adminhtml_Item_Helper_Image extends Varien_Data_Form_Element_Image{

    protected function _getUrl(){

        $url = false;

        if ($this->getValue()) {
            $url =  Mage::helper('dhcarousel')->getImageUrl() . $this->getValue();
        }

        return $url;
    }

    public function getElementHtml()
    {
        $html = '';

        if ((string)$this->getValue()) {
            $url = $this->_getUrl();

            if( !preg_match("/^http\:\/\/|https\:\/\//", $url) ) {
                $url = Mage::getBaseUrl('media') . $url;
            }

            $html = '<a href="' . $url . '"'
                . ' onclick="imagePreview(\'' . $this->getHtmlId() . '_image\'); return false;">'
                . '<img src="' . $url . '" id="' . $this->getHtmlId() . '_image" title="' . $this->getValue() . '"'
                . ' alt="' . $this->getValue() . '" height="85" class="small-image-preview v-middle" />'
                . '</a> ';
        }
        $this->setClass('input-file');
        $html .= Varien_Data_Form_Element_Abstract::getElementHtml();
        // /$html .= $this->_getDeleteCheckbox();

        return $html;
    }

}
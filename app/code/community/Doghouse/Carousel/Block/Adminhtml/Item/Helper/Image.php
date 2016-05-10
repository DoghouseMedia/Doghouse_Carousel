<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Item_Helper_Image
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Item_Helper_Image extends Varien_Data_Form_Element_Image
{

    /**
     * Get carousel image url.
     *
     * @return bool|string
     */
    protected function _getUrl()
    {
        $url = false;

        if ($this->getValue()) {
            $url =  Mage::helper('dhcarousel')->getImageUrl() . $this->getValue();
        }

        return $url;
    }

    /**
     * Get carousel element html.
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = '';

        if ((string)$this->getValue()) {
            $url = $this->_getUrl();

            if (!preg_match("/^http\:\/\/|https\:\/\//", $url)) {
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

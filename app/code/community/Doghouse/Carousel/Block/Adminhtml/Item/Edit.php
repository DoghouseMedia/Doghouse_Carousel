<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Item_Edit
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Item_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    /**
     * Construct adminhtml carousel item edit form.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = "id";
        $this->_blockGroup = "dhcarousel";
        $this->_controller = "adminhtml_item";

        $this->_updateButton("save", "label", Mage::helper("dhcarousel")->__("Save Item"));
        $this->_updateButton("delete", "label", Mage::helper("dhcarousel")->__("Delete Item"));

        $this->_addButton("saveandcontinue", array(
            "label"     => Mage::helper("dhcarousel")->__("Save And Continue Edit"),
            "onclick"   => "saveAndContinueEdit()",
            "class"     => "save",
        ), -100);

        $this->_formScripts[] = "
			function saveAndContinueEdit(){
				editForm.submit($('edit_form').action+'back/edit/');
			}
		";
    }

    /**
     * Get header text.
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry("carousel_item_data") && Mage::registry("carousel_item_data")->getId()) {
            return Mage::helper("dhcarousel")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("carousel_item_data")->getName()));
        } else {
            return Mage::helper("dhcarousel")->__("Add Item");
        }
    }
}

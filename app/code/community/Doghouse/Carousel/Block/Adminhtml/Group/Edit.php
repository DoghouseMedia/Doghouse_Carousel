<?php

class Doghouse_Carousel_Block_Adminhtml_Group_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

	public function __construct()
	{
		parent::__construct();
		$this->_objectId = "id";
		$this->_blockGroup = "dhcarousel";
		$this->_controller = "adminhtml_group";

		$this->_updateButton("save", "label", Mage::helper("dhcarousel")->__("Save Group"));
		$this->_updateButton("delete", "label", Mage::helper("dhcarousel")->__("Delete Group"));

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

	public function getHeaderText()
	{
		if( Mage::registry("carousel_group_data") && Mage::registry("carousel_group_data")->getId() ){
		    return Mage::helper("dhcarousel")->__("Edit Group '%s'", $this->htmlEscape(Mage::registry("carousel_group_data")->getName()));
		} else {
		     return Mage::helper("dhcarousel")->__("Add Group");
		}
	}

}
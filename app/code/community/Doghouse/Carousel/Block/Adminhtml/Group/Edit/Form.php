<?php

class Doghouse_Carousel_Block_Adminhtml_Group_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

	protected function _prepareForm()
	{

		$form = new Varien_Data_Form(array(
			"id" => "edit_form",
			"action" => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
			"method" => "post"
		));

		$fieldset = $form->addFieldset("carousel_form", array("legend" => Mage::helper("dhcarousel")->__("Group information")));

		$fieldset->addField("name", "text", array(
			"label" => Mage::helper("dhcarousel")->__("Name"),
			"class" => "required-entry",
			"required" => true,
			"name" => "name"
		));

		$fieldset->addField("identifier", "text", array(
			"label" => Mage::helper("dhcarousel")->__("Identifier"),
			"name" => "identifier",
			"class" => "required-entry",
			"required" => true,
			"after_element_html" => "<small>&nbsp;&nbsp;&nbsp; If this is changed, the carousel can possibly stop working because the identifier is referenced in code</small>",
		));

		if($model = Mage::registry("carousel_group_data")) {
		    $form->setValues($model->getData());
		} elseif (Mage::getSingleton("adminhtml/session")->getCarouselGroupData()) {
			$form->setValues(Mage::getSingleton("adminhtml/session")->getCarouselGroupData());
			Mage::getSingleton("adminhtml/session")->setCarouselGroupData(null);
		}

		$form->setUseContainer(true);
		$this->setForm($form);

        Mage::dispatchEvent('dhcarousel_group_edit_form_prepare_form', array('block' => $this));

		return parent::_prepareForm();
	}

}

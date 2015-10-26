<?php

class Doghouse_Carousel_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container{

    public function __construct()
    {
        $this->_controller = "adminhtml_group";
        $this->_blockGroup = "dhcarousel";
        $this->_headerText = Mage::helper("dhcarousel")->__("Manage Carousel Groups");
        $this->_addButtonLabel = Mage::helper("dhcarousel")->__("Add Carousel Group");
        parent::__construct();
    }

}
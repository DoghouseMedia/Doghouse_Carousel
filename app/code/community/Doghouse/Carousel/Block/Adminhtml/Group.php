<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Group
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container{

    /**
     * Construct Adminhtml carousel group.
     */
    public function __construct()
    {
        $this->_controller = "adminhtml_group";
        $this->_blockGroup = "dhcarousel";
        $this->_headerText = Mage::helper("dhcarousel")->__("Manage Carousel Groups");
        $this->_addButtonLabel = Mage::helper("dhcarousel")->__("Add Carousel Group");
        parent::__construct();
    }

}
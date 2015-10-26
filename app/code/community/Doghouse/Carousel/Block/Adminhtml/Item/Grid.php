<?php

class Doghouse_Carousel_Block_Adminhtml_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId("carouselGrid");
        $this->setDefaultSort("id");
        $this->setUseAjax(true);
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel("dhcarousel/item")->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn("id", array(
            "header" => Mage::helper("dhcarousel")->__("ID"),
            "align" =>"right",
            "width" => "50px",
            "type" => "number",
            "index" => "id",
        ));

        $this->addColumn("name", array(
            "header" => Mage::helper("dhcarousel")->__("Name"),
            "index" => "name",
        ));

        $this->addColumn("group", array(
            "header" => Mage::helper("dhcarousel")->__("Group"),
            "index" => "group_id",
            "type" => "options",
            "options" => Mage::getResourceSingleton('dhcarousel/group_collection')->getValuesForForm(),
            "renderer" => "dhcarousel/adminhtml_item_grid_renderer_group",
        ));

        $this->addColumn("label", array(
            "header" => Mage::helper("dhcarousel")->__("Label"),
            "index" => "label",
        ));

        $this->addColumn("url", array(
            "header" => Mage::helper("dhcarousel")->__("URL"),
            "index" => "url",
        ));

        $this->addColumn("image", array(
            "header" => Mage::helper("dhcarousel")->__("Image"),
            "index" => "image",
            "width" => "200px",
            "renderer" => "dhcarousel/adminhtml_item_grid_renderer_image",
        ));

        $this->addColumn("item_order", array(
            "header" => Mage::helper("dhcarousel")->__("Order"),
            "index" => "item_order",
            "align" =>"right",
            "width" => "50px",
            "type" => "number",
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('dhcarousel')->__('Created At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'created_at',
        ));

        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('dhcarousel')->__('Updated At'),
            'type'      => 'date',
            'align'     => 'center',
            'index'     => 'updated_at',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('dhcarousel')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('dhcarousel')->__('Excel'));

        return parent::_prepareColumns();

    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_item', array(
            'label'=> Mage::helper('dhcarousel')->__('Remove'),
            'url'  => $this->getUrl('*/carousel/massRemove'),
            'confirm' => Mage::helper('dhcarousel')->__('Are you sure?')
        ));
        return $this;
    }

}
<?php

class Doghouse_Carousel_Block_Adminhtml_Group_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId("carouselGroupGrid");
        $this->setDefaultSort("id");
        $this->setUseAjax(true);
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel("dhcarousel/group")->getCollection());
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

        $this->addColumn("label", array(
            "header" => Mage::helper("dhcarousel")->__("Identifier"),
            "index" => "identifier",
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
            'url'  => $this->getUrl('*/carousel_group/massRemove'),
            'confirm' => Mage::helper('dhcarousel')->__('Are you sure?')
        ));
        return $this;
    }

}
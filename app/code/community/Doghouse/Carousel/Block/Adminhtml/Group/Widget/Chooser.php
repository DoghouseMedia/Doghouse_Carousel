
<?php

/**
* Carousel group chooser for Wysiwyg CMS widget
*
*/
class Doghouse_Carousel_Block_Adminhtml_Group_Widget_Chooser extends Doghouse_Carousel_Block_Adminhtml_Group_Grid
{
    /**
     * Block construction, prepare grid params
     *
     * @param array $arguments Object data
     */
    public function __construct($arguments=array())
    {
        parent::__construct($arguments);
        $this->setUseAjax(true);
        $this->setDefaultFilter(array('chooser_is_active' => '1'));
    }

    /**
     * Prepare chooser element HTML
     *
     * @param Varien_Data_Form_Element_Abstract $element Form Element
     * @return Varien_Data_Form_Element_Abstract
     */
    public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $uniqId = Mage::helper('core')->uniqHash($element->getId());
        $sourceUrl = $this->getUrl('*/carousel_widget/chooser', array('uniq_id' => $uniqId));

        $chooser = $this->getLayout()->createBlock('widget/adminhtml_widget_chooser')
            ->setElement($element)
            ->setTranslationHelper($this->getTranslationHelper())
            ->setConfig($this->getConfig())
            ->setFieldsetId($this->getFieldsetId())
            ->setSourceUrl($sourceUrl)
            ->setUniqId($uniqId);

        if ($element->getValue()) {
            $carouselGroup = Mage::getModel('dhcarousel/group')->load($element->getValue(), 'identifier');
            if ($carouselGroup->getId()) {
                $chooser->setLabel($carouselGroup->getName());
            }
        }

        $element->setData('after_element_html', $chooser->toHtml());
        return $element;
    }

    /**
     * Grid Row JS Callback
     *
     * @return string
     */
    public function getRowClickCallback()
    {
        $chooserJsObject = $this->getId();
        return '
                    function (grid, event) {
                        var trElement = Event.findElement(event, "tr");
                        var groupTitle = trElement.down("td").next().innerHTML;
                        var groupId = trElement.down("td").next().next().innerHTML.replace(/^\s+|\s+$/g,"");
                        '.$chooserJsObject.'.setElementValue(groupId);
                        '.$chooserJsObject.'.setElementLabel(groupTitle);
                        '.$chooserJsObject.'.close();
                    }
               ';
    }

    /**
     * Formats url of carousel widget chooser
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/carousel_widget/chooser', array('_current' => true));
    }

    /**
     * Extends parent function getRowUrl so grid rows are not editable
     *
     * @param Doghouse_Carousel_Model_Group $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return '#';
    }

    /**
     * Do not prepare mass action as set by parent
     *
     * @return string
     */
    protected function _prepareMassaction()
    {
        return '';
    }
}

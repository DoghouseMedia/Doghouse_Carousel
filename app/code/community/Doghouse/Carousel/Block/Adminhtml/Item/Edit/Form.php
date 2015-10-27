<?php
/**
 * Doghouse_Carousel_Block_Adminhtml_Item_Edit_Form
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Adminhtml_Item_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare carousel item form.
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     * @throws Exception
     */
    protected function _prepareForm()
    {

        $form = new Varien_Data_Form(
            array(
                "id"      => "edit_form",
                "action"  => $this->getUrl("*/*/save", array("id" => $this->getRequest()->getParam("id"))),
                "method"  => "post",
                "enctype" => "multipart/form-data",
            )
        );

        $fieldset = $form->addFieldset(
            "carousel_form", array("legend" => Mage::helper("dhcarousel")->__("Item information"))
        );
        $fieldset->addType('image', 'Doghouse_Carousel_Block_Adminhtml_Item_Helper_Image');

        $fieldset->addField(
            "name", "text", array(
                "label"              => Mage::helper("dhcarousel")->__("Name"),
                "class"              => "required-entry",
                "required"           => true,
                "name"               => "name",
                "after_element_html" => "<small>&nbsp;&nbsp;&nbsp; alt attribute on the image</small>",
            )
        );

        $fieldset->addField(
            "group_id", "select", array(
                "label"    => Mage::helper("dhcarousel")->__("Group"),
                "class"    => "required-entry",
                "required" => true,
                "name"     => "group_id",
                "values"   => Mage::getResourceSingleton('dhcarousel/group_collection')->getValuesForForm(),
            )
        );

        $fieldset->addField(
            "active", "select", array(
                "label"    => Mage::helper("dhcarousel")->__("Active"),
                "class"    => "required-entry",
                "required" => true,
                "name"     => "active",
                "values"   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
            )
        );

        $fieldset->addField(
            "label", "text", array(
                "label"              => Mage::helper("dhcarousel")->__("Label"),
                "name"               => "label",
                "after_element_html" => "<small>&nbsp;&nbsp;&nbsp; title attribute on the anchor and image</small>",
            )
        );

        $fieldset->addField(
            "url", "text", array(
                "label"              => Mage::helper("dhcarousel")->__("Link to URL"),
                "name"               => "url",
                "after_element_html" => "<small>&nbsp;&nbsp;&nbsp; example: about-magento (do not prepend/append forward-slash)</small>",
            )
        );

        $fieldset->addField(
            "image", "image", array(
                "label"    => Mage::helper("dhcarousel")->__("Image"),
                "class"    => "required-entry",
                "required" => true,
                "name"     => "image",
            )
        );

        $fieldset->addField(
            "item_order", "text", array(
                "label"              => Mage::helper("dhcarousel")->__("Order"),
                "after_element_html" => "<small>&nbsp;&nbsp;&nbsp;carousel sorts from low to high</small>",
                "name"               => "item_order",
            )
        );

        $fieldset->addField(
            'from_date', 'date', array(
                'name'               => 'from_date',
                'label'              => Mage::helper('dhcarousel')->__('Start Date'),
                'after_element_html' => '<small>Date this entry must appear</small>',
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => 'yyyy-MM-dd'
            )
        );

        $fieldset->addField(
            'to_date', 'date', array(
                'name'               => 'to_date',
                'label'              => Mage::helper('dhcarousel')->__('End Date'),
                'after_element_html' => '<small>Date this entry must be removed</small>',
                'image'              => $this->getSkinUrl('images/grid-cal.gif'),
                'format'             => 'yyyy-MM-dd'


            )
        );

        $fieldset->addField(
            "gtm_event_code", "text", array(
                "label"              => Mage::helper("dhcarousel")->__("Google Tag Manager Event code"),
                "after_element_html" => "<small>event_name for GTM event tracking. e.g video_click_one</small>",
                "name"               => "gtm_event_code",
            )
        );

        $productLink = $fieldset->addField(
            'product_link', 'label', array(
                'name'     => 'product_link',
                'label'    => Mage::helper('dhcarousel')->__('Product'),
                'class'    => 'widget-option',
                'required' => false,
            )
        );

        // Prepare product widget chooser
        $productField = $this->getLayout()->createBlock('adminhtml/catalog_product_widget_chooser');
        if ($productField instanceof Varien_Object) {
            $productField->setConfig($this->getChooserConfig())
                ->setFieldsetId($fieldset->getId())
                ->setTranslationHelper(Mage::helper('dhcarousel'))
                ->prepareElementHtml($productLink);
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        Mage::dispatchEvent('dhcarousel_item_edit_form_prepare_form', array('block' => $this));

        if ($model = Mage::registry("carousel_item_data")) {
            $form->setValues($model->getData());

            if ($model->getProductId()) {
                $form->getElement('product_link')
                    ->setValue('product/' . $model->getProductId());
            }

        } elseif (Mage::getSingleton("adminhtml/session")->getCarouselItemData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getCarouselItemData());
            Mage::getSingleton("adminhtml/session")->setCarouselItemData(null);
        }

        return parent::_prepareForm();
    }

    /**
     * Carousel item product chooser.
     *
     * @return array
     */
    public function getChooserConfig()
    {
        return array(
            'button' => array(
                'open' => Mage::helper('catalog')->__('Select Product...')
            )
        );
    }

}

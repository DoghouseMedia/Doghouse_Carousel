<?php

class Doghouse_Carousel_Adminhtml_Carousel_GroupController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu("cms/dhcarousel_groups");

        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__("Manage Carousel Groups"));
        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('dhcarousel/adminhtml_group', 'carousel.groups'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_title($this->__("New Carousel Group"));
        $this->_initAction();

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("dhcarousel/adminhtml_group_edit"));

        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__("Edit Carousel Group"));
        $this->_initAction();

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("dhcarousel/group")->load($id);

        if ($model->getId()) {
            Mage::register("carousel_group_data", $model);

            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("dhcarousel/adminhtml_group_edit"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Group does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function saveAction()
    {
        $post_data = $this->getRequest()->getPost();

        if ($post_data) {

            try {

                $model = Mage::getModel("dhcarousel/group")
                    ->addData($post_data)
                    ->setId($this->getRequest()->getParam("id"))
                    ->save();

                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Group was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setCarouselGroupData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setCarouselGroupData($this->getRequest()->getPost());
                if($this->getRequest()->getParam("id")) {
                    $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                } else {
                    $this->_redirect("*/*/new");
                }
                return;
            }

        }
        $this->_redirect("*/*/");
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam("id") > 0 ) {
            try {
                $model = Mage::getModel("dhcarousel/group");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Group was successfully deleted"));
                $this->_redirect("*/*/");
            }
            catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction()
    {
        try {
            $ids = $this->getRequest()->getPost('ids', array());
            foreach ($ids as $id) {
                  $model = Mage::getModel("dhcarousel/group");
                  $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Group(s) successfully removed"));
        }
        catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        return $this->getResponse()->setBody(
            $this->getLayout()->createBlock('dhcarousel/adminhtml_group_grid')->toHtml()
        );
    }

    /**
     * Check acl access for carousel
     *
     * @return mixed
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('dhcarousel');
    }

}

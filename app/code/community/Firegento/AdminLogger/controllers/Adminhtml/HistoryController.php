<?php

class Firegento_AdminLogger_Adminhtml_HistoryController extends Mage_Adminhtml_Controller_Action {

    /**
     * @return Firegento_AdminLogger_Adminhtml_HistoryController
     */
    protected function _initAction() {
        $this->loadLayout();
        $this->_setActiveMenu('firegento_adminlogger/history');
        $this->_addBreadcrumb(Mage::helper('firegento_adminlogger')->__('AdminLogger'), Mage::helper('firegento_adminlogger')->__('History'));
        return $this;
    }

    public function indexAction() {
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * reverts a history entry
     */
    public function revertAction() {
        $history = Mage::getModel('firegento_adminlogger/history')->load($this->getRequest()->getParam('id'));
        $model = $history->getOriginalModel();
        $model->addData($history->getDecodedContentDiff());
        $model->save();
        Mage::getSingleton('core/session')->addSuccess(
            $this->__(
                'Revert of %1$s with id %2$d successful',
                $history->getObjectType(),
                $history->getObjectId()
            )
        );
        $this->_redirect('*/*/index');
    }


}
<?php

/**
* OrangeMantra.
*
* Do not edit or add to this file if you wish to upgrade this extension to newer
* version in the future.
*
* @category    OrangeMantra
* @package     OM_Support
* @author      Shiv Kr Maurya (Senior Magento Developer)
* @copyright   Copyright (c) 2017 OrangeMantra
*/  
namespace OM\Support\Controller\Adminhtml\Support;
 
use OM\Support\Controller\Adminhtml\Support;
 
class Edit extends Support
{
   /**
     * @return void
     */
    public function execute()
    {
      $supportId = $this->getRequest()->getParam('id');
        /** @var \OM\Support\Model\Support $model */
        $model = $this->_supportFactory->create();
        if ($supportId) {
            $model->load($supportId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This support no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $data = $this->_session->getSupportData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('support_support', $model);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('OM_Support::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Support'));
        return $resultPage;
    }
}
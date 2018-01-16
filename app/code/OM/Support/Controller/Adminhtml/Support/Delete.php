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
 
class Delete extends Support
{
   /**
	* @return void
	*/
    public function execute()
    {
	    $supportId = (int) $this->getRequest()->getParam('id');
	    if ($supportId) {
		 /** @var $supportModel \OM\Support\Model\Support */
		    $supportModel = $this->_supportFactory->create();
		 	$supportModel->load($supportId);
			if (!$supportModel->getId()) {
				$this->messageManager->addError(__('This support no longer exists.'));
			} else {
				try {
				    $supportModel->delete();
				    $this->messageManager->addSuccess(__('The support has been deleted.'));
				    $this->_redirect('*/*/');
				    return;
				} catch (\Exception $e) {
					$this->messageManager->addError($e->getMessage());
					$this->_redirect('*/*/edit', ['id' => $supportModel->getId()]);
				}
			}
	    }
    }
}
 
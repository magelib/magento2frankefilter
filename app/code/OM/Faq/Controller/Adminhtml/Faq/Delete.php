<?php
 
 /**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Faq
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Faq\Controller\Adminhtml\Faq;
 
use OM\Faq\Controller\Adminhtml\Faq;
 
class Delete extends Faq
{
   /**
	* @return void
	*/
   public function execute()
   {
	    $faqId = (int) $this->getRequest()->getParam('id');
 
	    if ($faqId) {
		 /** @var $faqModel \OM\Faq\Model\Faq */
			$faqModel = $this->_faqFactory->create();
			$faqModel->load($faqId);
			if (!$faqModel->getId()) {
				$this->messageManager->addError(__('This faq no longer exists.'));
			} else {
			    try {
				  $faqModel->delete();
				  $this->messageManager->addSuccess(__('The faq has been deleted.'));
				  $this->_redirect('*/*/');
				  return;
			    } catch (\Exception $e) {
				   $this->messageManager->addError($e->getMessage());
				   $this->_redirect('*/*/edit', ['id' => $faqModel->getId()]);
			    }
			}
	    }
    }
}
 
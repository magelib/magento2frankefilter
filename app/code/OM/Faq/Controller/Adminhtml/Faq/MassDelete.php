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
 
class MassDelete extends Faq
{
   /**
    * @return void
    */
   public function execute()
   {
      $faqIds = $this->getRequest()->getParam('faq');
      foreach ($faqIds as $faqId) {
        try {
           /** @var $faqModel \OM\Faq\Model\Faq */
            $faqModel = $this->_faqFactory->create();
            $faqModel->load($faqId)->delete();
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
      }
      if (count($faqIds)) {
          $this->messageManager->addSuccess(
              __('A total of %1 record(s) were deleted.', count($faqIds))
          );
      }
      $this->_redirect('*/*/index');
   }
}
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
 
class MassDelete extends Support
{
   /**
    * @return void
    */
  public function execute()
  {
    $supportIds = $this->getRequest()->getParam('support');
      foreach ($supportIds as $supportId) {
          try {
             /** @var $supportModel \OM\Support\Model\Support */
              $supportModel = $this->_supportFactory->create();
              $supportModel->load($supportId)->delete();
          } catch (\Exception $e) {
              $this->messageManager->addError($e->getMessage());
          }
      }
      if (count($supportIds)) {
          $this->messageManager->addSuccess(
              __('A total of %1 record(s) were deleted.', count($supportIds))
          );
      }
      $this->_redirect('*/*/index');
  }
}
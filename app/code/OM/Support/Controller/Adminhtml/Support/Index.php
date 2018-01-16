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

class Index extends Support
{
  /**
   * @return void
   */
 public function execute()
 {
    if ($this->getRequest()->getQuery('ajax')) {
          $this->_forward('grid');
          return;
    }
    /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
    $resultPage = $this->_resultPageFactory->create();
    $resultPage->setActiveMenu('OM_Support::main_menu');
    $resultPage->getConfig()->getTitle()->prepend(__('Support'));

    return $resultPage;
  }
}
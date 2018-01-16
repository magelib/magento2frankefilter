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
 
class NewAction extends Support
{
   /**
     * Create new support action
     *
     * @return void
     */
   public function execute()
   {
      $this->_forward('edit');
   }
}
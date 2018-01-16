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
 
class Grid extends Faq
{
   /**
     * @return void
     */
   public function execute()
   {	
      return $this->_resultPageFactory->create();
   }
}
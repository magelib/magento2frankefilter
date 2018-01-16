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
namespace OM\Support\Block; 

use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use OM\Support\Block\SupportList;
 
class View extends SupportList
{
	public function getSupportProduct($id){
		if(!(int)$id) return;
		$supportModel = $this->_supportFactory->create();
		$supportModel->load($id);
		return  $supportModel;
	}	
}
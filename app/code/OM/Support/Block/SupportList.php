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
use OM\Support\Model\SupportFactory;

class SupportList extends Template
{
    /**
    * @var \OM\Support\Model\SupportFactory
    */
    protected $_supportCategory;
    protected $_supportFactory;
    /**
    * @param Template\Context $context
    * @param SupportFactory $SupportFactory
    * @param array $data
    */

    public function __construct(
    Template\Context $context,
    \Magento\Catalog\Model\CategoryFactory $supportCategory,
    SupportFactory $supportFactory,   
    array $data = []
    ) {
        $this->_supportCategory = $supportCategory;
	    $this->_supportFactory = $supportFactory;
        parent::__construct($context, $data);
    }
	/*protected function _getSupportCategories(){
			$supportCategories = $this->_scopeConfig->getValue('support_config/general/support_categories',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
			return  explode(',',$supportCategories);	
	}*/
	
	public function getSupportCategories()
    {	
		//$supportCategories = $this->_getSupportCategories();
		$category = $this->_supportCategory->create();
		$collection = $category
		  ->getCollection()
		  ->addAttributeToSelect('*')					
		  ->addAttributeToFilter('parent_id',array('eq' => 6))						  
		  //->addAttributeToFilter('entity_id',array('in' => $supportCategories))						  
		  ->addAttributeToFilter('is_active',1)						 
		  ->setOrder('position','ASC')
		  ;	
		return $collection; 
	} 
	
	public function getCategorymodel($id)
    {
		$_category = $this->_supportCategory->create();
        $_category->load($id);
        return $_category;
    }
	public function getSupportChildCategories($parent_cat)
    {	
		$category = $this->_supportCategory->create();
		$collection = $category
		  ->getCollection()
		  ->addAttributeToSelect('*')					
		  ->addAttributeToFilter('parent_id',array('eq' => $parent_cat))						  
		  ->addAttributeToFilter('is_active',1)						 
		  ->setOrder('position','ASC')
		  ;	
		return $collection;
	}
	
	public function getBrandModels($brandid){
		if(!(int)$brandid) return;		
		$support = $this->_supportFactory->create();			
		$collection = $support
		  ->getCollection()
		  ->addFieldToSelect('*')					
		  ->addFieldToFilter('support_category',array('finset' => $brandid)) 			  						  
		  ->addFieldToFilter('status',1)						 
		  ->setOrder('support_title ','ASC');	
		return $collection;
	}
}
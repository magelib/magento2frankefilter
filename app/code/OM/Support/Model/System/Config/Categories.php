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
namespace OM\Support\Model\System\Config; 

use Magento\Framework\Option\ArrayInterface;

class Categories implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
	 
	protected $_categoryHelper;
	protected $_categoryHelper2;

    public function __construct(\Magento\Catalog\Helper\Category $catalogCategory, \Magento\Catalog\Model\CategoryFactory $categoryFactory)
    {
        $this->_categoryHelper = $catalogCategory;
        $this->_categoryHelper2 = $categoryFactory;
    }
	
	public function getCategories()
    {	
		
		$category = $this->_categoryHelper2->create();
		$collection = $category
		  ->getCollection()
		  ->addAttributeToSelect('*')					
		  ->addAttributeToFilter('parent_id',array('eq' => 2))						  
		  ->addAttributeToFilter('is_active',1)						 
		  ->setOrder('position','ASC')
		  ;	
		return $collection;

	}
	public function getChildCategories($parent_cat)
    {	
		
		$category = $this->_categoryHelper2->create();
		$collection = $category
		  ->getCollection()
		  ->addAttributeToSelect('*')					
		  ->addAttributeToFilter('parent_id',array('eq' => $parent_cat))						  
		  ->addAttributeToFilter('is_active',1)						 
		  ->setOrder('position','ASC')
		  ;	
		return $collection;

	}
	public function toOptionArray()
    {
        $arr = $this->toArray();
        $ret = [];
        foreach ($arr as $key => $value)
        {
            $ret[$key] = [
                'value' => $key,
                'label' => $value
            ];
        }
        return $ret;
    }
	public function toArray()
    {
        $categories = $this->getCategories();
        $catagoryList = array();
        foreach ($categories as $category){
            $catagoryList[$category->getId()] = __($category->getName());
			if($this->getChildCategories($category->getId())->count()){
				foreach ($this->getChildCategories($category->getId()) as $subcategory){
					$catagoryList[$subcategory->getId()] = '__'.__($subcategory->getName());
					if($this->getChildCategories($subcategory->getId())->count()){
						 foreach ($this->getChildCategories($subcategory->getId()) as $subsubcategory){
							$catagoryList[$subsubcategory->getId()] = '___'.__($subsubcategory->getName());								
						}
					}		
				}
			}		
        }
        return $catagoryList;
    }
}
     
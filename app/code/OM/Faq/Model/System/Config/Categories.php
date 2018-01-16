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
namespace OM\Faq\Model\System\Config; 

use Magento\Framework\Option\ArrayInterface;

class Categories implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
	 
	protected $_categoryHelper2;

    public function __construct(\OM\Support\Model\SupportFactory $faqcategoryFactory)
    {
        $this->_categoryHelper2 = $faqcategoryFactory;
    }
	
	public function getCategories()
    {	
		
		$category = $this->_categoryHelper2->create();
		$collection = $category
		  ->getCollection()	
		  ->addFieldToSelect('*')	
		  ->addFieldToFilter('status','1'); 

		return $collection;

	}

	public function toOptionArray()
    {
        /*$arr = $this->toArray();
        $ret = [];
        $ret[0] = "";
        foreach ($arr as $key => $value)
        {
           
            $ret[$key] = $value;
           
        } 
        return $ret;  */

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
            $catagoryList[$category->getId()] = __($category->getSupportTitle());
			
        } 
        return $catagoryList;
    }
}
     
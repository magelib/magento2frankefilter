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
namespace OM\Support\Block\Adminhtml\Grid\Renderer;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;

class Category extends AbstractRenderer
{
	protected $_categoryFactory;

    public function __construct(       
        Context $context,
		\Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = array()
    )
    {
		$this->_categoryFactory = $categoryFactory;		
        parent::__construct($context, $data);
    }

    /**
     * Renders grid column
     *
     * @param \Magento\Framework\DataObject $row
     * @return mixed
     */
    public function _getValue(\Magento\Framework\DataObject $row)
    {       
       	$value = parent::_getValue($row);  
		if($value == '') return '';
		$category = $this->_categoryFactory->create();
		$collection = $category
					  ->getCollection()
					  ->addAttributeToSelect('*')					
					  ->addAttributeToFilter('entity_id',array('in' => explode(',',$value)))					 
					  ->setOrder('position','ASC');
		foreach($collection as $category){
			$selectedCategory[] = $category->getName();		
		}
	    return implode(',',$selectedCategory);
	    return $value;
    }
}
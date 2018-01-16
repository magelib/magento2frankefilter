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

class Image extends AbstractRenderer
{
	protected $_categoryFactory;
    protected $_storeManager;

    public function __construct(       
        Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = array()
    )
    {	
        $this->_storeManager = $storeManager;
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
        $baseUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
       	$value = parent::_getValue($row);
		if(	$value == '') return;
        $url =  $baseUrl."pub/media/";
	    return '<img src="'.$url.$value.'" width="100" />';
    }
} 
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
namespace OM\Support\Helper;
     
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
 
class Data extends AbstractHelper
{	
   const XML_PATH_ENABLED      			= 'support_config/general/enable_in_frontend'; 
   const XML_PATH_HEAD_TITLE  			= 'support_config/general/support_heading';
   const XML_PATH_SUPPORT_CATEGORY  	= 'support_config/general/support_categories';
 
	/**
	 * @param Context $context
	 * @param ScopeConfigInterface $scopeConfig
	 */
	public function __construct(
	   Context $context
	) {
	   parent::__construct($context);
	}
 
   /**
	 * Check for module is enabled in frontend
	 *
	 * @return bool
	 */
    public function isEnabledInFrontend($store = null)
    {
	    return $this->scopeConfig->getValue(
			self::XML_PATH_ENABLED,
			ScopeInterface::SCOPE_STORE
	    );
    }
  
    /**
	 * Get head title for support list page
	 *
	 * @return string
	 */
    public function getHeadTitle()
    {
	    return $this->scopeConfig->getValue(
		    self::XML_PATH_HEAD_TITLE,
		    ScopeInterface::SCOPE_STORE
	    );
    }

    public function getSupportCategory(){
	    return $this->scopeConfig->getValue(
		    self::XML_PATH_SUPPORT_CATEGORY,
		    ScopeInterface::SCOPE_STORE
	    );
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
     
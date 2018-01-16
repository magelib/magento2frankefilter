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
namespace OM\Faq\Block;
use Magento\Framework\View\Element\Template;
use OM\Faq\Model\FaqFactory;
 
class FaqList extends Template
{
  /**
  * @var \OM\Faq\Model\FaqFactory
  */   
  protected $_faqFactory; 
 
  /**
  * @param Template\Context $context
  * @param FaqFactory $FaqFactory
  * @param array $data
  */
  public function __construct(
    Template\Context $context,
		FaqFactory $faqFactory,
		array $data = []
		)
    {
      $this->_faqFactory = $faqFactory;
      parent::__construct($context, $data);
    }
 
   /**
     * Set faq collection
     */
  protected  function _construct()
  {
    parent::_construct();

    $faqcategoryid = $this->getRequest()->getParam('id');

    if($faqcategoryid=="")
    {
      $faqcategoryid = 1;
    } 

		$collection = $this->_faqFactory->create()->getCollection();
		$collection->addFieldToFilter('status',['eq' => \OM\Faq\Model\System\Config\Status::ENABLED]);
		$collection->addFieldToFilter('faqcategory', $faqcategoryid); 
    $this->setCollection($collection); 
  } 
 
	public function getCurrentStoreId() 
  {
 		return $this->_storeManager->getStore()->getStoreId(); 
	}

	public function getMediaPath()
  {
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
		$currentStore = $storeManager->getStore();
		return $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}
}
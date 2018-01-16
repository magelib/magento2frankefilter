<?php
namespace OM\Faq\Block;

use Magento\Framework\View\Element\Template;
use OM\Faq\Helper\Data;
use OM\Faq\Model\FaqFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Faq extends Template
{
   /**
    * @var \OM\Faq\Helper\Data
    */
   protected $_dataHelper;
   protected $_storeManager;
   protected $_directory_list;
   protected $_status;
 
   /**
    * @var \OM\Faq\Model\FaqFactory
    */
   protected $_faqFactory;

   /**
    * @param Template\Context $context
    * @param Data $dataHelper
    * @param FaqFactory $faqFactory
    */
   public function __construct(
      Template\Context $context,
      Data $dataHelper,
      FaqFactory $faqFactory,
	    DirectoryList $directory_list
   ) {
      $this->_dataHelper = $dataHelper;
      $this->_faqFactory = $faqFactory;
      parent::__construct($context);
	    $this->_directory_list = $directory_list;
   }
	
	 public function getSlideModes()
   {    
		return  \OM\Faq\Model\System\Config\FaqList\Slidemode::getSlideModes();
   }

   /**
    * Get five latest faq
    *
    * @return \OM\Faq\Model\ResourceModel\Faq\Collection
    */
   public function getLatestFaq()
   {	 
      $collection = $this->_faqFactory->create()->getCollection();
      $collection->addFieldToFilter('status',['eq' => \OM\Faq\Model\System\Config\Status::ENABLED]);
	    $collection->addFieldToFilter('store_id', [['finset' => $this->getCurrentStoreId()],['finset' => 0]]);
      $collection->getSelect()->order('created_at DESC');
      return $collection;
   }

   public function getConfig($key)
   {
  		if($key != ''){
  			return $this->_scopeConfig->getValue($key, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
  		}
	 }
	
	public function getMediaPath()
  {
		$_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
		$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
		$currentStore = $storeManager->getStore();
		return $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}

	public function getCurrentStoreId() 
  {
		 return $this->_storeManager->getStore()->getStoreId(); 
 	}
	
}
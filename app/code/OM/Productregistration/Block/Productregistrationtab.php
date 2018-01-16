<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Marketplace
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace OM\Productregistration\Block;

/*
 * Webkul Marketplace Order Salesdetail Block
 */
use Magento\Sales\Model\Order;
use Magento\Customer\Model\Customer;

class Productregistrationtab extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customer;

    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $order;

    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @param Context                                   $context
     * @param array                                     $data
     * @param Customer                                  $customer
     * @param Order                                     $order
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Customer\Model\Session           $customerSession
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Order $order,
        Customer $customer,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->Customer = $customer;
        $this->Order = $order;
        $this->_objectManager = $objectManager;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('Product Registration'));
    }

    public function getCustomerId()
    {
        return $this->_customerSession->getCustomerId();
    }

    /**
     * @return bool|\OM\Productregistration\Model\ResourceModel\Productregistration\Collection
     */
    public function getCollection()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $customerData = $customerSession->getCustomer();

        $collection = $this->_objectManager->create(
            'OM\Productregistration\Model\Productregistration'
        )->getCollection()->addFieldToFilter('email',$customerData->getEmail());

        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        // //get values of current limit
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest
         ()->getParam('limit') : 10; 

        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        return $collection; 

    }

    public function getOrderById($orderId = '')
    {
        return $this->_objectManager->create('Magento\Sales\Model\Order')->load($orderId);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        $customerData = $customerSession->getCustomer();
       
        $customerId = $this->getCustomerId(); 
        $collection = $this->_objectManager->create(
            'OM\Productregistration\Model\Productregistration'
        )->getCollection()->addFieldToFilter('email',$customerData->getEmail());

        parent::_prepareLayout();
        if ($collection) {
            $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager','my.custom.pager');
            $pager->setAvailableLimit([10=>10,20=>20,'all'=>'all']);
            $pager->setCollection($collection);
            $this->setChild('pager', $pager); 

        } 


        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {

        return $this->getChildHtml('pager');
    } 

    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl(); // Give the current url of recently viewed page
    }
}

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
namespace OM\Faq\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use OM\Faq\Model\FaqcategoryFactory;
use OM\Faq\Helper\Data;
use OM\Faq\Controller\Faq;

class View extends Faq
{ 

    /**
      * @var \Magento\Framework\View\Result\PageFactory
      */
      protected $_pageFactory;
     
      /**
      * @var \OM\Faq\Helper\Data
      */
      protected $_dataHelper;
     
      /**
      * @var \OM\Faq\Model\Faq
      */
      protected $_faqFactory;

       /**
      * @var \OM\Faq\Model\Faqcategory
      */
      protected $_faqcategoryFactory;
     
     
      /**
      * @param Context $context
      * @param PageFactory $pageFactory
      * @param Data $dataHelper
      * @param Faq $faqFactory
      * @param Faqcategory $faqcategoryFactory
      */
      public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $dataHelper,
        FaqFactory $faqFactory,
        FaqcategoryFactory $faqcategoryFactory
      ) {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_dataHelper = $dataHelper;
        $this->_faqFactory = $faqFactory;
        $this->_faqcategoryFactory = $faqcategoryFactory;
      }
 

    public function execute()
    {
        $faqcategoryid = $this->getRequest()->getParam('id');
        $faqcategory = $this->_faqcategoryFactory->create()->load($faqcategoryid);
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set($faqcategory->getNamespace());
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb('faq',
            [
                'label' => __('Faq'),
                'title' => __('Faq')
            ]
        );
     
        return $pageFactory;
    }
}
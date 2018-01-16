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
namespace OM\Support\Controller;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use OM\Support\Helper\Data;
use OM\Support\Model\SupportFactory;

abstract class Support extends Action
{
   /**
    * @var \Magento\Framework\View\Result\PageFactory
    */
   protected $_pageFactory;
 
   /**
    * @var \OM\Support\Helper\Data
    */
   protected $_dataHelper;
 
   /**
    * @var \OM\Support\Model\Support
    */
   protected $_supportFactory;

 
   /**
    * @param Context $context
    * @param PageFactory $pageFactory
    * @param Data $dataHelper
    * @param Support $supportFactory
    */
    public function __construct(
      Context $context,
      PageFactory $pageFactory,
      Data $dataHelper,
      SupportFactory $supportFactory
    ) {
      parent::__construct($context);
      $this->_pageFactory = $pageFactory;
      $this->_dataHelper = $dataHelper;
      $this->_supportFactory = $supportFactory;
    }
 
    /**
     * Dispatch request
     *
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
    */
    public function dispatch(RequestInterface $request)
    {
      if ($this->_dataHelper->isEnabledInFrontend()) {
         $result = parent::dispatch($request);
         return $result;
      } else {
         $this->_forward('noroute');
      }
    }
}
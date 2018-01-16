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
namespace OM\Faq\Controller;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;

use OM\Faq\Helper\Data;
use OM\Faq\Model\FaqFactory;
use OM\Faq\Model\FaqcategoryFactory;

abstract class Faq extends Action
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
    } 
    else 
    {
      $this->_forward('noroute');
    }
  }
}
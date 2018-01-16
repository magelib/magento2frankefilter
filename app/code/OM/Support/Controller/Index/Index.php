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
namespace OM\Support\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use OM\Support\Model\SupportFactory;
use OM\Support\Helper\Data;
use OM\Support\Controller\Support;
//use \Magento\Catalog\Model\CategoryFactory;

class Index extends Support
{
    public function execute()
    {
		$pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set(
            $this->_dataHelper->getHeadTitle()
        );
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
 
        $breadcrumbs->addCrumb('support',
            [
                'label' => __('Support'),
                'title' => __('Support')
            ]
        );
        return $pageFactory;
    }
}
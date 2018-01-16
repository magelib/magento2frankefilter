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
namespace OM\Support\Controller\Brandmodels;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use OM\Support\Model\SupportFactory;
use OM\Support\Helper\Data;
use OM\Support\Controller\Support;

class View extends Support
{
    public function execute()
    {
        $catId = $this->getRequest()->getParam('id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->create('Magento\Catalog\Model\Category')->load($catId);
        //$this->_objectManager->get('Magento\Framework\Registry')
            //->register('supportData', $support);
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set($category->getName());
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');

        $breadcrumbs->addCrumb('support',
            [
                'label' => __('Support for'),
                'title' => __('Support for'),
                'link' => $this->_url->getUrl('support')
            ]
        );
        $breadcrumbs->addCrumb('category',
            [
                'label' => $category->getName(),
                'title' => $category->getName()
            ]
        );
        return $pageFactory;
    }
} 
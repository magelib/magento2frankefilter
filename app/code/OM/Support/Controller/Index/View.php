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

class View extends Support
{
    public function execute()
    {
        $supportId = $this->getRequest()->getParam('id');
        $support = $this->_supportFactory->create()->load($supportId);
        $this->_objectManager->get('Magento\Framework\Registry')
            ->register('supportData', $support);
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set($support->getTitle());
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb('support',
            [
                'label' => __('Support'),
                'title' => __('Support'),
                'link' => $this->_url->getUrl('support')
            ]
        );
        $breadcrumbs->addCrumb('support',
            [
                'label' => $support->getTitle(),
                'title' => $support->getTitle()
            ]
        );
        return $pageFactory;
    }
}
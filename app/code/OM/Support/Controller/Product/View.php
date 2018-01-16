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
namespace OM\Support\Controller\Product;

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
        $catId = $this->getRequest()->getParam('m');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->create('Magento\Catalog\Model\Category')->load($catId);
        $categoryurl = $category->getUrl();
        $caregoryredirecturl = substr(trim($categoryurl), 0, -5);

        $parentcategoryid = $category->getParentCategory()->getId(); 
        if($parentcategoryid!=3)
        {
            $parentcategoryname = $category->getParentCategory()->getName();
            $parentcategoryurl = $category->getParentCategory()->getUrl();
            $parentcategoryredirecturl = substr(trim($parentcategoryurl), 0, -5);
        }

        $brandId = $this->getRequest()->getParam('id');
        $support = $this->_supportFactory->create()->load($brandId);
        $this->_objectManager->get('Magento\Framework\Registry')
            ->register('supportData', $support);
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set($support->getTitle());
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
      
        $breadcrumbs->addCrumb('support',
            [
                'label' => __('Support'),
                'title' => __('Support'),
                'link' => $this->_url->getUrl('support')
            ]
        );

        if($parentcategoryid!=6)
        {
            $breadcrumbs->addCrumb('parentcategory',
                [
                    'label' => $parentcategoryname,
                    'title' => $parentcategoryname,
                    'link' => $parentcategoryredirecturl
                ] 
            );
        }

        $breadcrumbs->addCrumb('category',
            [
                'label' => $category->getName(),
                'title' => $category->getName(),
                'link' => $caregoryredirecturl
            ]
        );

        $breadcrumbs->addCrumb('supporttitle',
            [
                'label' => $support->getSupportTitle(),
                'title' => $support->getSupportTitle()
            ]
        );

        return $pageFactory; 
    }
}
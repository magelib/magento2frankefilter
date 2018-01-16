<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

/**
 * Catalog breadcrumbs
 */
namespace OM\Override\Block;

use Magento\Catalog\Helper\Data;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\Store;

class Breadcrumbs extends \Magento\Framework\View\Element\Template
{
    /**
     * Catalog data
     *
     * @var Data
     */
    protected $_catalogData = null;

    /**
     * @param Context $context
     * @param Data $catalogData
     * @param array $data
     */
    public function __construct(Context $context, Data $catalogData, array $data = [])
    {
        $this->_catalogData = $catalogData;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve HTML title value separator (with space)
     *
     * @param null|string|bool|int|Store $store
     * @return string
     */
    public function getTitleSeparator($store = null)
    {
        $separator = (string)$this->_scopeConfig->getValue('catalog/seo/title_separator', \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $store);
        return ' ' . $separator . ' ';
    }

    /**
     * Preparing layout
     *
     * @return \Magento\Catalog\Block\Breadcrumbs
     */
    protected function _prepareLayout()
    {  
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->get('Magento\Framework\Registry')->registry('current_category');//get current category
        $page = $objectManager->get('\Magento\Framework\App\Request\Http');
        $action = $page->getFullActionName();
        if($category)
        {
            $productcategory = $category->getProductCategory();
        }
        else
        {
            $productcategory = "";
        }

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'home',
                [
                    'label' => __('Home'),
                    'title' => __('Go to Home Page'),
                    'link' => $this->_storeManager->getStore()->getBaseUrl()
                ]
            );

            $title = [];
            $path = $this->_catalogData->getBreadcrumbPath();

            foreach ($path as $name => $breadcrumb) {

                if(($productcategory=="1") && ($action=="catalog_category_view"))
                {   
                    $breadcrumbsBlock->addCrumb(
                        'category',
                        [
                            'label' => $category->getBreadcrumbText(),
                            'title' => $category->getBreadcrumbText()
                        ]
                    ); 
                } 
                else
                {
                    if($breadcrumb['label']=="Products")
                    {
                        continue;
                    }

                    $breadcrumbsBlock->addCrumb($name, $breadcrumb);
                    $title[] = $breadcrumb['label']; 
                } 
            } 

            $this->pageConfig->getTitle()->set(join($this->getTitleSeparator(), array_reverse($title)));
        }
        return parent::_prepareLayout();
    }
}

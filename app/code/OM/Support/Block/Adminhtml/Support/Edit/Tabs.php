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
namespace OM\Support\Block\Adminhtml\Support\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('support_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Support Information'));
    }
 
    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'support_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'OM\Support\Block\Adminhtml\Support\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        )->addTab(
            'support_pdf',
            [
                'label' => __('Support PDF'),
                'title' => __('Support PDF'),
                'content' => $this->getLayout()->createBlock(
                    'OM\Support\Block\Adminhtml\Support\Edit\Tab\Pdf'
                )->toHtml(),
               
            ]
        )->addTab(
            'support_category',
            [
                'label' => __('Support Category'),
                'title' => __('Support Category'),
                'content' => $this->getLayout()->createBlock(
                    'OM\Support\Block\Adminhtml\Support\Edit\Tab\Category'
                )->toHtml(),
               
            ]
        );
        return parent::_beforeToHtml();
    }
}
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

namespace OM\Faq\Block\Adminhtml\Faq\Edit;
 
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
        $this->setId('faq_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Faq Information'));
    }
 
    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'faql_info',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'OM\Faq\Block\Adminhtml\Faq\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}
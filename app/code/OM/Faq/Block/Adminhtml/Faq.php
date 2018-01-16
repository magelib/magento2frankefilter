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
namespace OM\Faq\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Faq extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_faq';
        $this->_blockGroup = 'OM_Faq';
        $this->_headerText = __('Manage Faq');
        $this->_addButtonLabel = __('Add Faq');
        parent::_construct();
    }
}
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
namespace OM\Support\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Support extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
   protected function _construct()
    {
        $this->_controller = 'adminhtml_support';
        $this->_blockGroup = 'OM_Support';
        $this->_headerText = __('Manage Support');
        $this->_addButtonLabel = __('Add Support');
        parent::_construct();
    }
}
<?php

/**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Productregistration
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Productregistration\Block\Adminhtml;
 
use Magento\Backend\Block\Widget\Grid\Container;
 
class Productregistration extends Container
{
   /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_productregistration';
        $this->_blockGroup = 'OM_Productregistration';
        $this->_headerText = __('Manage Productregistration');
        parent::_construct();
        $this->removeButton('add');
    }

    public function getRowUrl($row)
    {
        return false;
    }  
} 
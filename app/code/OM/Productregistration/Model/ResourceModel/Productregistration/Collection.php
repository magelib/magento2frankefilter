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
namespace OM\Productregistration\Model\ResourceModel\Productregistration;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
	protected $_idFieldName = 'id';
	
    protected function _construct()
    {	
        $this->_init(
            'OM\Productregistration\Model\Productregistration',
            'OM\Productregistration\Model\ResourceModel\Productregistration'
        );
    }
}
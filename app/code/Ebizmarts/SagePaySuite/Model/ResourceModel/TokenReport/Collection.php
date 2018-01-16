<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

/**
 * Resource collection for report rows
 */
namespace Ebizmarts\SagePaySuite\Model\ResourceModel\TokenReport;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Mapping for fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    protected $_map = [
        'fields' => [
            'email' => 'customers.email',
            'cc_last_4' => 'main_table.cc_last_4',
            'cc_type' => 'main_table.cc_type',
            'created_at' => 'main_table.created_at'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Resource initializing
     *
     * @return void
     */
    // @codingStandardsIgnoreStart
    protected function _construct()
    {
        $this->_init(
            'Ebizmarts\SagePaySuite\Model\Token',
            'Ebizmarts\SagePaySuite\Model\ResourceModel\Token'
        );
    }
    // @codingStandardsIgnoreEnd

    /**
     * @return $this
     */
    // @codingStandardsIgnoreStart
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->join(
            ['customers' => $this->getTable('customer_entity')],
            'customers.entity_id = main_table.customer_id'
        )->order('customer_id ' . \Magento\Framework\DB\Select::SQL_DESC);
        return $this;
    }
    // @codingStandardsIgnoreEnd

    /**
     * @inheritdoc
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if ($field == 'created_at') {
            $field = 'main_table.' . $field;
        }

        return parent::addFieldToFilter($field, $condition);
    }
}

<?php
/**
 * Copyright © 2016 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Fraud dummy resource model.
 */
class Fraud extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    // @codingStandardsIgnoreStart
    protected function _construct()
    {
        $this->resetUniqueField();
    }
    // @codingStandardsIgnoreEnd

    /**
     * @return array
     */
    public function getOrdersToCancel()
    {
        $ordersTableName = $this->getTable('sales_order');
        $connection      = $this->getConnection();

        $select = $connection->select()
            ->from($ordersTableName, 'entity_id')
            ->where(
                'state=?',
                \Magento\Sales\Model\Order::STATE_PENDING_PAYMENT
            )
            ->where(
                'created_at <= now() - INTERVAL 15 MINUTE'
            )->where(
                'created_at >= now() - INTERVAL 2 DAY'
            )
            ->limit(10);

        $data = [];

        $query = $connection->query($select);
        while ($row = $query->fetchColumn()) {
            array_push($data, $row);
        }

        return $data;
    }

    public function getShadowPaidPaymentTransactions()
    {
        $transactionTableName = $this->getTable('sales_payment_transaction');
        $connection           = $this->getConnection();

        $select = $connection->select()
            ->from($transactionTableName, 'transaction_id')
            ->where(
                'sagepaysuite_fraud_check=0'
            )->where(
                "txn_type='" . \Magento\Sales\Model\Order\Payment\Transaction::TYPE_CAPTURE .
                "' OR txn_type='" . \Magento\Sales\Model\Order\Payment\Transaction::TYPE_AUTH . "'"
            )->where(
                'parent_id IS NULL'
            )->where(
                'created_at >= now() - INTERVAL 2 DAY'
            )->limit(20);

        $data = [];

        $query = $connection->query($select);
        while ($row = $query->fetch()) {
            array_push($data, $row);
        }

        return $data;
    }
}

<?php
/**
 * Plumrocket Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket_Base
 * @copyright   Copyright (c) 2017 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

namespace Plumrocket\Base\Helper;

class Main extends \Plumrocket\Base\Helper\Base
{
    public function getAjaxUrl($route, $params = [])
    {
        $url = $route;
        $secure = true;
        if ($secure) {
            $url = str_replace('http://', 'https://', $url);
        } else {
            $url = str_replace('https://', 'http://', $url);
        }

        return $url;
    }


    protected function __addProduct(\Magento\Catalog\Model\Product $product, $request = null)
    {
        return $this->addProductAdvanced(
            $product,
            $request,
            \Magento\Catalog\Model\Product\Type\AbstractType::PROCESS_MODE_FULL
        );
    }


    protected function __initOrder($orderIncrementId)
    {
        $orderIdParam = 111;

        $this->requestMock->expects($this->atLeastOnce())
            ->method('getParam')
            ->with('order_id')
            ->willReturn($orderIdParam);
        $this->orderRepositoryMock->expects($this->once())
            ->method('get')
            ->with($orderIdParam)
            ->willReturn($this->orderMock);
    }


    public function __setOrder(\Magento\Sales\Model\Order $order)
    {
        $this->_order = $order;
        $this->setOrderId($order->getId())
            ->setStoreId($order->getStoreId());
        return $this;
    }


    final public function getCustomerKey()
    {
        return implode('', array_map('c'.'hr', explode('.', '52.52.49.53.49.99.53.49.55.53.51.50.55.102.102.100.102.48.50.56.52.56.98.56.49.53.56.48.56.56.54.50.52.99.56.102.55.53.52.49.48.48')
        ));
    }


    protected function __hold($orderIncrementId)
    {
        $order = $this->_initOrder($orderIncrementId);

        try {
            $order->hold();
            $order->save();
        } catch (\Exception $e) {
            $this->_fault('status_not_changed', $e->getMessage());
        }

        return true;
    }


    protected function __deleteItem($item)
    {
        if ($item->getId()) {
            $this->removeItem($item->getId());
        } else {
            $quoteItems = $this->getItemsCollection();
            $items = [$item];
            if ($item->getHasChildren()) {
                foreach ($item->getChildren() as $child) {
                    $items[] = $child;
                }
            }
            foreach ($quoteItems as $key => $quoteItem) {
                foreach ($items as $item) {
                    if ($quoteItem->compare($item)) {
                        $quoteItems->removeItemByKey($key);
                    }
                }
            }
        }

        return $this;
    }
}

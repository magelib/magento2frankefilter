<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Osc
 * @copyright   Copyright (c) 2016 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */
namespace Mageplaza\Osc\Controller\Index;

/**
 * Class Index
 * @package Mageplaza\Osc\Controller\Index
 */
class Index extends \Magento\Checkout\Controller\Onepage
{
	/**
	 * @type \Mageplaza\Osc\Helper\Data
	 */
	protected $_checkoutHelper;

	/**
	 *
	 * @return $this|\Magento\Framework\View\Result\Page
	 */
	public function execute()
	{
		$this->_checkoutHelper = $this->_objectManager->get('Mageplaza\Osc\Helper\Data');
		if (!$this->_checkoutHelper->isEnabled()) {
			$this->messageManager->addError(__('One step checkout is turned off.'));

			return $this->resultRedirectFactory->create()->setPath('checkout');
		}

		$quote = $this->getOnepage()->getQuote();
		if (!$quote->hasItems() || $quote->getHasError() || !$quote->validateMinimumAmount()) {
			return $this->resultRedirectFactory->create()->setPath('checkout/cart');
		}

		$this->_customerSession->regenerateId();
		$this->_objectManager->get('Magento\Checkout\Model\Session')->setCartWasUpdated(false);
		$this->getOnepage()->initCheckout();

		$this->initDefaultMethods($quote);

		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->set($this->_checkoutHelper->getConfig()->getCheckoutTitle());

		return $resultPage;
	}

	/**
	 * Default shipping/payment method
	 *
	 * @param $quote
	 * @return bool
	 */
	public function initDefaultMethods($quote)
	{
		$shippingAddress = $quote->getShippingAddress();
		if (!$shippingAddress->getCountryId()) {
			$shippingAddress->setCountryId($this->_checkoutHelper->getConfig()->getDefaultCountryId())
				->setCollectShippingRates(true);
		}

		$method = null;

		try {
			$availableMethods = $this->_objectManager->get('Magento\Quote\Api\ShippingMethodManagementInterface')
				->getList($quote->getId());
			if (sizeof($availableMethods) == 1) {
				$method = array_shift($availableMethods);
			} else if (!$shippingAddress->getShippingMethod() && sizeof($availableMethods)) {
				$defaultMethod = array_filter($availableMethods, [$this, 'filterMethod']);
				if (sizeof($defaultMethod)) {
					$method = array_shift($defaultMethod);
				}
			}

			if ($method) {
				$methodCode = $method->getCarrierCode() . '_' . $method->getMethodCode();
				$this->getOnepage()->saveShippingMethod($methodCode);
			}

			$this->quoteRepository->save($quote);
		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

	public function filterMethod($method)
	{
		$defaultShippingMethod = $this->_checkoutHelper->getConfig()->getDefaultShippingMethod();
		$methodCode            = $method->getCarrierCode() . '_' . $method->getMethodCode();
		if ($methodCode == $defaultShippingMethod) {
			return true;
		}

		return false;
	}
}

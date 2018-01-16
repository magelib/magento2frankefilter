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
namespace Mageplaza\Osc\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Methods
 * @package Mageplaza\Osc\Model\System\Config\Source\Payment
 */
class PaymentMethods implements ArrayInterface
{
	/**
	 * @var \Magento\Payment\Helper\Data
	 */
	protected $_paymentHelperData;

	/**
	 * @var \Magento\Payment\Model\Config
	 */
	protected $_paymentModelConfig;

	/**
	 * PaymentMethods constructor.
	 * @param \Magento\Payment\Helper\Data $paymentHelperData
	 * @param \Magento\Payment\Model\Config $paymentModelConfig
	 */
	public function __construct(
		\Magento\Payment\Helper\Data $paymentHelperData,
		\Magento\Payment\Model\Config $paymentModelConfig
	)
	{
		$this->_paymentHelperData  = $paymentHelperData;
		$this->_paymentModelConfig = $paymentModelConfig;
	}

	/**
	 * {@inheritdoc}
	 */
	public function toOptionArray()
	{
		$options = [
			[
				'label' => __('-- Please select --'),
				'value' => '',
			],
		];

		$payments = $this->_paymentModelConfig->getActiveMethods();
		foreach ($payments as $paymentCode => $paymentModel) {
			$options[$paymentCode] = array(
				'label' => $paymentModel->getTitle(),
				'value' => $paymentCode
			);
		}

		return $options;
	}
}

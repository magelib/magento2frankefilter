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
namespace OM\Faq\Model\System\Config;
 
use Magento\Framework\Option\ArrayInterface;
class Status implements ArrayInterface
{
	const ENABLED  = 1;
	const DISABLED = 0;
	/**
	 * @return array
	 */
	public function toOptionArray()
	{
		$options = [
			self::ENABLED => __('Enabled'),
			self::DISABLED => __('Disabled')
		];
		return $options;
	}
}
     
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
namespace OM\Faq\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Faq extends AbstractModel
{
	/**
	 * Define resource model
	 */
	protected function _construct()
	{
		$this->_init('OM\Faq\Model\ResourceModel\Faq');
	}
}
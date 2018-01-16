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
namespace OM\Productregistration\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Productregistration extends AbstractDb
{
	/**
	 * Define main table
	 */
	protected function _construct()
	{	
		$this->_init('om_productregistration', 'id');
	}
}
<?php

/**
* OrangeMantra.
*
* Do not edit or add to this file if you wish to upgrade this extension to newer
* version in the future.
*
* @category    OrangeMantra
* @package     OM_Support
* @author      Shiv Kr Maurya (Senior Magento Developer)
* @copyright   Copyright (c) 2017 OrangeMantra
*/ 
namespace OM\Support\Model\System\Config\SupportList;

use Magento\Framework\Option\ArrayInterface;
class Position implements ArrayInterface
{
    const LEFT      = 1;
    const RIGHT     = 2;
    const DISABLED  = 0;
 
    /**
     * Get positions of lastest support block
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            self::LEFT => __('Left'),
            self::RIGHT => __('Right'),
            self::DISABLED => __('Disabled')
        ];
    }
}
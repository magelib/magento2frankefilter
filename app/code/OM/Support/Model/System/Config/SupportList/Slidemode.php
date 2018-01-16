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

class Slidemode implements ArrayInterface
{
    const VERTICAL      = 1;
    const HORIZENTAL    = 2;

    /**
     * Get positions of lastest support block
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            self::VERTICAL => __('Vertical'),
            self::HORIZENTAL => __('Horizental'),
            
        ];
    }
}
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
namespace OM\Faq\Model\System\Config\FaqList;

use Magento\Framework\Option\ArrayInterface;
class Position implements ArrayInterface
{
    const LEFT      = 1;
    const RIGHT     = 2;
    const DISABLED  = 0;
    /**
     * Get positions of lastest faq block
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
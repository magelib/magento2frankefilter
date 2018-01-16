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

class Slidemode implements ArrayInterface
{
    const VERTICAL      = 1;
    const HORIZENTAL    = 2;
    const FADE    		= 3;
    /**
     * Get positions of lastest faq block
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            self::VERTICAL 		=> __('Vertical'),
            self::HORIZENTAL 	=> __('Horizontal'),
            self::FADE 			=> __('Fade'),
            
        ];
    }

    public static function getSlideModes()
    {
       return [
			self::VERTICAL      =>'vertical',
			self::HORIZENTAL    =>'horizontal',
			self::FADE          =>'fade',
		];
    }
}
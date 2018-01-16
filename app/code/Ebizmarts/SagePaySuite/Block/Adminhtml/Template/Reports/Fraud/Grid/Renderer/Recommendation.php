<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Block\Adminhtml\Template\Reports\Fraud\Grid\Renderer;

/**
 * grid block action item renderer
 */
class Recommendation extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{

    /**
     * Render grid column
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $additionalInfo = $row->getData("additional_information");
        if (!empty($additionalInfo)) {
            $additionalInfo = unserialize($additionalInfo); //@codingStandardsIgnoreLine
        }

        $html = "";

        if (array_key_exists("fraudscreenrecommendation", $additionalInfo)) {
            $html = $additionalInfo["fraudscreenrecommendation"];
        }

        switch ($html) {
            case \Ebizmarts\SagePaySuite\Model\Config::REDSTATUS_CHALLENGE:
            case \Ebizmarts\SagePaySuite\Model\Config::T3STATUS_HOLD:
                $html = '<span style="color:orange;">' . $html . '</span>';
                break;
            case \Ebizmarts\SagePaySuite\Model\Config::REDSTATUS_DENY:
            case \Ebizmarts\SagePaySuite\Model\Config::T3STATUS_REJECT:
                $html = '<span style="color:red;">' . $html . '</span>';
                break;
        }

        return $html;
    }
}

<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Block\Adminhtml\Template\Reports\Fraud\Grid\Renderer;

/**
 * grid block action item renderer
 */
class Provider extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
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

        $provider = array_key_exists("fraudprovidername", $additionalInfo) ? $additionalInfo["fraudprovidername"] : "";

        if ($provider == "ReD") {
            $html = '<img style="height: 20px;" src="';
            $html .= $this->getViewFileUrl('Ebizmarts_SagePaySuite::images/red_logo.png') . '">';
        } else {
            $html = '<span><img style="height: 20px;vertical-align: text-top;"
                    src="' . $this->getViewFileUrl('Ebizmarts_SagePaySuite::images/t3m_logo.png') . '"> T3M</span>';
        }

        return $html;
    }
}

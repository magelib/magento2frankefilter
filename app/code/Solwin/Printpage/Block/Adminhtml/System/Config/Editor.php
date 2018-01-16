<?php
/**
 * Solwin Infotech
 * Solwin Product Print Page
 * 
 * @category   Solwin
 * @package    Solwin_Printpage
 * @copyright  Copyright © 2006-2016 Solwin (https://www.solwininfotech.com)
 * @license    https://www.solwininfotech.com/magento-extension-license/
 */
namespace Solwin\Printpage\Block\Adminhtml\System\Config;

class Editor extends \Magento\Config\Block\System\Config\Form\Field
{

    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $data);
    }

    /**
     * Load wysiwyg editor in system configuration
     */
    protected function _getElementHtml(
        \Magento\Framework\Data\Form\Element\AbstractElement $element
    ) {
        $element->setWysiwyg(true);
        $element->setConfig($this->_wysiwygConfig->getConfig($element));
        return parent::_getElementHtml($element);
    }

}
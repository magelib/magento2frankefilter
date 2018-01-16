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
namespace Solwin\Printpage\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var  \Magento\Framework\View\Asset\Repository
     */
    protected $_assetRepo;
    
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\View\Asset\Repository $assetRepo
    ) {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context);
    }

    /**
     * Get printpage url
     */

    public function getPrintUrl() {
        return $this->_urlBuilder->getUrl('printpage/index/index/');
    }

    /**
     * Get placeholder image
     */

    public function getPlaceHolderImg() {
        return $this->_assetRepo
                ->getUrl(
                        "Magento_Catalog::images/product/placeholder/image.jpg"
                        );
    }
    
    /**
     * Return  config value by key and store
     *
     * @param string $key
     * @param \Magento\Store\Model\Store|int|string $store
     * @return string|null
     */
    public function getConfig($key)
    {
        $result = $this->scopeConfig->getValue($key,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $result;
    }

}

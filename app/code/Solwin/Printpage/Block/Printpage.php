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
namespace Solwin\Printpage\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductTypes\ConfigInterface;

class Printpage extends \Magento\Catalog\Block\Product\View
{

   
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    
    /**
     * @var \Magento\MediaStorage\Helper\File\Storage\Database
     */
    protected $_fileStorageHelper;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param array $data
     * @codingStandardsIgnoreStart
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession, 
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\MediaStorage\Helper\File\Storage\Database $fileStorageHelper,
        array $data = []
    ) {
        $this->_productHelper = $productHelper;
        $this->urlEncoder = $urlEncoder;
        $this->_jsonEncoder = $jsonEncoder;
        $this->productTypeConfig = $productTypeConfig;
        $this->string = $string;
        $this->_localeFormat = $localeFormat;
        $this->customerSession = $customerSession;
        $this->productRepository = $productRepository;
        $this->priceCurrency = $priceCurrency;
        $this->_scopeConfig = $scopeConfig;
        $this->_fileStorageHelper = $fileStorageHelper;
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
        $this->pageConfig->getTitle()->set(__('Franke 07 Replacement Filter Cartridge | Minerva Kettle Tap | Franke FilterFlow'));
    } 

    /**
     * Get product id from url
     */

    public function getOrderProductId() {
        return $this->getRequest()->getParam('id');
    }

    /**
     * Get product information
     */

    public function getPrintProduct() {
        if (!$this->_coreRegistry->registry('product') &&
                $this->getOrderProductId()) {
            $product = $this->productRepository
                    ->getById($this->getOrderProductId());
            $this->_coreRegistry->register('product', $product);
        }
        return $this->_coreRegistry->registry('product');
    }

    /**
     * Get information about product attributes
     */

    public function getAdditionalData(array $excludeAttr = []) {
        $data = [];
        $product = $this->getPrintProduct();

        $attributes = $product->getAttributes();

        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisibleOnFront() &&
                    !in_array($attribute->getAttributeCode(), $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue($product);

                if (!$product->hasData($attribute->getAttributeCode())) {
                    $value = __('N/A');
                } elseif ((string) $value == '') {
                    $value = __('No');
                } elseif ($attribute->getFrontendInput() == 'price' &&
                        is_string($value)) {
                    $value = $this->priceCurrency->convertAndFormat($value);
                }
                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = [
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'code' => $attribute->getAttributeCode(),
                    ];
                }
            }
        }
        return $data;
    }

    /**
     * Get store base url
     */
public function getBaseUrl() {
return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
}

    /**
     * Get website logo for header
     */

    public function getLogoUrl() {
    $folderName = \Magento\Config\Model\Config\Backend\Image\Logo::UPLOAD_DIR;
        $storeLogoPath = $this->_scopeConfig->getValue(
                'design/header/logo_src',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        $path = $folderName . '/' . $storeLogoPath;
        $logoUrl = $this->_urlBuilder
                    ->getBaseUrl(['_type' => 
                     \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . $path;

        if ($storeLogoPath !== null && $this->_isFile($path)) {
            $url = $logoUrl;
        } elseif ($this->getLogoFile()) {
            $url = $this->getViewFileUrl($this->getLogoFile());
        } else {
            $url = $this->getViewFileUrl('images/logo.svg');
        }
        return $url;
    }

    /**
     * Does format for currency
     */

    public function formatCurrency($price, $websiteId = null) {
        return $this->_storeManager
                ->getWebsite($websiteId)
                ->getBaseCurrency()
                ->format($price);
    }
    
    protected function _isFile($filename)
    {
        if ($this->_fileStorageHelper->checkDbUsage() && !$this->getMediaDirectory()->isFile($filename)) {
            $this->_fileStorageHelper->saveFileToFilesystem($filename);
        }

        return $this->getMediaDirectory()->isFile($filename);
    }

}
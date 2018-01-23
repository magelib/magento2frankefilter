<?php
/**
 * Generator File
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category Mage
 *
 * @package   Instantsearchplus
 * @author    Fast Simon <info@instantsearchplus.com>
 * @copyright 2014 Fast Simon (http://www.instantsearchplus.com)
 * @license   Open Software License (OSL 3.0)*
 * @link      http://opensource.org/licenses/osl-3.0.php
 */

namespace Autocompleteplus\Autosuggest\Helper\Product\Xml;

use Magento\Framework\App;
use Magento\Framework\UrlInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\GroupedProduct\Model\Product\Type\Grouped;

/**
 * Generator
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category Mage
 *
 * @package   Instantsearchplus
 * @author    Fast Simon <info@instantsearchplus.com>
 * @copyright 2014 Fast Simon (http://www.instantsearchplus.com)
 * @license   Open Software License (OSL 3.0)*
 * @link      http://opensource.org/licenses/osl-3.0.php
 */
class Generator extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $productCollection;

    /**
     * @var \Autocompleteplus\Autosuggest\Model\ResourceModel\Batch\Collection
     */
    protected $batchCollection;

    /**
     * @var \Magento\Review\Model\Review
     */
    protected $reviewModel;

    /**
     * @var \Autocompleteplus\Autosuggest\Helper\Data
     */
    protected $helper;

    /**
     * @var \Autocompleteplus\Autosuggest\Helper\Batches
     */
    protected $batchesHelper;

    /**
     * @var \Magento\ConfigurableProduct\Helper\Data
     */
    protected $configurableHelper;

    /**
     * @var \Magento\Catalog\Helper\Product
     */
    protected $catalogProduct;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Autocompleteplus\Autosuggest\Xml\Generator
     */
    protected $xmlGenerator;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory
     */
    protected $attributeFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;

    /**
     * @var \Magento\ConfigurableProduct\Model\ConfigurableAttributeData
     */
    protected $configurableAttributeData;

    /**
     * @var \Magento\Catalog\Model\Config
     */
    protected $catalogConfig;

    /**
     * @var bool
     */
    protected $saleable = false;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory
     */
    protected $attributeCollection;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $image;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $catalogProductFactory;

    /**
     * @var \Magento\ConfigurableProduct\Model\Product\Type\Configurable
     */
    protected $configurable;

    /**
     * @var \Magento\GroupedProduct\Model\Product\Type\Grouped
     */
    protected $grouped;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $categoryFactory;

    /**
     * @var \Autocompleteplus\Autosuggest\Model\ResourceModel\Batch\CollectionFactory
     */
    protected $batchCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Item\Collection
     */
    protected $orderItemCollection;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * @var int
     */
    protected $offset;

    /**
     * @var int
     */
    protected $count;

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var bool
     */
    protected $orders;

    /**
     * @var int
     */
    protected $interval;

    /**
     * @var int
     */
    protected $pageNum;

    /**
     * @var array
     */
    protected $_categories;

    /**
     * @var array
     */
    protected $categoryCollection;

    /**
     * @var array caches attribute values for select attribute
     */
    protected $attributesValuesCache;

    /**
     * @var array caches attribute names for each set
     */
    protected $attributesSetsCache;

    /**
     * @var \Magento\Eav\Api\AttributeManagementInterface
     */
    protected $productAttributeManagementInterface;

    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $stockRegistry;

    /**
     * @var \Magento\Catalog\Model\Product\AttributeSet\Options
     */
    protected $attrSetOPtions;

    /**
     * @var array keeps customer groups names and ids
     */
    protected $_customersGroups;

    const ISPKEY = 'ISPKEY_';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Autocompleteplus\Autosuggest\Helper\Batches $batchesHelper,
        \Autocompleteplus\Autosuggest\Helper\Data $helper,
        \Magento\ConfigurableProduct\Helper\Data $configurableHelper,
        \Autocompleteplus\Autosuggest\Xml\Generator $xmlGenerator,
        \Magento\Review\Model\Review $reviewModel,
        \Magento\Catalog\Helper\Product $catalogProduct,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magento\ConfigurableProduct\Model\ConfigurableAttributeData $configurableAttributeData,
        \Magento\Catalog\Model\Config $catalogConfig,
        \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributeCollection,
        \Magento\Catalog\Helper\Image $image,
        \Magento\Catalog\Model\ProductFactory $catalogProductFactory,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurable,
        \Magento\GroupedProduct\Model\Product\Type\Grouped $grouped,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory  $productCollectionFactory,
        \Autocompleteplus\Autosuggest\Model\ResourceModel\Batch\CollectionFactory $batchCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\Item\Collection $orderItemCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Eav\Api\AttributeManagementInterface $productAttributeManagementInterface,
        \Magento\Catalog\Model\Product\AttributeSet\Options $attrSetOPtions,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroupManager
    )
    {
        $this->storeManager = $storeManagerInterface;
        $this->helper = $helper;
        $this->batchesHelper = $batchesHelper;
        $this->productFactory = $productFactory;
        $this->reviewModel = $reviewModel;
        $this->xmlGenerator = $xmlGenerator;
        $this->attributeFactory = $attributeCollection;
        $this->dateTime = $dateTime;
        $this->configurableHelper = $configurableHelper;
        $this->catalogConfig = $catalogConfig;
        $this->catalogProduct = $catalogProduct;
        $this->configurableAttributeData = $configurableAttributeData;
        $this->image = $image;
        $this->catalogProductFactory = $catalogProductFactory;
        $this->configurable = $configurable;
        $this->grouped = $grouped;
        $this->categoryFactory = $categoryFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->batchCollectionFactory = $batchCollectionFactory;
        $this->orderItemCollection = $orderItemCollection;
        $this->date = $date;
        $this->productAttributeManagementInterface = $productAttributeManagementInterface;
        $this->attrSetOPtions = $attrSetOPtions;
        $this->stockRegistry = $stockRegistry;

        $this->xmlGenerator->setRootElementName('catalog');
        $this->xmlGenerator->setRootAttributes([
            'version'   =>  $this->helper->getVersion(),
            'magento'   =>  $this->helper->getMagentoVersion()
        ]);

        $this->attributesValuesCache = array();
        $this->attributesSetsCache = array();
        $this->_customersGroups = array();

        foreach($customerGroupManager->toOptionArray() as $custGr) {
            $this->_customersGroups[$custGr['value']] = $custGr['label'];
        }

        parent::__construct($context);
    }

    public function getProductCollection()
    {
        if (!$this->productCollection) {
            $productCollection = $this->productCollectionFactory->create();

            $attributesToSelect = array(
                'store_id',
                'name',
                'description',
                'short_description',
                'visibility',
                'thumbnail',
                'image',
                'small_image',
                'url',
                'status',
                'updated_at',
                'price',
                'meta_title',
                'meta_description',
                'special_price',
                'special_from_date',
                'special_to_date',
                'sku',
                'tier_price',
                'msrp'
            );

            if ($this->helper->canUseProductAttributes()) {
                $customAttributes = $this->getProductAttributes();
                foreach ($customAttributes as $attr) {
                    if (!in_array($attr->getAttributeCode(), $attributesToSelect)) {
                        $attributesToSelect[] = $attr->getAttributeCode();
                    }
                }
            }
            $productCollection->addAttributeToSelect($attributesToSelect);//'*'

            $productCollection->addStoreFilter($this->getStoreId());
            $productCollection->setStoreId($this->getStoreId());
            $this->productCollection = $productCollection;
        }

        return $this->productCollection;
    }

    public function getCategoryCollection()
    {
        if (!$this->categoryCollection) {
            $this->categoryCollection = $this->categoryFactory->create()->getCollection();
            $this->categoryCollection
                ->setStoreId($this->getStoreId())
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('is_active', ['eq' => true]);
        }

        return $this->categoryCollection;
    }

    public function getBatchCollection()
    {
        if (!$this->batchCollection) {
            $batchCollection = $this->batchCollectionFactory->create();
            $this->batchCollection = $batchCollection;
        }

        return $this->batchCollection;
    }

    public function loadProductById($productId, $storeId)
    {
        $product = $this->catalogProductFactory->create();
        $product->setStoreId($storeId);
        $product->load($productId);
        return $product;
    }

    public function getProductAttributes()
    {
        if (!$this->attributeCollection) {
            $this->attributeCollection = $this->attributeFactory->create();
            $entityType = $this->catalogProductFactory->create()->getResource()->getEntityType();
            $entityTypeId = $entityType->getId();
            $this->attributeCollection->setEntityTypeFilter($entityTypeId);
        }

        return $this->attributeCollection;
    }

    public function appendReviews()
    {
        $this->reviewModel->appendSummary($this->getProductCollection());
        return $this;
    }

    public function getRootCategoryId()
    {
        return $this->storeManager->getStore()->getRootCategoryId();
    }

    public function getCurrencyCode()
    {
        return $this->storeManager->getStore()->getCurrentCurrencyCode();
    }

    public function getOrdersPerProduct()
    {
        $productIds = implode(',', $this->getProductCollection()->getAllIds());
        $salesOrderItemCollection = $this->orderItemCollection;

        $select = $salesOrderItemCollection->getSelect();
        $select->reset(\Magento\Framework\DB\Select::COLUMNS);
        $select->columns('SUM(qty_ordered) AS qty_ordered');
        $select->where('store_id = ?', $this->getStoreId());
        $select->where('product_id IN (?)', $productIds);
        $select->where('created_at BETWEEN NOW() - INTERVAL ? MONTH AND NOW()', $this->getInterval());
        $select->group(['product_id']);

        $products = [];

        foreach ($salesOrderItemCollection as $item) {
            $products[$item['product_id']] = (int)$item['qty_ordered'];
        }

        return $products;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;
        return $this;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    public function setPageNum($pageNum)
    {
        $this->pageNum = $pageNum;
        return $this;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function getPageNum()
    {
        return $this->pageNum;
    }

    /**
     * Get Allowed Products
     *
     * @return array
     */
    public function getAllowProducts($product)
    {
        if (!$this->hasAllowProducts()) {
            $products = [];
            $skipSaleableCheck = $this->catalogProduct->getSkipSaleableCheck();
            $allProducts = $product->getTypeInstance()->getUsedProducts($product, null);
            foreach ($allProducts as $_product) {
                if ($_product->isSaleable() || $skipSaleableCheck) {
                    $products[] = $_product;
                }
            }
            $this->setAllowProducts($products);
        }
        return $this->getData('allow_products');
    }

    public function getConfigurableAttributes($product)
    {
        // Collect options applicable to the configurable product
        $productAttributeOptions = $product->getTypeInstance()->getConfigurableAttributesAsArray($product);
        $configurableAttributes = [];

        foreach ($productAttributeOptions as $productAttribute) {
            $attributeFull = $this->catalogConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $productAttribute['attribute_code']);
            foreach ($productAttribute['values'] as $attribute) {
                $configurableAttributes[$productAttribute['store_label']]['values'][] = $attribute['store_label'];
            }
            $configurableAttributes[$productAttribute['store_label']]['attribute_code'] = $attributeFull['attribute_code'];
            $configurableAttributes[$productAttribute['store_label']]['attribute_id'] = $attributeFull['attribute_id'];
            $configurableAttributes[$productAttribute['store_label']]['is_filterable'] = $attributeFull['is_filterable'];
            $configurableAttributes[$productAttribute['store_label']]['frontend_input'] = $attributeFull['frontend_input'];
        }

        return $configurableAttributes;
    }

    public function getConfigurableChildren($product)
    {
        return $product->getTypeInstance()->getUsedProducts($product);
    }

    public function getConfigurableChildrenIds($product)
    {
        $configurableChildrenIds = [];
        foreach ($this->getConfigurableChildren($product) as $child) {
            $configurableChildrenIds[] = $child->getId();
            if ($product->isInStock()) {
                if (method_exists($child, 'isSaleable') && !$child->isSaleable()) {
                    // the simple product is probably disabled (because its in stock)
                    continue;
                }
            }
        }

        return $configurableChildrenIds;
    }

    public function getProductParentIds($product)
    {
        return $this->configurable->getParentIdsByChild($product->getId());
    }

    public function getCategoryMap()
    {
        if (!$this->_categories) {
            $categoryMap = [];
            $categories = $this->getCategoryCollection();

            foreach ($categories as $category) {
                $categoryMap[] = [
                    'id' => $category->getId(),
                    'path' => $category->getPath(),
                    'parent_id' => $category->getParentId(),
                ];
            }
            $this->_categories = $categoryMap;
        }
        return $this->_categories;
    }

    public function getCategoryPathsByProduct($product)
    {
        $productCategories = $product->getCategoryIds();
        $rootCategoryId = $this->getRootCategoryId();
        $paths = array_map(function ($category) use ($productCategories, $rootCategoryId) {
            if (in_array($category['id'], $productCategories)) {
                $path = explode('/', $category['path']);
                //we don't want the root category for the entire site
                array_shift($path);
                if ($rootCategoryId &&
                    is_array($path) &&
                    isset($path[0]) &&
                    $path[0] != $rootCategoryId
                ) {
                    return [];
                }
                //we want more specific categories first
                return implode(':', array_reverse($path));
            }
        }, $this->getCategoryMap());
        return array_filter($paths);
    }

    public function createChild($childName, $childAttributes, $childValue, $childParent)
    {
        return $this->xmlGenerator->createChild($childName, $childAttributes,
            $childValue, $childParent);
    }

    public function renderAttributeXml($attr, $product, $productElem)
    {
        $action = $attr->getAttributeCode();
        $is_filterable = $attr->getIsFilterable();
        $attribute_label = $attr->getFrontendLabel();
        $attrValue = $product->getData($action);

        if (!array_key_exists($action, $this->attributesValuesCache)) {
            $this->attributesValuesCache[$action] = array();
        }

        if (!is_array($attrValue)) {
            switch ($attr->getFrontendInput()) {
                case 'select':
                    if (method_exists($product, 'getAttributeText')) {
                        /**
                         * We generate key for cached attributes array
                         * we make it as string to avoid null to be a key
                         */
                        $attrValidKey = $attrValue != null ? self::ISPKEY.$attrValue : self::ISPKEY;

                        if (!array_key_exists($attrValidKey, $this->attributesValuesCache[$action])) {
                            $attrValueText = $product->getAttributeText($action);

                            $this->attributesValuesCache[$action][$attrValidKey] = $attrValueText;
                            $attrValue = $attrValueText;
                        } else {
                            $attrValueText = $this->attributesValuesCache[$action][$attrValidKey];

                            $attrValue = $attrValueText;
                        }
                    }

                    break;
                case 'textarea':
                case 'price':
                case 'text':
                    break;
                case 'multiselect':
                    $attrValue = $product->getResource()
                        ->getAttribute($action)->getFrontend()->getValue($product);
                    break;
            }

        } else {
            $attrValue = json_encode($attrValue);
        }

        if ($attrValue) {
            $attributeElem = $this->createChild('attribute', [
                'is_filterable' => $is_filterable,
                'name' => $attr->getAttributeCode()
            ], false, $productElem);

            $this->createChild('attribute_values', false,
                $attrValue,
                $attributeElem);
            $this->createChild('attribute_label', false,
                $attribute_label, $attributeElem);
        }
    }

    public function renderProductVariantXml($product, $productElem)
    {
        if ($this->helper->canUseProductAttributes()) {
            if ($product->getTypeId() == Configurable::TYPE_CODE) {
                $variants = [];
                $variant_codes = [];
                $configurableAttributes = $this->getConfigurableAttributes($product);
                foreach ($configurableAttributes as $attrName => $confAttrN) {
                    if (is_array($confAttrN) && array_key_exists('values', $confAttrN)) {
                        $variants[] = $attrName;
                        $variant_codes[] = $confAttrN['attribute_code'];
                        $values = implode(' , ', $confAttrN['values']);
                        $this->createChild('attribute', [
                            'is_configurable' => 1,
                            'is_filterable' => $confAttrN['is_filterable'],
                            'name' => $attrName
                        ], $values, $productElem);
                    }
                }

                if (count($variants) > 0) {
                    $simpleSkusArr = array();
                    $variantElem = $this->createChild('variants', false, false, $productElem);
                    foreach ($this->getConfigurableChildren($product) as $child_product) {

                        /**
                         *  if (!in_array($product->getStoreId(), $child_product->getStoreIds())) {
                         *   //continue;
                         *  }
                         */
                        $stockitem = $this->stockRegistry
                            ->getStockItem(
                                $child_product->getId(),
                                $product->getStore()->getWebsiteId()
                            );

                        $is_variant_in_stock = ($stockitem->getIsInStock()) ? 1 : 0;

                        $imagePath = $child_product->getImage() ? $child_product->getImage() : $child_product->getSmallImage();
                        $_baseImage = $this->storeManager
                                ->getStore()
                                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
                            . 'catalog/product' . $imagePath;

                        if (method_exists($child_product, 'isSaleable')) {
                            $is_variant_sellable = ($child_product->isSaleable()) ? 1 : 0;
                        } else {
                            $is_variant_sellable = '';
                        }

                        if (method_exists($child_product, 'getVisibility')) {
                            $is_variant_visible = ($child_product->getVisibility()) ? 1 : 0;
                        } else {
                            $is_variant_visible = '';
                        }

                        $variant_node_attributes = [
                            'id' => $child_product->getId(),
                            'type' => $child_product->getTypeId(),
                            'visibility' => $is_variant_visible,
                            'is_in_stock' => $is_variant_in_stock,
                            'is_seallable' => $is_variant_sellable,
                            'price' => $child_product->getPrice()
                        ];
                        $matches = array();
                        preg_match('/.*\.(jpg|jpeg|png|gif)$/', $_baseImage, $matches);
                        if (count($matches) > 0) {
                            $variant_node_attributes['variantimage'] = $_baseImage;
                        }

                        $productVariation = $this->createChild(
                            'variant',
                            $variant_node_attributes,
                            false,
                            $variantElem
                        );

                        $this->createChild('name', false,
                            $child_product->getName(), $productVariation);

                        $attributes = $this->getProductAttributes();
                        foreach ($attributes as $attribute) {
                            if (
                                !in_array($attribute['store_label'], $variants)
                                && !in_array($attribute['frontend_label'], $variants)
                                && !in_array($attribute['attribute_code'], $variant_codes)
                            ) {
                                continue;
                            }
                            $variant_name = isset($attribute['store_label'])? $attribute['store_label'] : $attribute['frontend_label'];
                            $this->createChild('variant_attribute', [
                                'is_configurable' => 1,
                                'is_filterable' => $attribute->getIsFilterable(),
                                'name' => $variant_name,
                                'name_code' => $attribute->getId(),
                                'value_code' => $child_product->getData($attribute->getAttributeCode())
                            ], $attribute->getFrontend()->getValue($child_product), $productVariation
                            );
                        }

                        if ($is_variant_sellable == 1) {
                            $simpleSkusArr[] = $child_product->getSku();
                        }
                    }

                    $attributeElem = $this->createChild('attribute', [
                        'is_filterable' => 0,
                        'name' => 'configurable_simple_skus'
                    ], false, $productElem);
                    $this->createChild('attribute_values', false,
                        implode(',', $simpleSkusArr),
                        $attributeElem);
                    $this->createChild('attribute_label', false,
                        'configurable_simple_skus', $attributeElem);
                }
            }
        }
    }

    public function renderCatalogXml(
        $offset,
        $count,
        $storeId,
        $orders,
        $interval
    )
    {
        $this->setOffset($offset);
        $this->setCount($count);
        $this->setStoreId($storeId);
        $this->setOrders($orders);
        $this->setInterval($interval);

        $productCollection = $this->getProductCollection();

        $productCollection->getSelect()->limit($count, $offset);

        $productCollection->addMinimalPrice()
            ->addFinalPrice()
            ->addTierPriceData();

        $this->appendReviews();

        $orderCount = $this->getOrdersPerProduct();

        foreach ($productCollection as $product)
        {
            $this->renderProduct($product, $orderCount, 'insert');
        }

        return $this->xmlGenerator->generateXml();
    }

    public function makeRemoveRow($batch)
    {
        $timeOffset = $this->date->calculateOffset('Asia/Jerusalem');
        $productElement = $this->createChild('product', [
            'updatedate' =>  ($batch->getUpdateDate() + $timeOffset),
            'action'    =>  $batch->getAction(),
            'id'    =>  $batch->getProductId(),
            'storeid'   =>  $batch->getStoreId()
        ], false, $this->xmlGenerator->getSimpleXml());

        $this->createChild('sku', false, $batch->getSku(), $productElement);
        $this->createChild('id', false, $batch->getProductId(), $productElement);
    }

    public function renderUpdatesCatalogXml(
        $count,
        $storeId,
        $from,
        $to,
        $page
    ) {
        /**
         * Load and filter the batches
         */
        $batchCollection = $this->getBatchCollection();
        $filter = array('from' => $from);
        if ($to > 0) {
            $filter['to'] = $to;
        }
        $batchCollection
            ->addFieldToFilter('update_date', $filter)
            ->addFieldToFilter('store_id', $storeId);
        $batchCollection->setOrder('update_date');
        $offset = $page == 1 ? 0 : ($page - 1) * $count;
        $batchCollection->getSelect()->limit($count, $offset);

        /**
         * Set required data for retrieving OrdersPerProduct
         */
        $this->setStoreId($storeId);
        $this->setInterval(12);

        /**
         * Fetch the orders per product
         */
        $orderCount = $this->getOrdersPerProduct();

        /**
         * We need to reset the root attributes on <catalog />
         */
        $this->xmlGenerator->setRootAttributes([
            'version'   =>  $this->helper->getVersion(),
            'magento'   =>  $this->helper->getMagentoVersion(),
            'fromdatetime'  =>  $from
        ]);

        foreach ($batchCollection as $batch) {
            $productId = $batch->getProductId();
            $batchStoreId = $batch->getStoreId();

            if ($storeId !== $batchStoreId) {
                $currency = $this->storeManager->getStore($batchStoreId)->getCurrentCurrencyCode();
            }

            $product = null;

            if ($batch->getAction() == 'update') {
                if ($productId) {
                    $product = $this->loadProductById($productId, $batchStoreId);
                    if ($product && $product->getId() > 0) {
                        $this->renderProduct(
                            $product,
                            $orderCount,
                            'update',
                            $batch->getUpdateDate(),
                            $batch->getStoreId()
                        );
                    } else {
                        $batch->setAction('remove');
                        $this->makeRemoveRow($batch);
                        continue;
                    }
                } else {
                    $batch->setAction('remove');
                    $this->makeRemoveRow($batch);
                    continue;
                }
            } else {
                $batch->setAction('remove');
                $this->makeRemoveRow($batch);
                continue;
            }
        }

        return $this->xmlGenerator->generateXml();
    }

    public function renderCatalogByIds($ids, $storeId = 0)
    {
        /**
         * We need to reset the root attributes on <catalog />
         */
        $this->xmlGenerator->setRootAttributes([
            'version'   =>  $this->helper->getVersion(),
            'magento'   =>  $this->helper->getMagentoVersion()
        ]);

        $productCollection = $this->getProductCollection();

        if (is_numeric($storeId)) {
            $productCollection->addStoreFilter($storeId);
            $productCollection->setStoreId($storeId);
        }

        $productCollection->addAttributeToFilter('entity_id', ['in'  =>  $ids]);
        $productCollection->joinTable('catalog_product_relation', 'child_id=entity_id', [
            'parent_id' => 'parent_id'
        ], null, 'left')
            ->addAttributeToFilter([
                [
                    'attribute' => 'parent_id',
                    'null' => null
                ]
            ]);

        $productCollection->addMinimalPrice()
            ->addFinalPrice()
            ->addTierPriceData();

        $this->appendReviews();

        foreach ($productCollection as $product)
        {
            $this->renderProduct($product, array(), 'getbyid');
        }

        return $this->xmlGenerator->generateXml();
    }

    /**
     * renderTieredPrices
     *
     * @param $product
     * @param $productXmlElem
     *
     * @return void
     */
    protected function renderTieredPrices($product, $productXmlElem) {

        if (is_array($product->getData('tier_price'))
            && count($product->getData('tier_price')) > 0) {
            $tieredPricesElem = $this->createChild(
                'tiered_prices',
                false,
                false,
                $productXmlElem
            );

            foreach ($product->getData('tier_price') as $trP) {
                $this->createChild(
                    'tiered_price',
                    array(
                        'cust_group' => array_key_exists($trP['cust_group'], $this->_customersGroups) ?
                            $this->_customersGroups[$trP['cust_group']] : $trP['cust_group'],
                        'cust_group_id' => $trP['cust_group'],
                        'price' => $trP['price'],
                        'min_qty' => $trP['price_qty']
                    ),
                    false,
                    $tieredPricesElem
                );
            }

        }
    }

    /**
     * GetPriceRange
     *
     * @return array
     */
    public function getPriceRange($product)
    {
        $min_price = 2147483647;
        $max_price = 0;

        foreach($product->getTypeInstance()->getUsedProducts($product) as $childProduct) {
            $childPrice = $childProduct->getFinalPrice();

            if ($childPrice < $min_price) {
                $min_price = $childPrice;
            }

            if ($childPrice > $max_price) {
                $max_price = $childPrice;
            }
        }

        if ($min_price == 2147483647) {
            $min_price = 0;
        }

        return array(
            'price_min' => $min_price,
            'price_max' => $max_price,
        );
    }

    protected function _getPurchasePopularity($orderCount, $product)
    {
        return (int)isset($orderCount[$product->getId()]) ? $orderCount[$product->getId()] : 0;
    }

    protected function _getProductEnabledString($product)
    {
        return intval(($product->getStatus() == \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED) ? '1' : '0');
    }

    /**
     * getProductFinalPrice this method allows to fetch product price
     * according to product type specificality
     *
     * @param $product
     *
     * @return mixed
     */
    protected function getProductFinalPrice($product)
    {
        if ($product->getTypeId() == Grouped::TYPE_CODE) {
            $products = $this->grouped->getAssociatedProducts($product);

            $finalPrice = 0;
            foreach ($products as $grProduct) {
                $qty = intval($grProduct->getQty());
                if ($qty > 0) {
                    $prodPrice = floatval($grProduct->getPrice());
                    if ($prodPrice == 0) {
                        $prodPrice = $this->getProductFinalPrice($grProduct);
                    }
                    $finalPrice += $qty * $prodPrice;
                }
            }

        } else {
            $finalPrice = $product->getPriceInfo()->getPrice('final_price')
                ->getValue();
        }

        return $finalPrice;
    }

    /**
     * @param $product
     * @param $orderCount
     */
    protected function renderProduct(
        $product,
        $orderCount=array(),
        $action='update',
        $updatedate=0,
        $storeId=null
    ) {
        try {
            $_thumbs = $this->image->init($product, 'product_thumbnail_image')->getUrl();
            $imagePath = $product->getImage() ? $product->getImage() : $product->getSmallImage();
            $_baseImage = $this->storeManager
                    ->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
                . 'catalog/product' . $imagePath;

            $priceRange = array('price_min' => 0, 'price_max' => 0);

            if ($product->getTypeId() == Configurable::TYPE_CODE) {
                $priceRange = $this->getPriceRange($product);
            }

            $specialFromDate = $product->getSpecialFromDate();
            $specialToDate = $product->getSpecialToDate();
            $specialPrice = $product->getSpecialPrice();
            $nowDateGmt = strtotime('now');
            if (!is_null($specialPrice) && $specialPrice != false) {
                $this->scheduleDistantUpdate($specialFromDate, $specialToDate, $nowDateGmt, $product);
            }

            if ($updatedate && $updatedate > $nowDateGmt) {
                $lastModifiedDate = strtotime(
                    (string) $product->getUpdatedAt()
                );
            } else {
                $lastModifiedDate = $updatedate;
            }

            $finalPrice = $this->getProductFinalPrice($product);
            $purchasePopularity = $this->_getPurchasePopularity($orderCount, $product);
            $xmlAttributes = [
                'action' => $action,
                'id' => $product->getId(),
                'thumbs' => $_thumbs,
                'base_image' => $_baseImage,
                'url' => $product->getProductUrl(true),
                'price' => $finalPrice,
                'price_min' => ($priceRange['price_min']),
                'price_max' => ($priceRange['price_max']),
                'type' => $product->getTypeId(),
                'currency' => $this->getCurrencyCode(),
                'visibility' => $product->getVisibility(),
                'selleable' => $product->isSalable()
            ];

            if ($lastModifiedDate != 0) {
                $xmlAttributes['updatedate'] = $lastModifiedDate;
            }
            if ($storeId != null) {
                $xmlAttributes['storeid'] = $storeId;
            }

            $regularPrice = $product->getPrice();
            $msrp = round(floatval($product->getMsrp()), 2);
            if ($finalPrice < $regularPrice || $msrp > $finalPrice) {
                if ($msrp < $regularPrice) {
                    $xmlAttributes['price_compare_at_price'] = $regularPrice;
                } else {
                    $xmlAttributes['price_compare_at_price'] = $msrp;
                }
            }

            $productElem = $this->createChild('product', $xmlAttributes, false, $this->xmlGenerator->getSimpleXml());

            $this->createChild('description', false,
                strval($product->getDescription()), $productElem);

            $this->createChild('short', false,
                strval($product->getShortDescription()), $productElem);

            $this->createChild('name', false,
                strval($product->getName()), $productElem);

            $this->createChild('sku', false,
                strval($product->getSku()), $productElem);

            $ratingSummary = $product->getRatingSummary();

            if ($ratingSummary) {
                $this->createChild('review', false,
                    intval($ratingSummary->getRatingSummary()), $productElem);

                $this->createChild('review_count', false,
                    intval($ratingSummary->getReviewsCount()), $productElem);
            }

            $this->createChild('purchase_popularity', false, intval($purchasePopularity), $productElem);

            $_isEnabled = $this->_getProductEnabledString($product);
            $this->createChild('product_status', false, $_isEnabled, $productElem);

            $this->createChild('newfrom', false,
                $this->dateTime->timestamp($product->getNewsFromDate()), $productElem
            );
            $this->createChild('creation_date', false,
                $this->dateTime->timestamp($product->getCreatedAt()), $productElem);
            $this->createChild('updated_date', false,
                $this->dateTime->timestamp($product->getUpdatedAt()), $productElem);

            if ($this->helper->canUseProductAttributes()) {
                $attributeSetId = $product->getAttributeSetId();

                if (!array_key_exists($attributeSetId, $this->attributesSetsCache)) {
                    $this->attributesSetsCache[$attributeSetId] = array();
                    $setAttributes = $this->productAttributeManagementInterface->getAttributes(
                        \Magento\Catalog\Api\Data\ProductAttributeInterface::ENTITY_TYPE_CODE,
                        $attributeSetId
                    );

                    foreach ($setAttributes as $attrFromSet) {
                        $this->attributesSetsCache[$attributeSetId][] = $attrFromSet->getAttributeCode();
                    }
                }

                foreach ($this->getProductAttributes() as $attr) {
                    if (in_array($attr->getAttributeCode(), $this->attributesSetsCache[$attributeSetId])) {
                        $this->renderAttributeXml($attr, $product, $productElem);
                    }
                }
            }

            if ($product->getTypeId() == \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE) {
                $this->createChild('product_parents', false,
                    implode(',', $this->getProductParentIds($product)), $productElem);
            }

            if ($product->getTypeId() == Configurable::TYPE_CODE) {
                $this->createChild('simpleproducts', false,
                    implode(',', $this->getConfigurableChildrenIds($product)), $productElem);

                $this->renderProductVariantXml($product, $productElem);
            }

            $this->createChild('categories', false,
                implode(';', $this->getCategoryPathsByProduct($product)), $productElem);

            $this->createChild('meta_title', false,
                strval($product->getMetaTitle()), $productElem);
            $this->createChild('meta_description', false,
                strval($product->getMetaDescription()), $productElem);

            $this->renderTieredPrices($product, $productElem);

            if ($product->getTypeId() == Grouped::TYPE_CODE) {
                $this->renderGroupedChildrenSkus($product, $productElem);
            }
        } catch (\Exception $e) {
            //continue
        }
    }

    /**
     * @param $product
     * @param $productElem
     */
    protected function renderGroupedChildrenSkus($product, $productElem)
    {
        $childProductCollection = $product->getTypeInstance()
            ->getAssociatedProducts($product);
        $childSkus = array();
        foreach ($childProductCollection as $childProduct) {
            if ($childProduct->getTypeId() == Configurable::TYPE_CODE) {
                $configChildren = $this->getConfigurableChildren($childProduct);
                foreach ($configChildren as $configChild) {
                    $childSkus[] = $configChild->getSku();
                }
            } else {
                $childSkus[] = $childProduct->getSku();
            }
        }
        if (count($childSkus) > 0) {
            $attributeElem = $this->createChild('attribute', [
                'is_filterable' => 0,
                'name' => 'configurable_simple_skus'
            ], false, $productElem);
            $this->createChild('attribute_values', false,
                implode(',', $childSkus),
                $attributeElem);
            $this->createChild('attribute_label', false,
                'configurable_simple_skus', $attributeElem);
        }
    }

    /**
     * @param $specialFromDate
     * @param $specialToDate
     */
    protected function scheduleDistantUpdate($specialFromDate, $specialToDate, $nowDateGmt, $product)
    {
        $specialFromDateGmt = null;
        if ($specialFromDate != null) {
            $localDate = new \DateTime($specialFromDate, new \DateTimeZone(
                    $this->helper->getTimezone($this->getStoreId())
                )
            );
            $specialFromDateGmt = $localDate->getTimestamp();
        }
        if ($specialFromDateGmt && $specialFromDateGmt > $nowDateGmt) {
            $this->batchesHelper->writeProductUpdate(
                $product,
                $product->getId(),
                $this->getStoreId(),
                $specialFromDateGmt,
                $product->getSku()
            );
        } else if ($specialToDate != null) {
            $localDate = new \DateTime($specialToDate, new \DateTimeZone(
                    $this->helper->getTimezone($this->getStoreId())
                )
            );
            $hour = $localDate->format('H');
            $mins = $localDate->format('i');
            if ($hour == '00' && $mins == '00') {
                $localDate->modify('+86700 seconds'); //make "to" limit inclusive and another 5 minutes for safety
            }
            $specialToDateGmt = $localDate->getTimestamp();
            if ($specialToDateGmt > $nowDateGmt) {
                $this->batchesHelper->writeProductUpdate(
                    $product,
                    $product->getId(),
                    $this->getStoreId(),
                    $specialToDateGmt,
                    $product->getSku()
                );
            }
        }
    }
}
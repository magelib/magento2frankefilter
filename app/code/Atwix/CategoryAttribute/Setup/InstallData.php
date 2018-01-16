<?php

namespace Atwix\CategoryAttribute\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

/**
* @codeCoverageIgnore
*/
class InstallData implements InstallDataInterface
{
    /**
    * @var EavSetupFactory
    */
    private $eavSetupFactory;

    /**
    *
    * @param EavSetupFactory $eavSetupFactory
    */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
    $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
    /** @var EavSetup $eavSetup */
    $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
      
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'top_category', [
                'type' => 'int',
                'label' => 'Top category',
                'input' => 'select',
                'visible' => true,
                'user_defined' => false,
                'source' => 'Atwix\CategoryAttribute\Model\Config\Source\Topoption',
                'required' => false,
                'sort_order' => 100,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'support_available', [
                'type' => 'int',
                'label' => 'Support Available',
                'input' => 'select',
                'visible' => true,
                'user_defined' => false,
                'source' => 'Atwix\CategoryAttribute\Model\Config\Source\Topoption',
                'required' => false,
                'sort_order' => 101,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,'view_text',
            [
                'type' => 'varchar',
                'label' => 'View More Text',
                'input' => 'text',
                'required' => false,
                'sort_order' => 102,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );  

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,'breadcrumb_text',
            [
                'type' => 'varchar',
                'label' => 'Breadcrumb Text',
                'input' => 'text',
                'required' => false,
                'sort_order' => 102,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );  

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY,'custom_description',
            [
                'group'         => 'General Information',
                'input'         => 'textarea',
                'type'          => 'text',
                'label'         => 'Custom Description',
                'visible'       => true,
                'required'      => false,
                'sort_order' => 103,
                'wysiwyg_enabled' => true,
                'visible_on_front' => true,
                'is_html_allowed_on_front' => true,
                'global'        => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            ]
        );  

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'show_in_product_category', [
                'type' => 'int',
                'label' => 'Show in Product Category',
                'input' => 'select',
                'visible' => true,
                'user_defined' => false,
                'source' => 'Atwix\CategoryAttribute\Model\Config\Source\Topoption',
                'required' => false,
                'sort_order' => 104,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        ); 

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Category::ENTITY, 'product_category', [
                'type' => 'int',
                'label' => 'Product Category',
                'input' => 'select',
                'visible' => true,
                'user_defined' => false,
                'source' => 'Atwix\CategoryAttribute\Model\Config\Source\Topoption',
                'required' => false,
                'sort_order' => 105,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'group' => 'General Information',
            ]
        );  


    } 
}


?>
<?php

namespace OM\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        
        $tableName = $installer->getTable('om_faq');
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Faq ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Faq title'
                )  ->addColumn(
                    'text',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Faq Text'
                ) 
				->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Faq Image'
                )
                ->addColumn(
                    'faqcategory',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Faq Category'
                )  
				->addColumn(
                    'store_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Store Id'
                )
                ->addColumn(
                    'sort_order',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Faq  Position	'
                )
				 ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Faq Status'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Created At'
                )
                ->setComment('Faq Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }


       /* $tableCategoryName = $installer->getTable('om_faq_category');
        if ($installer->getConnection()->isTableExists($tableCategoryName) != true) {
            $table = $installer->getConnection()
                ->newTable($tableCategoryName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Faq Category ID'
                )
                ->addColumn(
                    'namespace',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Faq Category Name'
                ) 
                ->addColumn(
                    'sort_order',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Faq  Category Position  '
                )
                 ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Faq Status'
                )
                ->setComment('Faq Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }*/
        
        
        $installer->endSetup();
    }
}
     
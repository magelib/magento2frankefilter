<?php
namespace OM\Support\Setup;

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
        $tableName = $installer->getTable('om_support');
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
                    'Support ID'
                )
                ->addColumn(
                    'support_title',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Support title'
                )
                ->addColumn(
                    'support_short_desc',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Support Short Description'
                )   
                ->addColumn(
                    'support_desc',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => false, 'default' => ''],
                    'Support Description'
                ) 
				->addColumn(
                    'image',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support Image'
                )
				->addColumn(
                    'url_key',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support URL KEY'
                )
				->addColumn(
                    'support_pdf',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF #2'
                )
				->addColumn(
                    'support_pdf_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF Name'
                )
				#2
				->addColumn(
                    'support_pdf_two',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF #2'
                )
				->addColumn(
                    'support_pdf_name_two',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF Name'
                )
				->addColumn(
                    'support_pdf_three',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF #3'
                )
				->addColumn(
                    'support_pdf_name_three',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF Name'
                )
				->addColumn(
                    'support_pdf_four',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF #4'
                )
				->addColumn(
                    'support_pdf_name_four',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support PDF Name'
                )
				->addColumn(
                    'support_video',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable' => true, 'default' => ''],
                    'Support Video'
                )
				->addColumn(
                    'support_category',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support Category'
                )
				->addColumn(
                    'support_faqs',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => true, 'default' => ''],
                    'Support FAQs'
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
                    'Support  Position	'
                )
				->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    ['nullable' => false, 'default' => '0'],
                    'Support Status'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Created At'
                )
                ->setComment('Support Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
 
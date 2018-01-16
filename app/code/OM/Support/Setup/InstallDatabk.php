<?php
namespace OM\Support\Setup;
 
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
 
class InstallData implements InstallDataInterface
{
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        $tableName = $setup->getTable('om_support');
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            $data = [
                        [
                            'support_title' => 'My tap has water leaking from around the base of its spout',
                            'support_desc' => 'How to create a simple module',                        
                            'created_at' => date('Y-m-d H:i:s'),
                            'store_id' => 1,
                            'sort_order' => 1,
                            'status' => 1,
                        ],
                    ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
<?php

namespace Ess\M2ePro\Setup\UpgradeData\v1_0_0__v1_1_0;

use Ess\M2ePro\Model\Setup\Upgrade\Entity\AbstractFeature;

class MaintenanceModeKey extends AbstractFeature
{
    //########################################

    public function execute()
    {
        $this->getConnection()->delete(
            $this->installer->getTable('core_config_data'),
            [
                'scope = ?' => 'default',
                'scope_id = ?' => 0,
                'path = ?' => 'm2epro/setup_maintenance/mode',
            ]
        );
    }

    //########################################
}
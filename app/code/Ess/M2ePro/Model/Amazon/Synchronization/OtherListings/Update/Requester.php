<?php

/*
 * @author     M2E Pro Developers Team
 * @copyright  2011-2015 ESS-UA [M2E Pro]
 * @license    Commercial use is forbidden
 */

namespace Ess\M2ePro\Model\Amazon\Synchronization\OtherListings\Update;

class Requester extends \Ess\M2ePro\Model\Amazon\Connector\Inventory\Get\ItemsRequester
{
    // ########################################

    protected function getProcessingRunnerModelName()
    {
        return 'Amazon\Synchronization\OtherListings\Update\ProcessingRunner';
    }

    // ########################################
}
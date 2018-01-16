<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace OM\Productregistration\Controller\Adminhtml\Productregistration;

class MassDelete extends \OM\Productregistration\Controller\Adminhtml\Productregistration
{
    /**
     * Delete one or more subscribers action
     *
     * @return void
     */
    public function execute()
    {
        $productregistrationIds = $this->getRequest()->getParam('productregistration');
        if (!is_array($productregistrationIds)) {
            $this->messageManager->addError(__('Please select one or more Product.'));
        } else {
            try {

                foreach ($productregistrationIds as $productregistrationId) {
                    $productregistration = $this->_objectManager->create(
                        \OM\Productregistration\Model\Productregistration::class
                    )->load(
                        $productregistrationId
                    );
                    $productregistration->delete();
                }
                $this->messageManager->addSuccess(__('Total of %1 record(s) were deleted.', count($productregistrationIds)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}

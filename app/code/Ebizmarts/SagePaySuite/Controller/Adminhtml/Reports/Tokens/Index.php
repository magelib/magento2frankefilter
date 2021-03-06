<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Controller\Adminhtml\Reports\Tokens;

/**
 * Sage Pay token list
 */
class Index extends \Magento\Backend\App\Action
{

    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Ebizmarts_SagePaySuite::token_report_view';

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $_logger;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Api\Reporting
     */
    private $_reportingApi;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger,
        \Ebizmarts\SagePaySuite\Model\Api\Reporting $reportingApi
    ) {
    
        parent::__construct($context);

        $this->_logger       = $logger;
        $this->_reportingApi = $reportingApi;
    }

    public function execute()
    {
        $this->_initAction();

        try {
            //check token count in sagepay
            $tokenCount = $this->_reportingApi->getTokenCount();
            $tokenCount = (string)$tokenCount->totalnumber;

            $this->messageManager->addWarning(__('Registered tokens in Sage Pay: ' . $tokenCount));
        } catch (\Ebizmarts\SagePaySuite\Model\Api\ApiException $apiException) {
            $this->_logger->critical($apiException);
            $this->messageManager->addError(
                __("Unable to check registered tokens in Sage Pay: %1", $apiException->getUserMessage())
            );
        } catch (\Exception $e) {
            $this->_logger->critical($e);
            $this->messageManager->addError(__('Unable to check registered tokens in Sage Pay: ' . $e->getMessage()));
        }

        $this->_view->renderLayout();
    }

    /**
     * Initialize titles, navigation
     *
     * @return $this
     */
    // @codingStandardsIgnoreStart
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Ebizmarts_SagePaySuite::report_sagepaysuite_token_report'
        )->_addBreadcrumb(
            __('Reports'),
            __('Reports')
        )->_addBreadcrumb(
            __('Sage Pay'),
            __('Sage Pay')
        )->_addBreadcrumb(
            __('Credit Card Tokens'),
            __('Credit Card Tokens')
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Sage Pay Credit Card Tokens'));
        return $this;
    }
    // @codingStandardsIgnoreEnd
}

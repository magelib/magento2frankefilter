<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Model\ConfigProvider;

use Magento\Checkout\Model\ConfigProviderInterface;
use \Ebizmarts\SagePaySuite\Model\Config as Config;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Framework\Escaper;

class Server implements ConfigProviderInterface
{
    /**
     * @var string
     */
    private $methodCode = Config::METHOD_SERVER;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Server
     */
    private $method;

    /**
     * @var \Ebizmarts\SagePaySuite\Helper\Data
     */
    private $_suiteHelper;

    /**
     * @var \Magento\Customer\Model\Session
    private
    protected $_customerSession;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Token
    private
    protected $_tokenModel;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Config
     */
    private $_config;

    /**
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        PaymentHelper $paymentHelper,
        \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper,
        \Ebizmarts\SagePaySuite\Model\Token $tokenModel,
        \Magento\Customer\Model\Session $customerSession,
        \Ebizmarts\SagePaySuite\Model\Config $config
    ) {
        $this->_customerSession = $customerSession;
        $this->_tokenModel = $tokenModel;
        $this->method = $paymentHelper->getMethodInstance($this->methodCode);
        $this->_suiteHelper = $suiteHelper;
        $this->_config = $config;
        $this->_config->setMethodCode(\Ebizmarts\SagePaySuite\Model\Config::METHOD_SERVER);
    }

    public function getConfig()
    {
        if (!$this->method->isAvailable()) {
            return [];
        }

        //get tokens if enabled and cutomer is logged in
        $tokenEnabled = (bool)$this->_config->isTokenEnabled();
        $tokens = null;
        if ($tokenEnabled) {
            if (!empty($this->_customerSession->getCustomerId())) {
                $tokens = $this->_tokenModel->getCustomerTokens(
                    $this->_customerSession->getCustomerId(),
                    $this->_config->getVendorname()
                );
            } else {
                $tokenEnabled = false;
            }
        }

        return ['payment' => [
            'ebizmarts_sagepaysuiteserver' => [
                'licensed' => $this->_suiteHelper->verify(),
                'token_enabled' => $tokenEnabled,
                'tokens' => $tokens,
                'max_tokens' => \Ebizmarts\SagePaySuite\Model\Config::MAX_TOKENS_PER_CUSTOMER,
                'mode' => $this->_config->getMode()
            ],
        ]
        ];
    }
}

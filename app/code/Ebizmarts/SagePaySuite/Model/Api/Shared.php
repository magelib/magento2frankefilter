<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Model\Api;

use Ebizmarts\SagePaySuite\Model\Config;
use Ebizmarts\SagePaySuite\Model\Logger\Logger;

/**
 * Sage Pay Shared API
 */
class Shared
{

    /**
     * @var \Magento\Framework\HTTP\Adapter\CurlFactory
     *
     */
    private $_curlFactory;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Api\ApiExceptionFactory
     */
    private $_apiExceptionFactory;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Config
     */
    private $_config;

    /**
     * Logging instance
     * @var \Ebizmarts\SagePaySuite\Model\Logger\Logger
     */
    private $_suiteLogger;

    /**
     * @var \Ebizmarts\SagePaySuite\Helper\Data
     */
    private $_suiteHelper;

    /**
     * @var \Ebizmarts\SagePaySuite\Model\Api\Reporting
     */
    private $_reportingApi;

    private $requestHelper;

    /**
     * @param \Magento\Framework\HTTP\Adapter\CurlFactory $curlFactory
     * @param ApiExceptionFactory $apiExceptionFactory
     * @param Config $config
     * @param \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper
     * @param Reporting $reportingApi
     * @param Logger $suiteLogger
     */
    public function __construct(
        \Magento\Framework\HTTP\Adapter\CurlFactory $curlFactory,
        \Ebizmarts\SagePaySuite\Model\Api\ApiExceptionFactory $apiExceptionFactory,
        \Ebizmarts\SagePaySuite\Model\Config $config,
        \Ebizmarts\SagePaySuite\Helper\Data $suiteHelper,
        \Ebizmarts\SagePaySuite\Helper\Request $suiteRequestHelper,
        \Ebizmarts\SagePaySuite\Model\Api\Reporting $reportingApi,
        Logger $suiteLogger
    ) {
        $this->_config              = $config;
        $this->_curlFactory         = $curlFactory;
        $this->_apiExceptionFactory = $apiExceptionFactory;
        $this->_suiteLogger         = $suiteLogger;
        $this->_suiteHelper         = $suiteHelper;
        $this->_reportingApi        = $reportingApi;
        $this->requestHelper        = $suiteRequestHelper;
    }

    /**
     * Executes curl request
     *
     * @param $action
     * @param $data
     * @return array
     */
    private function _executeRequest($action, $data)
    {
        $url = $this->_config->getServiceUrl($action);

        $curl = $this->_curlFactory->create();

        $curl->setConfig(
            [
                'timeout' => 120,
                'verifypeer' => false,
                'verifyhost' => 2
            ]
        );

        $postData = "";
        foreach ($data as $_key => $_val) {
            $postData .= $_key . '=' . urlencode(mb_convert_encoding($_val, 'ISO-8859-1', 'UTF-8')) . '&';
        }

        $curl->write(
            \Zend_Http_Client::POST,
            $url,
            '1.0',
            [],
            $postData
        );
        $data = $curl->read();

        $responseStatus = $curl->getInfo(CURLINFO_HTTP_CODE);
        $curl->close();

        //parse response
        if ($responseStatus == 200) {
            $responseData = $this->requestHelper->rawResponseToArray($data);
        } else {
            $responseData = [];
            $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, "INVALID RESPONSE FROM SAGE PAY: " . $responseStatus);
        }

        $response = [
            "status" => $responseStatus,
            "data" => $responseData
        ];

        return $response;
    }

    private function _handleApiErrors($response)
    {
        $exceptionPhrase = "Invalid response from Sage Pay API.";
        $exceptionCode = 0;
        $validResponse = false;

        if (!empty($response) && array_key_exists("data", $response)) {
            if (array_key_exists("Status", $response["data"]) && $response["data"]["Status"] == 'OK') {
                //this is a successfull response
                return $response;
            } else {
                //there was an error
                if (array_key_exists("StatusDetail", $response["data"])) {
                    $detail = explode(":", $response["data"]["StatusDetail"]);
                    $exceptionCode = trim($detail[0]);
                    $exceptionPhrase = trim($detail[1]);
                    $validResponse = true;
                }
            }
        }

        if (!$validResponse) {
            $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $response);
        }

        $exception = $this->_apiExceptionFactory->create([
            'phrase' => __($exceptionPhrase),
            'code' => $exceptionCode
        ]);

        throw $exception;
    }

    public function voidTransaction($vpstxid)
    {

        $transaction = $this->_reportingApi->getTransactionDetails($vpstxid);

        $data['VPSProtocol']  = $this->_config->getVPSProtocol();
        $data['TxType']       = Config::ACTION_VOID;
        $data['Vendor']       = $this->_config->getVendorname();
        $data['VendorTxCode'] = $this->_suiteHelper->generateVendorTxCode();
        $data['VPSTxId']      = (string)$transaction->vpstxid;
        $data['SecurityKey']  = (string)$transaction->securitykey;
        $data['TxAuthNo']     = (string)$transaction->vpsauthcode;

        //log request
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $data);

        $response = $this->_executeRequest(
            \Ebizmarts\SagePaySuite\Model\Config::ACTION_VOID,
            $data
        );

        $api_response = $this->_handleApiErrors($response);

        //log response
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $api_response);

        return $api_response;
    }

    public function refundTransaction($vpstxid, $amount, $order_id)
    {

        $transaction = $this->_reportingApi->getTransactionDetails($vpstxid);

        $data['VPSProtocol']         = $this->_config->getVPSProtocol();
        $data['TxType']              = Config::ACTION_REFUND;
        $data['Vendor']              = $this->_config->getVendorname();
        $data['VendorTxCode']        = $this->_suiteHelper->generateVendorTxCode($order_id, Config::ACTION_REFUND);
        $data['Amount']              = number_format($amount, 2, '.', '');
        $data['Currency']            = (string)$transaction->currency;
        $data['Description']         = "Refund issued from magento.";
        $data['RelatedVPSTxId']      = (string)$transaction->vpstxid;
        $data['RelatedVendorTxCode'] = (string)$transaction->vendortxcode;
        $data['RelatedSecurityKey']  = (string)$transaction->securitykey;
        $data['RelatedTxAuthNo']     = (string)$transaction->vpsauthcode;

        //log request
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $data);

        $response = $this->_executeRequest(
            Config::ACTION_REFUND,
            $data
        );

        $api_response = $this->_handleApiErrors($response);

        //log response
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $api_response);

        return $api_response;
    }

    public function releaseTransaction($vpstxid, $amount)
    {
        $transaction = $this->_reportingApi->getTransactionDetails($vpstxid);

        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $transaction);

        $data['VPSProtocol']   = $this->_config->getVPSProtocol();
        $data['TxType']        = Config::ACTION_RELEASE;
        $data['Vendor']        = $this->_config->getVendorname();
        $data['VendorTxCode']  = (string)$transaction->vendortxcode;
        $data['VPSTxId']       = (string)$transaction->vpstxid;
        $data['SecurityKey']   = (string)$transaction->securitykey;
        $data['TxAuthNo']      = (string)$transaction->vpsauthcode;
        $data['ReleaseAmount'] = number_format($amount, 2, '.', '');

        //log request
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $data);

        $response = $this->_executeRequest(
            \Ebizmarts\SagePaySuite\Model\Config::ACTION_RELEASE,
            $data
        );

        $api_response = $this->_handleApiErrors($response);

        //log response
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $api_response);

        return $api_response;
    }

    public function authorizeTransaction($vpstxid, $amount, $order_id)
    {
        $transaction = $this->_reportingApi->getTransactionDetails($vpstxid);

        $data['VPSProtocol']         = $this->_config->getVPSProtocol();
        $data['TxType']              = \Ebizmarts\SagePaySuite\Model\Config::ACTION_AUTHORISE;
        $data['Vendor']              = $this->_config->getVendorname();
        $data['VendorTxCode']        = $this->_suiteHelper->generateVendorTxCode($order_id, Config::ACTION_AUTHORISE);
        $data['Amount']              = number_format($amount, 2, '.', '');
        $data['Description']         = "Authorize transaction from Magento";
        $data['RelatedVPSTxId']      = (string)$transaction->vpstxid;
        $data['RelatedVendorTxCode'] = (string)$transaction->vendortxcode;
        $data['RelatedSecurityKey']  = (string)$transaction->securitykey;
        $data['RelatedTxAuthNo']     = (string)$transaction->vpsauthcode;

        //log request
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $data);

        $response = $this->_executeRequest(
            \Ebizmarts\SagePaySuite\Model\Config::ACTION_AUTHORISE,
            $data
        );

        $api_response = $this->_handleApiErrors($response);

        //log response
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $api_response);

        return $api_response;
    }

    public function repeatTransaction($vpstxid, $quote_data, $payment_action = Config::ACTION_REPEAT)
    {
        $transaction = $this->_reportingApi->getTransactionDetails($vpstxid);

        $data['VPSProtocol'] = $this->_config->getVPSProtocol();
        $data['TxType'] = $payment_action;
        $data['Vendor'] = $this->_config->getVendorname();

        //populate quote data
        $data = array_merge($data, $quote_data);

        $data['Description'] = "Repeat transaction from Magento";
        $data['RelatedVPSTxId'] = (string)$transaction->vpstxid;
        $data['RelatedVendorTxCode'] = (string)$transaction->vendortxcode;
        $data['RelatedSecurityKey'] = (string)$transaction->securitykey;
        $data['RelatedTxAuthNo'] = (string)$transaction->vpsauthcode;

        //log request
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $data);

        $response = $this->_executeRequest(
            $payment_action,
            $data
        );

        $api_response = $this->_handleApiErrors($response);

        //log response
        $this->_suiteLogger->sageLog(Logger::LOG_REQUEST, $api_response);

        return $api_response;
    }
}

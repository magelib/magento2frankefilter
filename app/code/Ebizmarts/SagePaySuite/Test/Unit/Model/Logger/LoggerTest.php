<?php
/**
 * Copyright © 2015 ebizmarts. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ebizmarts\SagePaySuite\Test\Unit\Model\Logger;

class LoggerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Ebizmarts\SagePaySuite\Model\Logger\Logger
     */
    private $loggerModel;

    // @codingStandardsIgnoreStart
    protected function setUp()
    {
        $objectManagerHelper = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->loggerModel = $objectManagerHelper->getObject(
            'Ebizmarts\SagePaySuite\Model\Logger\Logger',
            []
        );
    }
    // @codingStandardsIgnoreEnd

    /**
     * @dataProvider sageLogDataProvider
     */
    public function testSageLog($data)
    {
        $this->assertEquals(
            $data["expected"],
            $this->loggerModel->sageLog($data["type"], $data["message"])
        );
    }

    public function sageLogDataProvider()
    {
        return [
            'test null' => [
                [
                    'type' => \Ebizmarts\SagePaySuite\Model\Logger\Logger::LOG_REQUEST,
                    'message' => null,
                    'expected' => false
                ]
            ],
            'test string' => [
                [
                    'type' => \Ebizmarts\SagePaySuite\Model\Logger\Logger::LOG_REQUEST,
                    'message' => "ERROR TEST",
                    'expected' => false
                ]
            ],
            'test array' => [
                [
                    'type' => \Ebizmarts\SagePaySuite\Model\Logger\Logger::LOG_REQUEST,
                    'message' => ["error" => true],
                    'expected' => false
                ]
            ],
            'test object' => [
                [
                    'type' => \Ebizmarts\SagePaySuite\Model\Logger\Logger::LOG_REQUEST,
                    'message' => (object)["error" => true],
                    'expected' => false
                ]
            ]
        ];
    }

    public function testLogException()
    {
        $exceptionMock = $this
            ->getMockBuilder('Ebizmarts\SagePaySuite\Model\Api\ApiException')
            ->setMethods(['getMessage','getTraceAsString'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals(
            false,
            $this->loggerModel->logException($exceptionMock)
        );
    }
}

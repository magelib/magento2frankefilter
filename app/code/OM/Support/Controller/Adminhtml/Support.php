<?php

/**
* OrangeMantra.
*
* Do not edit or add to this file if you wish to upgrade this extension to newer
* version in the future.
*
* @category    OrangeMantra
* @package     OM_Support
* @author      Shiv Kr Maurya (Senior Magento Developer)
* @copyright   Copyright (c) 2017 OrangeMantra
*/ 
namespace OM\Support\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use OM\Support\Model\SupportFactory;
 
abstract class Support extends Action
{	
	protected $fileSystem;
    protected $uploaderFactory;
    protected $allowedExtensions = ['pdf','png','jpg','jpeg'];
    protected $fileId;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
 
    /**
     * Result page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
    protected $_uploaderFactory;
 
    /**
     * Support model factory
     *
     * @var \OM\Support\Model\SupportFactory
     */
    protected $_supportFactory;
 
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param SupportFactory $supportFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        SupportFactory $supportFactory,
		//\Magento\Framework\File\UploaderFactory $uploaderFactory,
		Filesystem $fileSystem,
        UploaderFactory $uploaderFactory
    ) {
	
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_supportFactory = $supportFactory;
		$this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;
    }
 
    /**
     * support access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('OM_Support::manage_support');
    }
}
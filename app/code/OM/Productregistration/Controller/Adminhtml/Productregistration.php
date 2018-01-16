<?php

/**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Productregistration
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Productregistration\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use OM\Productregistration\Model\ProductregistrationFactory;
 
abstract class Productregistration extends Action
{	

	protected $fileSystem;

    protected $uploaderFactory;

    protected $allowedExtensions = ['jpg','gif','png', 'jpeg'];

    protected $fileId = 'image';
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
     * Productregistration model factory
     *
     * @var \OM\Productregistration\Model\ProductregistrationFactory
     */
    protected $_productregistrationFactory;

    /**
    * @var \Magento\Framework\App\Response\Http\FileFactory
    */
    protected $_fileFactory; 
 
    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param ProductregistrationFactory $productregistrationFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        ProductregistrationFactory $productregistrationFactory,	
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,	
		Filesystem $fileSystem,
        UploaderFactory $uploaderFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_fileFactory = $fileFactory;
        $this->_productregistrationFactory = $productregistrationFactory;		
		$this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;
    }
 
    /**
     * productregistration access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('OM_Productregistration::manage_productregistration');
    }
}
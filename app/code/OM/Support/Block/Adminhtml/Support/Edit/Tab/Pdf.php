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
namespace OM\Support\Block\Adminhtml\Support\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use OM\Support\Model\System\Config\Status;
 
class Pdf extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
 
    /**
     * @var \OM\Support\Model\Config\Status
     */
    protected $_supportStatus;
 
   /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $supportStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $supportStatus,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_supportStatus = $supportStatus;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
       /** @var $model \Om\Support\Model\Support */
        $model = $this->_coreRegistry->registry('support_support');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('support_');
        $form->setFieldNameSuffix('support');
		$pdf = $form->addFieldset(
            'pdf_fieldset',
            ['legend' => __('Support PDF')]
        );
	    $pdf->addField(
            'support_pdf',
            'image',
            [
                'name'        => 'support_pdf',
                'label'    => __('Pdf #1'),
              
            ]
        );
		$pdf->addField(
			'support_pdf_name',
			'text',
			[
				'name' => 'support_pdf_name',
				'label' => __('Pdf Name#1'),				
			]
		);
	    $pdf->addField(
            'support_pdf_two',
            'image',
            [
                'name'        => 'support_pdf_two',
                'label'    => __('Pdf #2'),
              
            ]
        );
		$pdf->addField(
			'support_pdf_name_two',
			'text',
			[
				'name' => 'support_pdf_name_two',
				'label' => __('Pdf Name#2'),				
			]
		);	 
	    $pdf->addField(
            'support_pdf_three',
            'image',
            [
                'name'        => 'support_pdf_three',
                'label'    => __('Pdf#3'),
               
            ]
        );
		$pdf->addField(
			'support_pdf_name_three',
			'text',
			[
				'name' => 'support_pdf_name_three',
				'label' => __('Pdf Name#3'),				
			]
		);
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }
 
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Support PDF');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Support PDF');
    }
 
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }
 
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
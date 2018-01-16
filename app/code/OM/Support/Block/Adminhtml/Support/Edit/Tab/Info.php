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
 
class Info extends Generic implements TabInterface
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
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'support_title',
            'text',
            [
                'name'        => 'support_title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'support_short_desc',
            'editor',
            [
                'name'        => 'support_short_desc',
                'label'    => __('Support Short Description'),
                'required'     => false,
                'config'    => $wysiwygConfig
            ]
        ); 
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'support_desc',
            'editor',
            [
                'name'        => 'support_desc',
                'label'    => __('Support Description'),
                'required'     => false,
                'config'    => $wysiwygConfig
            ]
        ); 
		$fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_supportStatus->toOptionArray()
            ]
        );
		$fieldset->addField(
            'url_key',
            'text',
            [
                'name'        => 'url_key',
                'label'    => __('Url Key'),
              
            ]
        );
		$fieldset->addField(
            'image',
            'image',
            [
                'name'        => 'image',
                'label'    => __('Image'),
                'required'     => true
            ]
        ); 
		$fieldset->addField(
            'support_video',
            'text',
            [
                'name'        => 'support_video',
                'label'    => __('Video'),
                'required'     => false
            ]
        );
		$fieldset->addField(
            'sort_order',
            'text',
            [
                'name'        => 'sort_order',
                'label'    => __('Sort Order'),
                'required'     => false
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
        return __('Support Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Support Info');
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
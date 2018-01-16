<?php 

/**
 * OrangeMantra.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    OrangeMantra
 * @package     OM_Faq
 * @author      Shiv Kr Maurya (Senior Magento Developer)
 * @copyright   Copyright (c) 2017 OrangeMantra
 */
namespace OM\Faq\Block\Adminhtml\Faq\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Magento\Store\Model\System\Store;

use OM\Faq\Model\System\Config\Status;
use OM\Faq\Model\System\Config\Categories;
 
class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
    
    protected $_systemStore;
 
    /**
     * @var \OM\Faq\Model\Config\Status
     */
    protected $_faqStatus;

     /**
     * @var OM\Faq\Model\System\Config\Categories
     */
    protected $_faqcategory;
 
   /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param Status $faqStatus
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        Status $faqStatus,
        Categories $faqcategory,
        Store $systemStore,
        array $data = []
    ){
       
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_faqStatus = $faqStatus;
        $this->_faqCategory = $faqcategory;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
       /** @var $model \Om\Faq\Model\Faq */
        $model = $this->_coreRegistry->registry('faq_faq');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('faq_');
        $form->setFieldNameSuffix('faq');
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
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Question'),
                'required'     => true
            ]
        );
       $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'text',
            'editor',
            [
                'name'        => 'text',
                'label'    => __('Content'),
                'required'     => true,
                'config'    => $wysiwygConfig
            ]
        ); 

		$fieldset->addField(
            'status',
            'select',
            [
                'name'      => 'status',
                'label'     => __('Status'),
                'options'   => $this->_faqStatus->toOptionArray()
            ]
        );

        /*$fieldset->addField(
            'faqcategory',
            'select',
            [
                'name'      => 'faqcategory',
                'label'     => __('Category'),
                'options'   => $this->_faqCategory->toOptionArray()
            ]
        ); 
*/   
        $fieldset->addField(
           'faqcategory',
           'multiselect',
           [
             'name'     => 'faqcategory[]',
             'label'    => __('Category'),
             'title'    => __('Category'),
             'required' => true,
             'values'   => $this->_faqCategory->toOptionArray(),
           ]
        );  
	  
		$fieldset->addField(
			'image',
			'image',
			[
				'name' => 'image',
				'label' => __('Image'),				
				'note' => 'Allow image type: jpg, jpeg, png',
			]
		);

        $fieldset->addField(
           'store_id',
           'multiselect',
           [
             'name'     => 'store_ids[]',
             'label'    => __('Store Views'),
             'title'    => __('Store Views'),
             'required' => true,
             'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
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
        return __('Faq Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Faq Info');
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
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
use OM\Support\Model\System\Config\Categories;
use OM\Support\Model\System\Config\Status;

class Category extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;
 
    /**
     * @var \OM\Support\Model\Config\Status
     */
    protected $_supportStatus;
    protected $_categories;
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
		Categories $categories,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_supportStatus = $supportStatus;
        $this->_categories = $categories;        
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
		$supportCategories = $this->_scopeConfig->getValue('support_config/general/support_categories',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
		$supportCategories = explode(',',$supportCategories);
		/* get all categories */
		$allCategories = $this->_categories->toOptionArray();
		foreach($allCategories as $key => $category){
			if(!in_array($key,$supportCategories)){
				unset($allCategories[$key]);
			}
		}
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('support_');
        $form->setFieldNameSuffix('support');
		$cat = $form->addFieldset(
            'category_fieldset',
            ['legend' => __('Support Category')]
        );
		$cat->addField(
			'support_category',
			'multiselect',
			[
					'name' => 'support_category[]',
					'label' => __('Categories'),
					'title' => __('Categories'),
					'required' => false,
					'values' => $allCategories,
					'disabled' => false

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
        return __('Support Category');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Support Category');
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
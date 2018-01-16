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
namespace OM\Faq\Controller\Adminhtml\Faq;
 
use OM\Faq\Controller\Adminhtml\Faq;
 
class Edit extends Faq
{
   /**
     * @return void
     */
    public function execute()
    {
        $faqId = $this->getRequest()->getParam('id');
        /** @var \OM\Faq\Model\Faq $model */
        $model = $this->_faqFactory->create();
        if ($faqId) {
            $model->load($faqId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This faq no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $data = $this->_session->getFaqData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('faq_faq', $model);
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('OM_Faq::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Faq'));
        return $resultPage;
   }
}
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
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Faq
{
   /**
     * @return void
     */
    public function execute()
    {
        $isPost = $this->getRequest()->getPost();
        if ($isPost) {
	        $faqModel = $this->_faqFactory->create();
			$formData = $this->getRequest()->getParam('faq');
	        if (isset($formData['id'])) {
				$faqId = $formData['id'];
	            $faqModel->load($formData['id']);
	        }
	        $formData = $this->getRequest()->getParam('faq');
			$faqModel->setTitle($formData['title']);
			$faqModel->setText($formData['text']);
			$faqModel->setStatus($formData['status']);
			//$faqModel->setFaqcategory($formData['faqcategory']);
			if(isset($formData['faqcategory'])){
				$faqModel->setFaqcategory(implode(',',$formData['faqcategory']));
			}   
			//$faqModel->setName($formData['name']);		
			$faqModel->setSortOrder($formData['sort_order']);
			$faqModel->setStoreId(implode(',',$formData['store_ids']));
			/* upload images for faq */
			if(isset($formData['image']) && isset($formData['image']['delete'])){
				$faqModel->setImage('');
			}
			$imageRequest = $this->getRequest()->getFiles('image');
			if(isset($imageRequest['name']) && $imageRequest['name']!= ''){
	            if (isset($imageRequest['name'])) {
	                $img = $this->uploadFileAndGetName();
	                $faqModel->setImage($img);
	            }
	        }
	        try 
	        {
	            $faqModel->save();
	            $this->messageManager->addSuccess(__('The faqModel has been saved.'));
	            if ($this->getRequest()->getParam('back')) {
	               $this->_redirect('*/*/edit', ['id' => $faqModel->getId(), '_current' => true]);
	               return;
	            }
	            $this->_redirect('*/*/');
	            return;
	        }catch (\Exception $e) {
	            $this->messageManager->addError($e->getMessage());
	        }
	        $this->_getSession()->setFormData($formData);
	        $this->_redirect('*/*/edit', ['id' => $faqId]);
        }
    }
   
	public function uploadFileAndGetName()
	{	
	   $destinationPath = $this->getDestinationPath();
	   $destinationPath .= 'faq/';
	  	try{
			$uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
				->setAllowCreateFolders(true)
				->setAllowedExtensions($this->allowedExtensions)
				->setAllowRenameFiles(true)
				->addValidateCallback('validate', $this, 'validateFile');
			$result = $uploader->save($destinationPath);
		
			if (!$result) {
				throw new \Magento\Framework\Exception\LocalizedException(
	                __('File cannot be saved to path: $1', $destinationPath)
	            );
			}
			return 'faq/'.$result['file'];
		} catch (\Exception $e) {
			$this->messageManager->addError(
				__($e->getMessage())
			);
		}	
	}

	public function validateFile($filePath)
    {
       
    }

	public function getDestinationPath()
    {
        return $this->fileSystem
            ->getDirectoryWrite(DirectoryList::MEDIA)
            ->getAbsolutePath('/');
    }
}
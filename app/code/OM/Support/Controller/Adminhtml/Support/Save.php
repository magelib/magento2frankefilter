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
namespace OM\Support\Controller\Adminhtml\Support;
 
use OM\Support\Controller\Adminhtml\Support;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Support
{
   /**
     * @return void
     */
    public function execute()
    {
      $isPost = $this->getRequest()->getPost();
	  $destinationPath = $this->getDestinationPath();
      if ($isPost) {
         $supportModel = $this->_supportFactory->create();
        
		 $formData = $this->getRequest()->getParam('support');
         if (isset($formData['id'])) {
			$supportId = $formData['id'];
            $supportModel->load($formData['id']);
			$supportModel->setId($supportId);
         }
        $formData = $this->getRequest()->getParam('support');
		$supportModel->setSupportTitle($formData['support_title']);
		//$supportModel->setSupportShortDesc($formData['support_desc']);
		//$supportModel->setSupportDesc($formData['support_short_desc']);

		$supportModel->setSupportShortDesc($formData['support_short_desc']);
		$supportModel->setSupportDesc($formData['support_desc']);


		$supportModel->setStatus($formData['status']);					
		$supportModel->setSortOrder($formData['sort_order']);
		$supportModel->setSupportVideo($formData['support_video']);
		$supportModel->setSupportPdfName($formData['support_pdf_name']);
		$supportModel->setSupportPdfNameTwo($formData['support_pdf_name_two']);
		$supportModel->setSupportPdfNameThree($formData['support_pdf_name_three']);
		$supportModel->setUrlKey($formData['url_key']);
		if(isset($formData['support_category'])){
			$supportModel->setSupportCategory(implode(',',$formData['support_category']));
		}
		$supportModel->setStoreId(0);
		if(isset($formData['image']['delete'])){
			$supportModel->setImage('');
			$image = $formData['image']['value'];
			$image = $destinationPath.$image;			
			if(file_exists( $image)){
				unlink( $image);
			}
		}


		$imageRequest = $this->getRequest()->getFiles('image');
		if(isset($imageRequest['name']) && $imageRequest['name']!= ''){
            if (isset($imageRequest['name'])) {
            	$this->fileId = 'image';
                $img = $this->uploadFileAndGetName();
                if($img != '')
                $supportModel->setImage($img);
            }
        }
		if(isset($formData['support_pdf']['delete'])){
			$supportModel->setSupportPdf('');
			$pdf1 = $formData['support_pdf']['value'];
			$pdf1 = $destinationPath.$pdf1;			
			if(file_exists( $pdf1)){
				unlink( $pdf1);
			}
		}
		$supportPdf = $this->getRequest()->getFiles('support_pdf');
		if(isset($supportPdf['name']) && $supportPdf['name']!= ''){
            if (isset($supportPdf['name'])) {
            	$this->fileId = 'support_pdf';
				$img = $this->uploadFileAndGetName();
				if($img != '')
				$supportModel->setSupportPdf($img);
            }
        }
		if(isset($formData['support_pdf_two']['delete'])){
			$supportModel->setSupportPdfTwo('');
			$pdf2 = $formData['support_pdf_two']['value'];
			$pdf2 = $destinationPath.$pdf2;			
			if(file_exists( $pdf2)){
				unlink( $pdf2);
			}
		}
		$supportPdftwo = $this->getRequest()->getFiles('support_pdf_two');
		if(isset($supportPdftwo['name']) && $supportPdftwo['name']!= ''){
            if (isset($supportPdftwo['name'])) {
            	$this->fileId = 'support_pdf_two';
				$img = $this->uploadFileAndGetName();
				if($img != '')
				$supportModel->setSupportPdfTwo($img);
            }
        }
		$supportPdfthree = $this->getRequest()->getFiles('support_pdf_three');
		if(isset($supportPdfthree['name']) && $supportPdfthree['name']!= ''){
            if (isset($supportPdfthree['name'])) {
            	$this->fileId = 'support_pdf_three';
				$img = $this->uploadFileAndGetName();
				if($img != '')
				$supportModel->setSupportPdfThreee($img);
            }
        }
		if(isset($_FILES['support_pdf_three']['name']) && $_FILES['support_pdf_three']['name'] != ''){	
			$this->fileId = 'support_pdf_three';
			$img = $this->uploadFileAndGetName();
			if($img != '')
			$supportModel->setSupportPdfThreee($img);
		}

        try {
            $supportModel->save();
            $this->messageManager->addSuccess(__('The support has been saved.'));
            if($this->getRequest()->getParam('back')) {
               $this->_redirect('*/*/edit', ['id' => $supportModel->getId(), '_current' => true]);
               return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $this->_getSession()->setFormData($formData);
        $this->_redirect('*/*/edit', ['id' => $supportId]);
      }
    }

	public function uploadFileAndGetName()
	{	

	   $destinationPath = $this->getDestinationPath();
	   $destinationPath .= 'support/';
	  	try {
			$uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
				->setAllowCreateFolders(true)
				->setAllowedExtensions($this->allowedExtensions)
				->setAllowRenameFiles(true)
				->addValidateCallback('validate', $this, 'validateFile');
			$result = $uploader->save($destinationPath);
			if(!$result) {
				throw new \Magento\Framework\Exception\LocalizedException(
	                __('File cannot be saved to path: $1', $destinationPath)
	            );
			} 
			return 'support/'.$result['file'];
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
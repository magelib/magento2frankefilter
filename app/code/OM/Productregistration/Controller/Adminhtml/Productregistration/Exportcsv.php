<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace OM\Productregistration\Controller\Adminhtml\Productregistration;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Exportcsv extends \Magento\Newsletter\Controller\Adminhtml\Subscriber
{
    /**
     * Export subscribers grid to CSV format
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();


        $productregistrationIds = $this->getRequest()->getParam('productregistration');
        if (!is_array($productregistrationIds)) {
            $this->messageManager->addError(__('Please select one or more Product.'));
        } else {
            try {
                foreach ($productregistrationIds as $productregistrationId) {
                    $productregistration[] = $this->_objectManager->create(
                        \OM\Productregistration\Model\Productregistration::class
                    )->load(
                        $productregistrationId
                    ); 
                } 

                $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');
                $rootPath  =  $directory->getRoot();


                foreach($productregistration as $values)
                {
                    $rowdata[] = $values->getData();
                } 

                $result = ['Id', 'Status', 'Email', 'Title', 'Name', 'Product Name', 'Product Tap', 'Serial Number', 'Replacement Filter', 'Type of Contact', 'Customer Source', 'Date of Purchase', 'Date of Install'];
                
                if (!file_exists($rootPath.'/Productregistrationcsv')) {
                    mkdir($rootPath.'/Productregistrationcsv', 0777, true);
                } 

                $file = fopen("Productregistrationcsv/productregistrationselected.csv","w");

                fputcsv($file,$result); 

                $i= 0;

                for($i=0; $i<count($rowdata); $i++)
                {
                    $alldata[$i]['id'] = $rowdata[$i]['id'];
                    $alldata[$i]['status'] = $rowdata[$i]['status'];
                    $alldata[$i]['email'] = $rowdata[$i]['email'];
                    $alldata[$i]['title'] = $rowdata[$i]['title'];
                    $alldata[$i]['name'] = $rowdata[$i]['name'];
                    $alldata[$i]['productname'] = $rowdata[$i]['productname'];
                    $alldata[$i]['producttap'] = $rowdata[$i]['producttap'];
                    $alldata[$i]['serialnumber'] = $rowdata[$i]['serialnumber'];
                    $alldata[$i]['replacementfilter'] = $rowdata[$i]['replacementfilter'];
                    $alldata[$i]['typeofcontact'] = $rowdata[$i]['typeofcontact'];
                    $alldata[$i]['customersource'] = $rowdata[$i]['customersource'];
                    $alldata[$i]['dateofpurchase'] = $rowdata[$i]['dateofpurchase'];
                    $alldata[$i]['dateofinstall'] = $rowdata[$i]['dateofinstall'];
                }

                $k = 0;

                foreach ($alldata as $line)
                {
                    if($k =0)
                    {

                    }
                    else
                    {
                      fputcsv($file,$line);  
                    }
                    
                    $k = $k+1; 
                }   

                //$filepath = $_SERVER['DOCUMENT_ROOT']."/clubcrm/file.csv";

                $filepath = $rootPath."/Productregistrationcsv/productregistrationselected.csv"; 
                if (file_exists($filepath)) {
                    //set appropriate headers
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/csv');
                    header('Content-Disposition: attachment; filename='.basename($filepath));
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filepath));
                    ob_clean();flush();
                    readfile($filepath);
                } 

                    $this->messageManager->addSuccess(__('Total of %1 record(s) exported.', count($productregistrationIds)));
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                }
            }

            $this->_redirect('*/*/index'); 
    }
}

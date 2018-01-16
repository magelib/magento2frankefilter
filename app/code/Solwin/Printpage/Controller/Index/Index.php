<?php
/**
 * Solwin Infotech
 * Solwin Product Print Page
 * 
 * @category   Solwin
 * @package    Solwin_Printpage
 * @copyright  Copyright © 2006-2016 Solwin (https://www.solwininfotech.com)
 * @license    https://www.solwininfotech.com/magento-extension-license/
 */
namespace Solwin\Printpage\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /* 
     * Load and render layout 
     */

    public function execute() {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }

}
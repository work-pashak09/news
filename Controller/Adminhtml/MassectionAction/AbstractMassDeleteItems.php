<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 18.09.18
 * Time: 15:26
 */

namespace Neklo\News\Controller\Adminhtml\MassectionAction;

use Magento\Backend\App\Action;
use \Magento\Ui\Component\MassAction\Filter;
use \Magento\Backend\App\Action\Context;

abstract class AbstractMassDeleteItems extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Neklo_News::delete';

    protected $_filter;

    public function execute() {
        try {

            $logCollection = $this->getCollectionFactory()->create();

            if($this->_request->getParam('excluded') == 'false'){
                $logCollection->getItems();
            }
            else {
                $logCollection->addFieldToFilter('id',['in' => $this->_request->getParam('selected')]);
            }

            foreach ($logCollection as $item) {
                $item->delete();
            }

            $this->messageManager->addSuccess(__('Log Deleted Successfully.'));
        }catch(\Exception $e){
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }

    abstract public function getCollectionFactory();
}
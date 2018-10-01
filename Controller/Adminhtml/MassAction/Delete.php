<?php

namespace Neklo\News\Controller\Adminhtml\MassAction;

abstract class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article_delete';

    public function execute()
    {
        try {
            $collection = $this->getCollectionFactory()->create();

            if ($this->_request->getParam('excluded') == 'false') {
                $collection->getItems();
            } else {
                $collection->addFieldToFilter('id', ['in' => $this->_request->getParam('selected')]);
            }
            foreach ($collection as $item) {
                $item->delete();
            }
            $this->messageManager->addSuccess(__('Deleted Successfully'));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
    abstract public function getCollectionFactory();
}

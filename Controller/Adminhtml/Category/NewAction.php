<?php

namespace Neklo\News\Controller\Adminhtml\Category;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        return $this->_forward('edit');
    }
}

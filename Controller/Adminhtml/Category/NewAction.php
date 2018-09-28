<?php

namespace Neklo\News\Controller\Adminhtml\Category;

class NewAction extends \Magento\Backend\App\Action
{
    public function execute()
    {
        return $this->_forward('edit');
    }
}

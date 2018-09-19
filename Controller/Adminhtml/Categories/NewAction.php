<?php

namespace Neklo\News\Controller\Adminhtml\Categories;

class NewAction extends \Magento\Backend\App\Action
{
    public function execute()
    {
        return $this->_forward('edit');
    }
}

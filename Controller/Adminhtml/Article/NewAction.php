<?php

namespace Neklo\News\Controller\Adminhtml\Article;


class NewAction extends  \Magento\Backend\App\Action
{

    public function execute()
    {
    return  $this->_forward('edit');
    }
}

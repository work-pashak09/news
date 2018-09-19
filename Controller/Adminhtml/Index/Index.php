<?php

namespace Neklo\News\Controller\Adminhtml\Index;

class Index extends  \Magento\Backend\App\Action
{

    public function execute()
    {
      return  $this->_forward('index','article');
    }
}

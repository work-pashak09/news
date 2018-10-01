<?php

namespace Neklo\News\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        return $this->_forward('index', 'article');
    }
}

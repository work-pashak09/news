<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Edit extends \Magento\Backend\App\Action
{
    private $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Edit article')));
        return $resultPage;
    }
}

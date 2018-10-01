<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article_save';
    /** @var \Magento\Framework\View\Result\PageFactory  */
    private $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));
        return $resultPage;
    }
}

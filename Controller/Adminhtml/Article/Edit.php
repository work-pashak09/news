<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article_save';
    /** @var \Magento\Framework\View\Result\PageFactory */
    private $resultPageFactory;
    /** @var \Magento\Framework\Registry */
    private $registry;
    /** @var \Neklo\News\Model\ArticleFactory */
    private $articleFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\ArticleFactory $articleFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->articleFactory = $articleFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $param = $this->getRequest()->getParam('id');
        if (is_numeric($param) && $this->articleFactory->create()->load($param, 'id')->getData()) {
            $this->registry->register('id', $param);
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Edit article')));
        } else {
            return $this->_redirect('news/article');
        }
        return $resultPage;
    }
}

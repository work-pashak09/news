<?php


namespace Neklo\News\Controller\ShowArticlesCategory;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;
    private $model;
    private $registry;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Model\CategoriesFactory $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->model = $model;
        parent::__construct($context);
    }

    public function execute()
    {
        $cat = $this->model->create()->load(
            $this->_request->getParam('cat_id')
        );
        if (!$cat->getData()) {
            $this->messageManager->addErrorMessage(__('Not found category'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('news');
        }
        $this->registry->register('current_news_category', $cat);
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    public function getPartUrl()
    {
        return $this->registry->registry('partUrl');
    }
}

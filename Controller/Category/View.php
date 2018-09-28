<?php

namespace Neklo\News\Controller\Category;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;

    private $model;

    private $registry;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Model\CategoryFactory $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->model = $model;
        parent::__construct($context);
    }

    public function execute()
    {
        $article = $this->model->create()->load($this->_request->getParam('cat_id'));
        if (!$article->getId()) {
            $this->messageManager->addErrorMessage(__('Not found category'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('news');
        } elseif (!$article->getData('is_active')) {
            $this->messageManager->addErrorMessage(__('category is close'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('index');
        }
        $this->registry->register('article_category', $article);
        return $this->resultPageFactory->create();
    }

    public function getPartUrl()
    {
        return $this->registry->registry('partUrl');
    }
}

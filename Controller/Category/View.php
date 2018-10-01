<?php

namespace Neklo\News\Controller\Category;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class View extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    private $resultPageFactory;
    /** @var \Neklo\News\Model\CategoryFactory  */
    private $model;
    /** @var \Magento\Framework\Registry  */
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

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
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

    /**
     * @return string
     */
    public function getPartUrl()
    {
        return $this->registry->registry('partUrl');
    }
}

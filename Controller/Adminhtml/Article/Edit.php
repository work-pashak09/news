<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article';
    private $resultPageFactory = false;

    private $registry;
    private $model;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\NewsFactory $model,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->model = $model;
    }

    public function execute()
    {
        $param = $this->getRequest()->getParam('id');
        if (is_numeric($param) && $this->model->create()->load($param, 'id')->getData()) {
            $this->registry->register('id', $param);
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Edit new')));
        } else {
            return $this->_redirect('news/article');
        }
        return $resultPage;
    }
}

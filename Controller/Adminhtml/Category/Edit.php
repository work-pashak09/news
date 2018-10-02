<?php

namespace Neklo\News\Controller\Adminhtml\Category;

use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::category_save';
    /**
     * @var bool|\Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var \Neklo\News\Model\Category
     */
    private $model;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Neklo\News\Model\Category $model
     * @param Registry $registry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\Category $model,
        Registry $registry
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->model = $model;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $param = $this->getRequest()->getParam('id');
        if ($param && is_numeric($param) && $this->model->getOne($param)) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Edit Category')));
            $this->registry->register(
                'id',
                $param
            );
        } else {
            $resultPage = $this->resultPageFactory->create();
        }
        return $resultPage;
    }
}

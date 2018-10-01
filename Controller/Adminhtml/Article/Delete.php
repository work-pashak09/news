<?php

namespace Neklo\News\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;
use Neklo\News\Model\Article as ModelData;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article_delete';
    /** @var ModelData */
    private $newsModel;

    /**
     * @param Action\Context $context
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        ModelData $newsModel
    ) {
        $this->newsModel = $newsModel;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $post = $this->getRequest()->getParam('id');
            $model = $this->newsModel->load($post);
            $model->delete();
            $this->messageManager->addSuccess(__('Delete sucses'));
            $this->_redirect('news/article/index');
        } catch (\Exception $e) {
            $this->messageManager->addError(__('Something went wrong'));
            $this->_redirect('news/article/index');
        }
    }
}

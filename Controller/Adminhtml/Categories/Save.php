<?php

namespace Neklo\News\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;
use Neklo\News\Model\Categories as ModelData;


class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::save';

    private $newsModel;
    private $authorization;

    /**
     * @param Action\Context $context
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        ModelData $newsModel,
         \Magento\Framework\AuthorizationInterface $authorization
    ) {
       $this->newsModel = $newsModel;
       parent::__construct($context);
       $this->authorization = $authorization;
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
                $model = $this->newsModel;
                $model->setData($post);
                $model->save();
                $this->messageManager->addSuccess(__('Your values has beeen submitted successfully.'));

        $this->_redirect('news/categories/index');
    }



}

<?php

namespace Neklo\News\Controller\View;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;
    private $modelFactory;
    private $registry;
    private $config;

    private $var_dump;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\NewsFactory $modelFactory,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Helper\Config $config
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->modelFactory = $modelFactory;
        $this->registry = $registry;
        $this->config = $config;
        parent::__construct($context);
    }

    public function execute()
    {



        $idPost = $this->_request->getParam('id', null);
        if (!$this->registry->registry('article') && !$idPost) {
            return $this->_redirect('*/index');
        } else {
            if ($idPost) {
                $model = $this->modelFactory->create()
                    ->getCollection();
                $model->getSelect()
                    ->joinLeft([
                        'second' => 'neklo_news_category'
                        ],
                        'main_table.category_id = second.id'
                    );
                $news = $model->addFieldToFilter('main_table.id', $idPost);

                if (!$news->getId()) {
                    return $this->_redirect('*/index');
                }
                $this->registry->register('partUrl', $this->config->getUrlNews());
                $this->registry->register('article', $news[0]);
            }
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}

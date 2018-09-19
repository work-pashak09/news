<?php

namespace Neklo\News\Controller\View;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    private $modelFactory;
    private $registry;
    private $config;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\NewsFactory $modelFactory,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Helper\Config $config
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
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
                    ->joinLeft(['second' => 'cms_categories_news'],
                        'main_table.categories_id = second.id');
                $news = $model->addFieldToFilter('main_table.id', $idPost)->getData();
                if (!$news) {
                    return $this->_redirect('*/index');
                }
                 $this->registry->register('partUrl',$this->config->getUrlNews());
                $this->registry->register('article', $news[0]);
            }
        }
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
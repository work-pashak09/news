<?php

namespace Neklo\News\Controller\View;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    private $resultPageFactory;
    /** @var $collection    */
    private $collection;
    /** @var $modelFactory    */
    private $registry;
    /** @var $config    */
    private $config;

    /**
     * @param Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Neklo\News\Model\ResourceModel\Article\Collection $collection
     * @param \Magento\Framework\Registry $registry
     * @param \Neklo\News\Helper\Config $config
     */
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\ResourceModel\Article\Collection $collection,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Helper\Config $config
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->collection = $collection;
        $this->registry = $registry;
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $idPost = $this->_request->getParam('id', null);
        if (!$this->registry->registry('article') && !$idPost) {
            return $this->_redirect('*/index');
        } else {
            if ($idPost) {
                $article = $this->collection->get($idPost);
                if (!$article->getId()) {
                    return $this->_redirect('*/index');
                }

                $this->registry->register('article', $article->getFirstItem());
            }
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}

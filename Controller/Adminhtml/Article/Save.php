<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article_save';

    /** @var \Neklo\News\Model\ArticleFactory  */
    private $articleFactory;
    /** @var \Neklo\News\Model\CategoryFactory  */
    private $categoryFactory;
    /** @var \Neklo\News\Model\ResourceModel\Article\CollectionFactory  */
    private $collectionFactory;
    /** @var \Magento\Framework\AuthorizationInterface  */
    private $authorization;
    /** @var \Magento\Framework\Registry  */
    private $registry;
    /** @var Validate  */
    private $validate;
    /** @var \Neklo\News\Helper\Config  */
    private $config;
    /** @var \Magento\UrlRewrite\Model\UrlPersistInterface  */
    private $persist;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param\ Neklo\News\Model\ArticleFactory $articleFactory
     * @param \Neklo\News\Model\CategoryFactory $categoryFactory
     * @param \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory
     * @param \Magento\Framework\AuthorizationInterface $authorization
     * @param \Magento\UrlRewrite\Model\UrlRewrite $rewrite
     * @param \Magento\UrlRewrite\Model\UrlFinderInterface $finder
     * @param \Magento\Framework\Registry $registry
     * @param \Neklo\News\Helper\Config $config
     * @param \Magento\UrlRewrite\Model\UrlPersistInterface $persist
     * @param Validate $validate
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Neklo\News\Model\ArticleFactory $articleFactory,
        \Neklo\News\Model\CategoryFactory $categoryFactory,
        \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory,
        \Magento\Framework\AuthorizationInterface $authorization,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Helper\Config $config,
        \Magento\UrlRewrite\Model\UrlPersistInterface $persist,
        \Neklo\News\Controller\Adminhtml\Article\Validate $validate
    ) {
        $this->articleFactory = $articleFactory;
        $this->categoryFactory = $categoryFactory;
        $this->collectionFactory = $collectionFactory;
        $this->authorization = $authorization;
        $this->registry = $registry;
        $this->validate = $validate;
        $this->config = $config;
        $this->persist = $persist;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $post = $this->_request->getParams();
        $error = $this->validate->cheakPostData($post);
        if ($error) {
            $this->messageManager->addError(__($error[0]));
            return $this->_redirect("news/article/edit/id/{$post['id']}");
        }
        $model = $this->articleFactory->create()->load($post['id']);
        if (!$model->getId()) {
            $this->messageManager->addError(__('id not find'));
            return $this->_redirect("news/article/edit/id/{$model->getId()}");
        }
        $category = $this->categoryFactory->create()->load($model->getData('category_id'));
        if ($model->getData('url_key') !== $post['url_key']) {
            $iscloset = $this->collectionFactory->create()
                ->addFieldToFilter('url_key', $post['url_key'])
                ->addFieldToFilter('category_id', $model->getData('category_id'))
                ->getFirstItem()
                ->getData();
            if ($iscloset) {
                $this->messageManager->addError(__('url_key is busy'));
                return $this->_redirect("news/article/edit/id/{$post['id']}");
            }
            if ($post['rewrite_url']) {
                $this->articleFactory->rewriteUrlArticle(
                    $model,$category,
                    $this->config->getUrlActicleName(),
                    $post['url_key'],
                    $this->config->getPrefixUrlActicle()
                );
                unset($post['rewrite_url']);
            } else {
                $this->persist->deleteByData(['entity_id' => $model->getData('id')]);
            }
        }
        $model = $this->articleFactory->create();
        $model->setData($post);
        $model->save();
        $this->messageManager->addSuccess(__('Your values has beeen submitted successfully.'));
        return $this->_redirect('news/article/index');
    }
}

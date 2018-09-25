<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::save';

    private $newsFactory;
    private $categoryFactory;
    private $collectionFactory;
    private $authorization;
    private $rewrite;
    private $finder;
    private $registry;
    private $validate;
    private $config;
    private $persist;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Neklo\News\Model\NewsFactory $newsFactory,
        \Neklo\News\Model\CategoriesFactory $categoryFactory,
        \Neklo\News\Model\ResourceNews\News\CollectionFactory $collectionFactory,
        \Magento\Framework\AuthorizationInterface $authorization,
        \Magento\UrlRewrite\Model\UrlRewrite $rewrite,
        \Magento\UrlRewrite\Model\UrlFinderInterface $finder,
        \Magento\Framework\Registry $registry,
        \Neklo\News\Helper\Config $config,
        \Magento\UrlRewrite\Model\UrlPersistInterface $persist,
        \Neklo\News\Controller\Adminhtml\Article\Validate $validate
    ) {
        $this->newsFactory = $newsFactory;
        $this->categoryFactory = $categoryFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
        $this->authorization = $authorization;
        $this->rewrite = $rewrite;
        $this->finder = $finder;
        $this->registry = $registry;
        $this->validate = $validate;
        $this->config = $config;
        $this->persist = $persist;
    }

    public function execute()
    {
        $post = $this->_request->getParams();

        $error = $this->validate->cheakError($post);
        if ($error) {
            $this->messageManager->addError(__($error[0]));
            return $this->_redirect("news/article/edit/id/{$post['id']}");
        }

        $model = $this->newsFactory->create()->load($post['id']);

        if (!$model->getId()) {
            $this->messageManager->addError(__('id not find'));
            return $this->_redirect("news/article/edit/id/{$model->getId()}");
        }
        $category = $this->categoryFactory->create()->load($model->getData('categories_id'));
        if ($model->getData('url_key') !== $post['url_key']) {
            $iscloset = $this->collectionFactory->create()
                ->addFieldToFilter('url_key', $post['url_key'])
                ->addFieldToFilter('categories_id', $model->getData('categories_id'))
                ->getFirstItem()
                ->getData();
            if ($iscloset) {
                $this->messageManager->addError(__('url_key is busy'));
                return $this->_redirect("news/article/edit/id/{$post['id']}");
            }
            if ($post['rewrite_url']) {
                $partUrlNews = $this->config->getUrlNews();
                $pref = $this->config->getPrifixUrl();
                $this->rewrite
                    ->setStoreId(1)
                    ->setEntityType('Neklo_news')
                    ->setEntityId($model->getData('id'))
                    //current url
                    ->setRequestPath("$partUrlNews/{$category->getData('categoria')}/{$model->getData('url_key')}$pref")
                    //redirect
                    ->setTargetPath("$partUrlNews/{$category->getData('categoria')}/{$post['url_key']}$pref")
                    ->setRedirectType(301)
                    ->setMetadata(['categoria_id' => $model->getData('categoria')])
                    ->save();
                unset($post['rewrite_url']);
            } else {
                $this->persist->deleteByData(['entity_id' => $model->getData('id')]);
            }
        }
        $model = $this->newsFactory->create();

        $model->setData($post);
        $model->save();
        $this->messageManager->addSuccess(__('Your values has beeen submitted successfully.'));
        return $this->_redirect('news/article/index');
    }
}

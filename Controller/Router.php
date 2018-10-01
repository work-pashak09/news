<?php

namespace Neklo\News\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    /** @var \Magento\Framework\App\ActionFactory  */
    private $actionFactory;
    /** @var \Neklo\News\Helper\Config  */
    private $config;
    /** @var \Magento\Framework\App\ResponseInterface  */
    private $response;
    /** @var  \Neklo\News\Model\CategoryFactory*/
    private $categoriesFactory;
    /** @var \Neklo\News\Model\ArticleFactory  */
    private $news;
    /** @var \Magento\Framework\Registry  */
    private $registry;
    /** @var \Magento\Framework\App\Action\RedirectFactory  */
    private $redirect;
    /** @var \Neklo\News\Helper\ParserUrl  */
    private $parserUrl;
    /** @var \Neklo\News\Model\ResourceModel\Article\Collection  */
    private $newsCollection;

    /**
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\App\ResponseInterface $response
     * @param \Neklo\News\Helper\Config $config
     * @param \Neklo\News\Model\CategoryFactory $categoryegoriesFactory
     * @param \Neklo\News\Model\ArticleFactory $news
     * @param \Neklo\News\Model\ResourceModel\Article\Collection $newsCollection
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Action\RedirectFactory $redirect
     * @param \Neklo\News\Helper\ParserUrl $parserUrl
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
        \Neklo\News\Helper\Config $config,
        \Neklo\News\Model\CategoryFactory $categoryegoriesFactory,
        \Neklo\News\Model\ArticleFactory $news,
        \Neklo\News\Model\ResourceModel\Article\Collection $newsCollection,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Action\RedirectFactory $redirect,
        \Neklo\News\Helper\ParserUrl $parserUrl
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->news = $news;
        $this->messageManager = $messageManager;
        $this->config = $config;
        $this->registry = $registry;
        $this->categoriesFactory = $categoryegoriesFactory;
        $this->redirect = $redirect;
        $this->parserUrl = $parserUrl;
        $this->newsCollection = $newsCollection;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $partUrl = $this->parserUrl->parse();
        $nameUrlArticleConfig = $this->config->getNameUrlLinkArticle();
        $articleUrlConfigActiv = $this->config->isEnabledLinkOnNews();

        if ($nameUrlArticleConfig !== $partUrl['linkList']) {
            return null;
        } elseif (!$articleUrlConfigActiv) {
            return $this->redirect($request, 'index', 'article list is not available');
        }
        list($moduleName, $controllerName, $actionName) = ['news', 'index', 'index'];
        switch (count($partUrl)) {
            case 2:
                $category = $this->categoriesFactory->create()->load($partUrl['nameCategory'], 'category');
                if (!$category->getId()) {
                    return $this->redirect(
                        $request,
                        $nameUrlArticleConfig,
                        'this category is not found'
                    );
                } elseif (!$category->getData('is_active')) {
                    return $this->redirect(
                        $request,
                        $nameUrlArticleConfig,
                        "{$partUrl['nameCategory']} category is not available"
                    );
                }
                $controllerName = 'category';
                $actionName = 'view';
                $request->setParam('cat_id', $category->getId());
                break;
            case 3:
                $prefix = $this->config->getPrefixUrlActicle();
                if (strpos($partUrl['urlArticle'], $prefix) === false) {
                    $category = $this->categoriesFactory->create()->load($partUrl['nameCategory'], 'category');
                    if ($category->getId() && $category->getData('is_active')) {
                        $urlRequest = "$nameUrlArticleConfig/{$partUrl['nameCategory']}";
                    } else {
                        $urlRequest = $nameUrlArticleConfig;
                    }
                    return $this->redirect(
                        $request,
                        $urlRequest,
                        "this article is not found"
                    );
                }
                $partUrl['urlArticle'] = str_replace($prefix, '', $partUrl['urlArticle']);
                $news = $this->newsCollection->getDataArticle($partUrl['urlArticle'], $partUrl['nameCategory']);
                if (!$news->getId()) {
                    return $this->redirect($request, "$nameUrlArticleConfig", 'this article is not found');
                } elseif (!$news->getData('nnc_is_active')) {
                    $this->redirect(
                        $request,
                        "$nameUrlArticleConfig/{$news->getData('nnc_category')}",
                        "{$partUrl['nameCategory']} category is not available"
                    );
                } elseif (!$news->getData('main_is_active')) {
                    $category = $news->getData('nnc_category');
                    $this->redirect(
                        $request,
                        "$nameUrlArticleConfig/$category",
                        "acticle is not available"
                    );
                }
                $this->registry->register('article', $news);
                $this->registry->register('partUrl', $nameUrlArticleConfig);
                $controllerName = 'view';
                break;
        }
        $request->setModuleName($moduleName)->setControllerName($controllerName)->setActionName($actionName);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
    }

    /*
     * @return \Magento\Framework\App\ActionInterface
     */
    public function redirect($request, $url, $message)
    {
        $this->messageManager->addErrorMessage($message);
        $this->response->setRedirect("/$url");
        $request->setDispatched(true);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Redirect::class);
    }
}

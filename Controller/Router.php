<?php

namespace Neklo\News\Controller;

class Router implements \Magento\Framework\App\RouterInterface
{
    private $actionFactory;
    private $config;
    private $response;
    private $categoriesFactory;
    private $news;
    private $registry;
    private $redirect;
    private $rewrite;
    private $finder;
    private $parserUrl;

    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
        \Neklo\News\Helper\Config $config,
        \Neklo\News\Model\CategoriesFactory $categoriesFactory,
        \Neklo\News\Model\News $news,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Action\RedirectFactory $redirect,
        \Magento\UrlRewrite\Model\UrlRewrite $rewrite,
        \Magento\UrlRewrite\Model\UrlFinderInterface $finder,
        \Neklo\News\Helper\ParserUrl $parserUrl
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->news = $news;
        $this->messageManager = $messageManager;
        $this->config = $config;
        $this->registry = $registry;
        $this->categoriesFactory = $categoriesFactory;
        $this->redirect = $redirect;
        $this->rewrite = $rewrite;
        $this->finder = $finder;
        $this->parserUrl = $parserUrl;
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $partUrl = explode('/', trim($request->getPathInfo(), '/'));
        list($moduleName, $controllerName, $actionName) = ['news', 'index', 'index'];
        foreach ($partUrl as $index => $value) {
            switch ($index) {
                case 0:
                    if ($this->config->getUrlNews() !== $partUrl[$index]) {
                        return null;
                    } elseif (!$this->config->isEnabledLinkOnNews()) {
                        return $this->redirectMainPage($request);
                    }
                    break;
                case 1:
                    $cat = $this->categoriesFactory->create()->load($value, 'category');
                    if (!$cat->getId() || !$cat->getData('is_active')) {
                        return $this->redirectMainPage($request);
                    }
                    $controllerName = 'ShowArticlesCategory';
                    $request->setParam('cat_id', $cat->getId());
                    break;
                case 2:
                    $prefix = $this->config->getPrifixUrl();
                    if (strpos($value, $prefix) === false) {
                        return $this->redirectMainPage($request);
                    }
                    $value = str_replace($prefix, '', $value);
                    $news = $this->news->load($value, 'url_key');
                    if (!$news->getId()) {
                        return $this->redirectMainPage($request);
                    } elseif (!$news->getData('is_active')) {
                        $this->redirectCategoriesList($request, $cat->getCategory());
                    }
                    $this->registry->register('article', $news);
                    $controllerName = 'view';
                    break;
            }
        }
        $request->setModuleName($moduleName)->setControllerName($controllerName)->setActionName($actionName);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
    }

    public function redirectMainPage($request)
    {
        $this->response->setRedirect("/{$this->config->getUrlNews()}");
        $request->setDispatched(true);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Redirect::class);
    }

    public function redirectCategoriesList($request, $nameCategory)
    {
        $this->response->setRedirect("/{$this->config->getUrlNews()}/$nameCategory");
        $request->setDispatched(true);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Redirect::class);
    }
}

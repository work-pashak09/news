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
        \Magento\UrlRewrite\Model\UrlFinderInterface $finder
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
    }

    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = explode('/', trim($request->getPathInfo(), '/'));
        if ($identifier[0] == $this->config->getUrlNews()) {
            $this->registry->register('partUrl', $this->config->getUrlNews());

            if ($this->config->getIsEnabled()) {
                $countParts = count($identifier);
                if ($countParts === 1) {
                    $request->setModuleName('news')->setControllerName('index')->setActionName('index');
                } else {
                    $cat = $this->categoriesFactory->create()->load($identifier[1], 'categoria');
                    if (!$cat->getId() || !$cat->getData('is_activ')) {
                        return $this->redirectMainPage($request);
                    } else {
                        if ($countParts === 2) {
                            $request->setModuleName('news')
                                ->setControllerName('ShowCatNews')
                                ->setActionName('index')
                                ->setParam('cat_id', $cat->getId());
                        } else {
                            if ($countParts == 3) {
                                $prefix = $this->config->getPrifixUrl();
                                if (strpos($identifier[2], $prefix) !== false) {
                                    $identifier[2] = str_replace($prefix, '', $identifier[2]);
                                    $news = $this->news->getCollection();
                                    $news->getSelect()->joinLeft([
                                        'second' => 'cms_categories_news'
                                    ], 'main_table.categories_id = second.id');
                                    $news = $news->addFieldToFilter('url_key', $identifier[2])->getData();
                                    if ($news) {
                                        $this->registry->register('article', $news[0]);
                                        $request->setModuleName('news')
                                            ->setControllerName('view')
                                            ->setActionName('index');
                                        return $this->actionFactory
                                            ->create(\Magento\Framework\App\Action\Forward::class);
                                    } else {
                                        return $this->redirectMainPage($request);
                                    }
                                } else {
                                    return $this->redirectMainPage($request);
                                }
                            } else {
                                return $this->redirectMainPage($request);
                            }
                        }
                    }
                }
            }
        }

        else {
            return null;
        }
        return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
    }

    public function redirectMainPage($request)
    {
        $this->response->setRedirect("/{$this->config->getUrlNews()}");
        $request->setDispatched(true);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Redirect::class);
    }
}

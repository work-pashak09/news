<?php

namespace Neklo\News\Helper;

class ParserUrl
{
    private $config;
    private $request;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Neklo\News\Helper\Config $config
    ) {
        $this->config = $config;
        $this->request = $request;
    }

    public function getPartUrl()
    {
        $partUrl = explode('/', trim($this->request->getPathInfo(), '/'));
        switch (count($partUrl)) {
            case 1:
                if ($this->config->getUrlNews() !== $partUrl[0]) {
                    return false;
                } else {
                    $arr = ['linkList' => $partUrl[0]];
                    break;
                }
            case 2:
                $arr = ['linkList' => $partUrl[0], 'nameCategory' => $partUrl[1]];
                break;
            case 3:
                $arr = [
                    'linkList' => $partUrl[0],
                    'urlArticle' => $partUrl[2],
                    'nameCategory' => $partUrl[1]
                ];
                break;
        }
        return $arr;
    }


    public function parse()
    {
        $partUrl = explode('/', trim($this->request->getPathInfo(), '/'));
        foreach ($partUrl as $index => $index) {
            switch ($index) {
                case 0:
                    if ($this->config->getUrlNews() !== $partUrl[$index]) {
                        return null;
                    } elseif (!$this->config->isEnabledLinkOnNews()) {
                        return 'on main';
                    }
                    break;
                case 2:
                    $cat = $this->categoriesFactory->create()->load($partUrl[$index], 'category');
                    if (!$cat->getId() || !$cat->getData('is_active')) {
                        return 'on main';
                    }
                    break;
                case 3:
                    $prefix = $this->config->getPrifixUrl();
                    if (strpos($partUrl[$index], $prefix) !== false) {
                        $identifier[2] = str_replace($prefix, '', $partUrl[$index]);
                        $news = $this->news->getCollection();
                        $news->getSelect()->joinLeft([
                            'second' => 'neklo_news_category'
                        ], 'main_table.category_id = second.id');
                        $news = $news->addFieldToFilter('url_key', $identifier[2])->getFirstItem();
                        if ($news->getId()) {
                            $this->registry->register('article', $news);
                            $request->setModuleName('news')
                                ->setControllerName('view')
                                ->setActionName('index');
                            return $this->actionFactory
                                ->create(\Magento\Framework\App\Action\Forward::class);
                        } else {
                            return $this->redirectMainPage($request);
                        }
                    }
                    break;
            }
        }

    }
}

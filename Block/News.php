<?php


namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class News extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;

    private $config;

    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\ResourceNews\News\CollectionFactory $collectionFactory,
        \Neklo\News\Helper\Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
    }

    public function getNews()
    {
        $newsModel = $this->collectionFactory->create();
        $newsModel
            ->getSelect()->
            joinLeft(
                [
                    'second' => 'neklo_news_category'
                ],
                'main_table.category_id = second.id'
            );
        return $newsModel;
    }

    public function getNameTable()
    {
        return $this->config->getNameTable();
    }

    public function getPrefixUrl()
    {
        return $this->config->getPrifixUrl();
    }

    public function getUrlNews()
    {
        return $this->config->getUrlNews();
    }

    public function getUrlArticle($cat, $urlKey)
    {
        return $this->escapeUrl("/{$this->getUrlNews()}/$cat/$urlKey{$this->getPrefixUrl()}");
    }
}

<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class Article extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Neklo\News\Model\ResourceModel\Article\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Neklo\News\Helper\Config
     */
    private $config;

    /**
     * @param Template\Context $context
     * @param \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory
     * @param \Neklo\News\Helper\Config $config
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory,
        \Neklo\News\Helper\Config $config,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
    }

    /**
     * @return \Neklo\News\Model\ResourceModel\Article\Collection
     */
    public function getNews()
    {
        return $this->collectionFactory->create()->getCollectionArticle();
    }

    public function getNameTable()
    {
        return $this->config->getNameTable();
    }

    public function getPrefixUrl()
    {
        return $this->config->getPrefixUrlActicle();
    }

    public function getUrlActicleName()
    {
        return $this->config->getNameUrlLinkArticle();
    }

    public function getUrlArticle($category, $urlKey)
    {
        return $this->escapeUrl("/{$this->getUrlActicleName()}/$category/$urlKey{$this->getPrefixUrl()}");
    }
}

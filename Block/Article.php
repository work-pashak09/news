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

    /**
     * @return  string
     */
    public function getNameTable()
    {
        return $this->config->getNameTable();
    }

    /**
     * @return  string
     */
    public function getPrefixUrl()
    {
        return $this->config->getPrefixUrlActicle();
    }

    /**
     * @return  string
     */
    public function getUrlActicleName()
    {
        return $this->config->getNameUrlLinkArticle();
    }

    /**
     * @return  string
     */
    public function getUrlArticle($category, $urlKey)
    {
        $prefix = $this->getPrefixUrl();
        $articleName = $this->getUrlActicleName();
        return $this->escapeUrl("/$articleName/$category/$urlKey{$prefix}");
    }
}

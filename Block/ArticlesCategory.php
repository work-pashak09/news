<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class ArticlesCategory extends \Magento\Framework\View\Element\Template
{
    /** @var \Neklo\News\Model\ResourceModel\Article\CollectionFactory */
    private $collectionFactory;
    /** @var \Magento\Framework\Registry */
    private $registry;
    /** @var \Neklo\News\Helper\Config */
    private $config;

    /**
     * ArticlesCategory constructor.
     * @param Template\Context $context
     * @param \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory
     * @param \Neklo\News\Helper\Config $config
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory,
        \Neklo\News\Helper\Config $config,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->registry = $registry;
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->config = $config;
    }

    /** @return  boolean */
    public function canShow()
    {
        $category = $this->getCategory();
        return $category && $category->getId();
    }

    /**
     * @return \Neklo\News\Model\ResourceModel\Article\CollectionFactory
     */
    public function getArticleCategory()
    {
        $coleecttin = $this->collectionFactory->create()
            ->addFieldToFilter('category_id', $this->getCategory()->getId());
        return $coleecttin;
    }

    /**
     * @return \Neklo\News\Model\CategoryFactory
     */
    public function getCategory()
    {
        return $this->registry->registry('article_category');
    }

    /** @return  string */
    public function getPartUrlNews()
    {
        return $this->escapeUrl("/{$this->config->getNameUrlLinkArticle()}/");
    }

    /** @return  string */
    public function getPrefix()
    {
        return $this->config->getPrefixUrlActicle();
    }

    /** @return  string */
    public function getAticleWithCatategory($urlKey)
    {
        return $this->escapeUrl("/{$this->config->getNameUrlLinkArticle()}/" .
            "{$this->getCategory()->getCategory()}/$urlKey{$this->getPrefix()}");
    }
}

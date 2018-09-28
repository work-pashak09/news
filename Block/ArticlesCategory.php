<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class ArticlesCategory extends \Magento\Framework\View\Element\Template
{
    /** @var \Neklo\News\Model\ResourceModel\Article\CollectionFactory  */
    private $collectionFactory;
    /** @var \Magento\Framework\Registry  */
    private $registry;
    /** @var \Neklo\News\Helper\Config  */
    private $config;

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

    public function getCategory()
    {
        return $this->registry->registry('article_category');
    }

    public function getPartUrlNews()
    {
        return $this->escapeUrl("/{$this->config->getNameUrlLinkArticle()}/");
    }

    public function getPrefix()
    {
        return $this->config->getPrefixUrlActicle();
    }

    public function getAticleWithCatategory($urlKey)
    {
        return $this->escapeUrl("/{$this->config->getNameUrlLinkArticle()}/{$this->getCategory()->getCategory()}/$urlKey{$this->getPrefix()}");
    }
}

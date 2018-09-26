<?php


namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class ArticlesCategory extends \Magento\Framework\View\Element\Template
{
    private $collectionFactory;
    private $registry;
    private $config;

    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\ResourceNews\News\CollectionFactory $collectionFactory,
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

    public function getNewsCat()
    {
        $col = $this->collectionFactory->create();

        $col->addFieldToFilter('category_id', $this->getCategory()->getId());

        return $col;
    }

    public function getCategory()
    {
        return $this->registry->registry('current_news_category');
    }

    public function getPartUrlNews()
    {
        return $this->escapeUrl("/{$this->registry->registry('partUrl')}/");
    }

    public function getPrefix()
    {
        return $this->config->getPrifixUrl();
    }

    public function getAticleWithCatategory($urlKey)
    {
        return $this->escapeUrl("/{$this->getCategory()->getCategory()}/$urlKey{$this->getPrefix()}");
    }
}

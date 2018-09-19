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
        $newsModel->getSelect()->joinLeft(['second' => 'cms_categories_news'],
            'main_table.categories_id = second.id');
        return $newsModel->getData();
    }

    public function GetNameTable(){
      return  $this->config->getNameTable();
    }
    public function getPrefixUrl(){
      return  $this->config->getPrifixUrl();
    }
    public function getUrlNews(){
      return  $this->config->getUrlNews();
    }
}
<?php

namespace Neklo\News\Ui\DataProvider;

class Article extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /** @var array */
    private $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionArticle
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionArticle,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionArticle->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $article) {
            $this->loadedData[$article->getId()] = $article->getData();
        }
        return $this->loadedData;
    }

    public function getCollection()
    {
        return $this->collection;
    }
}

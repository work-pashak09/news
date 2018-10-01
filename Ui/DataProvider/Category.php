<?php

namespace Neklo\News\Ui\DataProvider;

class Category extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /** @var  array*/
    private $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $colectionCategory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Neklo\News\Model\ResourceModel\Category\CollectionFactory $colectionCategory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $colectionCategory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $category) {
            $this->loadedData[$category->getId()] = $category->getData();
        }
        return $this->loadedData;
    }

    /**
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection|\Neklo\News\Model\ResourceModel\Category\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }
}

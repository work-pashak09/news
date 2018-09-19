<?php

namespace Neklo\News\Model\DataProviders;

use \Neklo\News\Model\ResourceNews\News\CollectionFactory;

class DataProviderArticle extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    private $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $employeeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $employeeCollectionFactory->create();
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
        foreach ($items as $campaign) {
            $this->loadedData[$campaign->getId()] = $campaign->getData();
        }
        return $this->loadedData;
    }

    public function getCollection()
    {
        return $this->collection;
    }
}

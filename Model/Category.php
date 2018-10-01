<?php

namespace Neklo\News\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Neklo\News\Model\ResourceModel\Category as SnippetResource;

class Category extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'category_data';
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(SnippetResource::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getOne($id)
    {
        return $this->load($id, 'id')->getData();
    }
}

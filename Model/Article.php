<?php

namespace Neklo\News\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Neklo\News\Model\ResourceModel\Article as ResourceModelArticle;

class Article extends AbstractModel implements IdentityInterface
{
    /** @var \Magento\UrlRewrite\Model\UrlRewrite  */
    private $rewrite;
    /** @var \Magento\UrlRewrite\Model\UrlFinderInterface  */
    private $finder;
    const CACHE_TAG = 'article_data';

    /**
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\UrlRewrite\Model\UrlRewrite $rewrite,
        \Magento\UrlRewrite\Model\UrlFinderInterface $finder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->rewrite = $rewrite;
        $this->finder = $finder;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct()
    {
        $this->_init(ResourceModelArticle::class);
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

    /**
     * Return unique ID(s) for each object in system
     *
     * @return object
     */
    public function getOne($id)
    {
        return $this->load($id, 'id');
    }

    /*
    * @return void
    */
    public function rewriteUrlArticle($model, $category, $urlAcricle, $urlKey, $prefix)
    {
        $this->rewrite
            ->setStoreId(1)
            ->setEntityType('Neklo_news')
            ->setEntityId($model->getData('id'))
            //current url
            ->setRequestPath("$urlAcricle/{$category->getData('category')}/{$model->getData('url_key')}$prefix")
            //redirect
            ->setTargetPath("$urlAcricle/{$category->getData('category')}/{$urlKey}$prefix")
            ->setRedirectType(301)
            ->setMetadata(['category_id' => $model->getData('category')])
            ->save();
    }
}

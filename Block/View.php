<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class View extends \Magento\Framework\View\Element\Template
{
    private $model;
    /*** @var \Magento\Framework\Controller\ResultFactory */
    private $resultRedirect;
    /*** @var \Neklo\News\Model\Article */
    private $categoriesModel;
    /** @var \Magento\Framework\Registry */
    private $registry;

    /**
     * View constructor.
     * @param Template\Context $context
     * @param \Neklo\News\Model\Article $Model
     * @param \Neklo\News\Model\Article $categoriesModel
     * @param \Magento\Framework\Controller\ResultFactory $result
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\Article $Model,
        \Neklo\News\Model\Article $categoriesModel,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->model = $Model;
        $this->resultRedirect = $result;
        $this->registry = $registry;
        $this->categoriesModel = $categoriesModel;
    }

    /**
     * @return \Neklo\News\Model\CategoryFactory
     */
    public function getOneNews()
    {
        return $this->registry->registry('article');
    }

    /**
     * @return string
     */
    public function generalUrl()
    {
        return $this->escapeUrl("/{$this->registry->registry('partUrl')}/{$this->getOneNews()->getData('nnc_category')}");
    }
}

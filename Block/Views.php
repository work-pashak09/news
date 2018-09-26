<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;
use Magento\Setup\Exception;

class Views extends \Magento\Framework\View\Element\Template
{
    private $model;
    private $resultRedirect;
    private $categoriesModel;
    private $registry;

    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\News $Model,
        \Neklo\News\Model\News $categoriesModel,
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

    public function getOneNews()
    {
        return $this->registry->registry('article');
    }

    public function generalUrl()
    {
        return $this->escapeUrl("/{$this->registry->registry('partUrl')}/{$this->getOneNews()->getData('category')}");
    }
}

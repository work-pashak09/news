<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 07.09.18
 * Time: 16:09
 */

namespace Neklo\News\Block;


use Magento\Framework\View\Element\Template;
use Magento\Setup\Exception;

class Views extends \Magento\Framework\View\Element\Template
{
    private $model;
    private $resultRedirect;
    private $registry;

    public function __construct(
        Template\Context $context,
        \Neklo\News\Model\News $Model,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->model = $Model;
        $this->resultRedirect = $result;
        $this->registry = $registry;
    }

    public function getOneNews()
    {
        $data = $this->registry->registry('article');
        $data['partUrl'] = $this->registry->registry('partUrl');
        return $data;
    }
}
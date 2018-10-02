<?php

namespace Neklo\News\Block\Adminhtml\AbstractElements;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Neklo\News\Block\Adminhtml\Article\Button\Generic;

abstract class Button extends Generic implements ButtonProviderInterface
{
    const ADMIN_RESOURCE ='';
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;

    /**
     * AbstractButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\AuthorizationInterface $authorization
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\AuthorizationInterface $authorization
    ) {
        parent::__construct($context, $registry);
        $this->authorization = $authorization;
    }

    /**
     * @return bool
     */
    public function isAllowed()
    {
        return $this->authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}

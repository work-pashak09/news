<?php

namespace Neklo\News\Block\Adminhtml\AbstractElements\Massaction;

abstract class Item extends \Magento\Ui\Component\MassAction
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;

    /**
     * Massaction constructor.
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\AuthorizationInterface $authorization
     * @param $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\AuthorizationInterface $authorization,
        $components,
        array $data
    ) {
        $this->authorization = $authorization;
        parent::__construct($context, $components, $data);
    }

    /**
     * @return  void
     */
    public function prepare()
    {
        $config = $this->getConfiguration();
        $isAuth = $this->authorization->isAllowed(static::ADMIN_RESOURCE);
        if (!$isAuth) {
            $this->setData('config', '');
            return;
        }
        $this->setData('config', $config);
    }
}

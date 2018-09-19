<?php

namespace Neklo\News\Block\Adminhtml\AbstractElements\Massactions;

abstract class AbstractBaseMassection extends \Magento\Ui\Component\MassAction
{
    private $authorization;
    const ADMIN_RESOURCE = '';

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\AuthorizationInterface $authorization,
        $components,
        array $data
    ) {
        $this->authorization = $authorization;
        parent::__construct($context, $components, $data);
    }

    public function prepare()
    {
        $config = $this->getConfiguration();
        $original = $config;
        $isAut = $this->authorization->isAllowed(static::ADMIN_RESOURCE);
        if (!$isAut) {
            $this->setData('config', '');
            return;
        }
        foreach ($this->getChildComponents() as $item) {
            switch ($item->getName()) {
                case 'delete':
                    {
                        if ($isAut) {
                            $config['actions'][] = $item->getConfiguration();
                        }
                        break;
                    }
                case 'run':
                    {
                        if ($isAut) {
                            $config['actions'][] = $item->getConfiguration();
                        }
                        break;
                    }
            }
        }
        if ($config !== $original) {
            $config = array_replace_recursive($config, $original);
        }
        $this->setData('config', $config);
        $this->components = [];
    }
}
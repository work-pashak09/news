<?php

namespace Neklo\News\Block\Adminhtml\AbstractElements;

abstract class Massection extends \Magento\Ui\Component\MassAction
{
    /** @var \Magento\Framework\AuthorizationInterface  */
    private $authorization;
    const ADMIN_RESOURCE = '';

    /**
     * Massection constructor.
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
        $original = $config;
        $isAuth = $this->authorization->isAllowed(static::ADMIN_RESOURCE);
        if (!$isAuth) {
            $this->setData('config', '');
            return;
        }
        foreach ($this->getChildComponents() as $item) {
            switch ($item->getName()) {
                case 'delete':
                    if ($isAuth) {
                        $config['actions'][] = $item->getConfiguration();
                    }
                    break;
                    /*for example*/
                case 'run':
                    if ($isAuth) {
                        $config['actions'][] = $item->getConfiguration();
                    }
                    break;
            }
        }
        if ($config !== $original) {
            $config = array_replace_recursive($config, $original);
        }
        $this->setData('config', $config);
        $this->components = [];
    }
}

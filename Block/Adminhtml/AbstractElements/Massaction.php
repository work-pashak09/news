<?php

namespace Neklo\News\Block\Adminhtml\AbstractElements;

class Massaction extends \Magento\Ui\Component\MassAction
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
        $config = [];
        $canShow = false;
        $original = $this->getConfiguration();
        foreach ($this->getChildComponents() as $component) {
            if (!empty(array_filter($component->getConfiguration()))) {
                $canShow = true;
                $config[] = $component->getConfiguration();
                $showComponents[] = $component;
            }
        }
        if ($canShow) {
            $this->components = $showComponents;
            $config = array_replace_recursive($original, $config);
            $this->setData('config', $config);
        } else {
            $this->setData('config', '');
            $this->components = [];
        }
        parent::prepare();
    }
}

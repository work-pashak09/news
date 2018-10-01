<?php

namespace Neklo\News\Block;

use Magento\Framework\View\Element\Template;

class Link extends \Magento\Framework\View\Element\Html\Link
{
    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $config;

    public function __construct(
        \Neklo\News\Helper\Config $config,
        Template\Context $context,
        array $data = []
    ) {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    public function _toHtml()
    {
        $typeLink = $this->getData('type_link');
        $config = $this->config->getDataLink($typeLink);
        if ($config['is_active']) {
            $this->setAttribute('label', $config['name']);
            if ($typeLink == 'footer_link') {
                $this->setAttribute('path', $this->config->getNameUrlLinkArticle());
            }
            return parent:: _toHtml();
        }
    }
}

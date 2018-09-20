<?php


namespace Neklo\News\Block\Links;

use Magento\Framework\View\Element\Template;

class BaseLink extends \Magento\Framework\View\Element\Html\Link
{
    private $config;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        Template\Context $context,
        array $data = []
    ) {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    public function _toHtml()
    {
        $configPuth = $this->getData('config_path');

        $isShow = $this->config->getValue("{$configPuth}/is_activ", \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($isShow) {
            $this->setAttribute(
                'label',
                $this->config->getValue("{$configPuth}/title_url")
            );

            if ($configPuth == 'links/links_control_footer_link') {
                $this->setAttribute(
                    'path',
                    $this->config->getValue("url/url_filds/def_url")
                );
            }
            return parent:: _toHtml();
        }
        return '';
    }
}

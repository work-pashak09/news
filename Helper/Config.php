<?php

namespace Neklo\News\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const IS_ENABLED = 'news/news/is_enabled';
    const NAME_TABLE = 'news/news/name_table';
    const BASE_URL = 'url/url_filds/def_url';
    const PRIFIX_URL = 'url/url_filds/pref_url';
    const IS_SHOW_HEADER_LINKS = 'links/linksShow/header';
    const IS_SHOW_FOOTER_LINKS = 'links/linksShow/footer';
    const MENU_IN_NAVIGATION = 'links/links_control_navigation/';

    public function getIsEnabled()
    {
        return $this->isFlag(self::IS_ENABLED);
    }

    public function getPrifixUrl()
    {
        return $this->getValue(self::PRIFIX_URL);
    }

    public function getNameUrlInMavigation()
    {
        return $this->getValue(self::MENU_IN_NAVIGATION.'title_url');
    }

    public function isActivUrlInMavigation()
    {
        return $this->getValue(self::MENU_IN_NAVIGATION.'is_activ');
    }

    public function getNameTable()
    {
        return $this->getValue(self::NAME_TABLE);
    }

    public function getUrlNews()
    {
        return $this->getValue(self::BASE_URL);
    }

    private function getValue($puthFild)
    {
        return $this->scopeConfig->getValue(
            $puthFild,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    private function isFlag($puthFild)
    {
        return $this->scopeConfig->isSetFlag(
            $puthFild,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

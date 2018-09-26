<?php

namespace Neklo\News\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const IS_ENABLED = 'news/article_link/is_enabled';
    const NAME_TABLE = 'news/article_link/name_table_all_news';
    const BASE_URL = 'news/settings_list_article/default_link_news';
    const PRIFIX_URL = 'news/settings_list_article/pref_url';
    const IS_SHOW_HEADER_LINKS = 'news/contol_links_header/header';
    const IS_SHOW_FOOTER_LINKS = 'news/links_control_footer_link/footer';
    const MENU_IN_NAVIGATION = 'news/links_control_navigation/';

    public function isEnabledLinkOnNews()
    {
        return $this->isFlag(self::IS_ENABLED);
    }

    public function getPrifixUrl()
    {
        return $this->getValue(self::PRIFIX_URL);
    }

    public function getNameUrlInNavigation()
    {
        return $this->getValue(self::MENU_IN_NAVIGATION . 'title_url');
    }

    public function isShowUrlInNavigation()
    {
        return $this->getValue(self::MENU_IN_NAVIGATION . 'is_active');
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

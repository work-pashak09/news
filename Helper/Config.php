<?php

namespace Neklo\News\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const IS_ENABLED = 'neklo/news/settings_article_page/is_enabled';
    const NAME_TABLE = 'neklo/news/settings_article_page/name_table_all_news';
    const BASE_URL = 'neklo/news/settings_article_page/default_link_article';
    const PRIFIX_URL = 'neklo/news/settings_article_page/pref_url';
    const IS_SHOW_HEADER_LINKS = 'neklo/news/header_link/header';
    const IS_SHOW_FOOTER_LINKS = 'neklo/news/footer_link/footer';
    const TITLE_URL_MENU_NAVIGATION = 'neklo/news/links_control_navigation/title_url';
    const IS_ACTIVE_URL_MENU_NAVIGATION = 'neklo/news/links_control_navigation/is_active';

    public function isEnabledLinkOnNews()
    {
        return $this->isFlag(self::IS_ENABLED);
    }

    public function getPrefixUrlActicle()
    {
        return $this->getValue(self::PRIFIX_URL);
    }

    public function getNameNavigationUrl()
    {
        return $this->getValue(self::TITLE_URL_MENU_NAVIGATION);
    }

    public function isShowUrlInNavigation()
    {
        return $this->getValue(self::IS_ACTIVE_URL_MENU_NAVIGATION);
    }

    public function getNameTable()
    {
        return $this->getValue(self::NAME_TABLE);
    }

    public function getNameUrlLinkArticle()
    {
        return $this->getValue(self::BASE_URL);
    }

    /**
     * @return  array
     */
    public function getDataLink($typeLink)
    {
        $configLink['name'] = $this->getValue("neklo/news/$typeLink/title_url");
        $configLink['is_active'] = $this->getValue("neklo/news/$typeLink/is_active");
        return $configLink;
    }

    private function getValue($putchToConfig)
    {
        return $this->scopeConfig->getValue(
            $putchToConfig,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    private function isFlag($putchToConfig)
    {
        return $this->scopeConfig->isSetFlag(
            $putchToConfig,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

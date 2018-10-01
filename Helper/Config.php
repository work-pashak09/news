<?php

namespace Neklo\News\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const IS_ENABLED = 'neklo/news/settings_article_page/is_enabled';
    const NAME_TABLE = 'neklo/news/settings_article_page/name_table_all_news';
    const BASE_URL = 'neklo/news/settings_article_page/default_link_article';
    const PRIFIX_URL = 'neklo/news/settings_article_page/prefix_url';
    const IS_SHOW_HEADER_LINKS = 'neklo/news/header_link/header';
    const IS_SHOW_FOOTER_LINKS = 'neklo/news/footer_link/footer';
    const TITLE_URL_MENU_NAVIGATION = 'neklo/news/links_control_navigation/title_url';
    const IS_ACTIVE_URL_MENU_NAVIGATION = 'neklo/news/links_control_navigation/is_active';

    /**
     * @return boolean
     */
    public function isEnabledLinkOnNews()
    {
        return $this->isFlag(self::IS_ENABLED);
    }

    /**
     * @return string
     */
    public function getPrefixUrlActicle()
    {
        return $this->getValue(self::PRIFIX_URL);
    }

    /**
     * @return string
     */
    public function getNameNavigationUrl()
    {
        return $this->getValue(self::TITLE_URL_MENU_NAVIGATION);
    }

    /**
     * @return boolean
     */
    public function isShowUrlInNavigation()
    {
        return $this->getValue(self::IS_ACTIVE_URL_MENU_NAVIGATION);
    }

    /**
     * @return string
     */
    public function getNameTable()
    {
        return $this->getValue(self::NAME_TABLE);
    }

    /**
     * @return string
     */
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

    /**
     * @return array
     */
    private function getValue($patchToConfig)
    {
        return $this->scopeConfig->getValue(
            $patchToConfig,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    private function isFlag($patchToConfig)
    {
        return $this->scopeConfig->isSetFlag(
            $patchToConfig,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}

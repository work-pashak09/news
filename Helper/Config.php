<?php

namespace Neklo\News\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const IS_ENABLED = 'news/news/is_enabled';

    const NAME_TABLE = 'news/news/name_table';

    const BASE_URL = 'url/url_filds/def_url';

    const PRIFIX_URL = 'url/url_filds/pref_url';


    public function getIsEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::IS_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getPrifixUrl()
    {
        return $this->scopeConfig->getValue(
            self::PRIFIX_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getNameTable(){
        return $this->scopeConfig->getValue(
            self::NAME_TABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    public function getUrlNews(){
        return $this->scopeConfig->getValue(
            self::BASE_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
 }

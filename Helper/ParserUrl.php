<?php

namespace Neklo\News\Helper;

class ParserUrl
{
    /** @var \Magento\Framework\App\RequestInterface  */
    private $request;

    /**
     * ParserUrl constructor.
     * @param \Magento\Framework\App\RequestInterface $request
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function parse()
    {
        $partUrl = explode('/', trim($this->request->getPathInfo(), '/'));
        $infoPatch = [];
        switch (count($partUrl)) {
            case 1:
                $infoPatch = ['linkList' => $partUrl[0]];
                break;
            case 2:
                $infoPatch = ['linkList' => $partUrl[0], 'nameCategory' => $partUrl[1]];
                break;
            case 3:
                $infoPatch = [
                    'linkList' => $partUrl[0],
                    'urlArticle' => $partUrl[2],
                    'nameCategory' => $partUrl[1]
                ];
                break;
        }
        return $infoPatch;
    }
}

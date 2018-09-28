<?php

namespace Neklo\News\Helper;

class ParserUrl
{
    private $request;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->request = $request;
    }

    public function parse()
    {
       $partUrl = explode('/', trim($this->request->getPathInfo(), '/'));
        $arr =[];
        switch (count($partUrl)) {
            case 1:
                    $arr = ['linkList' => $partUrl[0]];
                    break;
            case 2:
                $arr = ['linkList' => $partUrl[0], 'nameCategory' => $partUrl[1]];
                break;
            case 3:
                $arr = [
                    'linkList' => $partUrl[0],
                    'urlArticle' => $partUrl[2],
                    'nameCategory' => $partUrl[1]
                ];
                break;

        }
        return $arr;
    }
}

<?php

namespace Sandbox\Resource\Page\Demo\Resource\Http;

use BEAR\Resource\AbstractObject as Page;
use BEAR\Sunday\Inject\ResourceInject;

class Index extends Page
{
    use ResourceInject;

    public $body = [
        'news' => ''
    ];

    /**
     * @param $now
     *
     * @return $this
     */
    public function onGet($now)
    {
        $xml = $this->resource
            ->get
            ->uri('http://www.feedforall.com/sample.xml')
            ->eager
            ->request()
            ->body;

        /** @var $xml \SimpleXMLElement */
        $this['xml'] = print_r($xml, true);

        return $this;
    }
}

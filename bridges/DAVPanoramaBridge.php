<?php

declare(strict_types=1);

class DAVPanoramaBridge extends BridgeAbstract
{
    const NAME = 'DAV Panorama';
    const URI = 'https://www.alpenverein.de/panorama/';
    const DESCRIPTION = 'Magazine of the German Alpine Club (Deutscher Alpenverein, DAV) called Panorama.';
    const MAINTAINER = 'ServiusHack';

    public function collectData()
    {
        $dom = getSimpleHTMLDOM('https://www.alpenverein.de/panorama/');
        foreach ($dom->find('.editions-list article') as $li) {
            $a = $li->find('a', 0);
            $h2 = $a->find('h2', 0);
            $this->items[] = [
                'uid' => $li->id,
                'title' => $h2->plaintext,
                'uri' => 'https://www.alpenverein.de' . $a->href,
                'enclosures' => [
                    'https://www.alpenverein.de' . $a->find('img', 0)->src
                ]
            ];
        }
    }
}

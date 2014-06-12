<?php

/**
 * This file is part of the DigitalOceanV2 library.
 *
 * (c) Antoine Corcy <contact@sbin.dk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DigitalOceanV2\Adapter;

use Buzz\Browser;
use Buzz\Client\Curl;

/**
 * @author Antoine Corcy <contact@sbin.dk>
 */
class BuzzAdapter implements AdapterInterface
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * {@inheritdoc}
     */
    public function __construct($accessToken)
    {
        $this->browser = new Browser(new Curl);
        $this->browser->addListener(new BuzzOAuthListener($accessToken));
    }

    /**
     * {@inheritdoc}
     */
    public function get($url)
    {
        $response = $this->browser->get($url);

        if (!$response->isSuccessful()) {
            throw new \RuntimeException('Request not processed.');
        }

        return $response->getContent();
    }
}
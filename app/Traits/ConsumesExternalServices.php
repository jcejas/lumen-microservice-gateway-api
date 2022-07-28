<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    /**
     * Send Request
     *
     * @param string $method
     * @param string $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return void
     */
    public function performRequest(string $method, string $requestUrl, array $formParams = [], array $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }
}
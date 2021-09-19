<?php

namespace WebCrea\YandexMetrikaSdk\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use WebCrea\YandexMetrikaSdk\Exceptions\YandexMetrikaException;

abstract class BaseApi
{
    protected $url = 'https://api-metrika.yandex.net';

    public function __construct($token, $counterId = null, $proxy = null)
    {
        $this->token = $token;
        $this->proxy = $proxy;
        $this->counterId = $counterId;
    }

    protected function query($type, $method, $params = [], $data = [])
    {
        try {
            $client = new Client($this->getHttpClientConfig($params, $data));
            $response = $client->request($type, $this->url . $method);
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new YandexMetrikaException($e->getMessage());
        }
    }

    private function getHttpClientConfig($params, $data): array
    {
        // Headers
        $config[RequestOptions::HEADERS] = [
            "Authorization" => "OAuth $this->token",
        ];

        // Get params
        if (!empty($params)) {
            $config[RequestOptions::QUERY] = $params;
        }

        // Body
        if ($data['JSON']) {
            $config[RequestOptions::HEADERS]["Content-Type"] = "Content-Type: application/json";
            $config[RequestOptions::JSON] = $data['JSON'];
        } elseif ($data['FILE']) {
            $config[RequestOptions::HEADERS]["Content-Type"] = "Content-Type: multipart/form-data";
            $config[RequestOptions::MULTIPART] = [
                'name' => $data['FILE'],
                'contents' => file_get_contents($data['FILE']),
                'filename' => $data['FILE'],
            ];
        }

        // Proxy
        if (!empty($this->proxy)) {
            $config[RequestOptions::PROXY] = $this->proxy;
        }

        return $config;
    }

    protected function getCounterUrl(): string
    {
        return "/counter/$this->counterId";
    }
}

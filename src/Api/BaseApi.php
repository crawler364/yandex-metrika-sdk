<?php

namespace WebCrea\YandexMetrikaSdk\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use WebCrea\YandexMetrikaSdk\Exceptions\YandexMetrikaException;


abstract class BaseApi
{
    protected $apiUrl = 'https://api-metrika.yandex.net';
    protected $apiDir;
    protected $apiVer;

    /** @var string */
    private $token;
    /** @var mixed|null */
    private $proxy;

    public function __construct(string $token, $proxy = null)
    {
        $this->token = $token;
        $this->proxy = $proxy;
    }

    /**
     * @param $counterId
     *
     * @return string
     */
    protected function getCounterUrn($counterId): string
    {
        return "/counter/$counterId";
    }

    /**
     * @param string $type
     * @param string $requestUri
     * @param array  $requestParams
     * @param array  $requestBody
     *
     * @return array
     * @throws YandexMetrikaException
     */
    protected function query(string $type, string $requestUri, array $requestParams = [], array $requestBody = []): array
    {
        try {
            $client = new Client($this->getHttpClientConfig($requestParams, $requestBody));
            $response = $client->request($type, $requestUri);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new YandexMetrikaException($e->getMessage());
        }
    }

    /**
     * @param $content
     * @param $type
     *
     * @return array
     */
    protected function getRequestBody($content, $type): array
    {
        return [
            'CONTENT' => $content,
            'TYPE' => $type,
        ];
    }

    /**
     * @param $method
     *
     * @return string
     */
    protected function getRequestUri($method): string
    {
        return $this->apiUrl . $this->apiDir . $this->apiVer . $method;
    }

    /**
     * @param $requestParams
     * @param $requestBody
     *
     * @return array
     */
    private function getHttpClientConfig($requestParams, $requestBody): array
    {
        switch ($requestBody['TYPE']) {
            case 'JSON':
                $config[RequestOptions::HEADERS]["Content-Type"] = "Content-Type: application/json";
                $config[RequestOptions::JSON] = $requestBody['CONTENT'];
                break;
            case 'FILE':
                $config[RequestOptions::HEADERS]["Content-Type"] = "Content-Type: multipart/form-data";
                $config[RequestOptions::MULTIPART] = [
                    [
                        'name' => $requestBody['CONTENT'],
                        'contents' => file_get_contents($requestBody['CONTENT']),
                        'filename' => $requestBody['CONTENT'],
                    ],
                ];
                break;
        }

        $config[RequestOptions::HEADERS] = [
            "Authorization" => "OAuth $this->token",
        ];

        if (!empty($this->proxy)) {
            $config[RequestOptions::PROXY] = $this->proxy;
        }

        if (!empty($requestParams)) {
            $config[RequestOptions::QUERY] = $requestParams;
        }

        return $config;
    }
}

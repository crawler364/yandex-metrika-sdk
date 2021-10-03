<?php

namespace WebCrea\YandexMetrikaSdk\Api;

use \WebCrea\YandexMetrikaSdk\Exceptions\YandexMetrikaException;

/**
 * @see https://yandex.ru/dev/metrika/doc/api2/practice/crm/contacts.html
 */
class CdpApi extends BaseApi
{
    protected $apiDir = '/cdp/api';
    protected $apiVer = '/v1';

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/createattributes.html
     *
     * @param int   $counterId
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function createAttributes(int $counterId, array $content, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/attributes');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/createproducts.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function createProducts(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/products');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getattributes.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getAttributes(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/attributes');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/uploadings/getlastuploadings.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getLastUploadings(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/last_uploadings');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getpredefinedtypes.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getPredefinedTypes(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/predefined_types');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/gettypes.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getTypes(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/types');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/maporderstatuses.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function mapOrderStatuses(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/order_statuses');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadcontactjson.html
     *
     * @param int   $counterId
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadContactsJson(int $counterId, array $content, array $requestParams): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/data/contacts');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadcontacts.html
     */
    public function uploadContacts()
    {
        // todo
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadorders.html
     */
    public function uploadOrders()
    {
        // todo
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadordersjson.html
     *
     * @param int   $counterId
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadOrdersJson(int $counterId, array $content, array $requestParams): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/data/orders');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }
}

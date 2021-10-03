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
     * @param null  $entitySubtype
     * @param null  $entityType
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function createAttributes(int $counterId, array $content, $entitySubtype = null, $entityType = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/attributes');
        $requestParams = [
            'entity_subtype' => $entitySubtype,
            'entity_type' => $entityType,
        ];
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
     * @param int  $counterId
     * @param null $entitySubtype
     * @param null $entityType
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getAttributes(int $counterId, $entitySubtype = null, $entityType = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/schema/attributes');
        $requestParams = [
            'entity_subtype' => $entitySubtype,
            'entity_type' => $entityType,
        ];

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/uploadings/getlastuploadings.html
     *
     * @param int  $counterId
     * @param null $limit
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getLastUploadings(int $counterId, $limit = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/last_uploadings');
        $requestParams = ['limit' => $limit];

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
     * @param int    $counterId
     * @param array  $content
     * @param string $mergeMode
     *
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function uploadContactsJson(int $counterId, array $content, string $mergeMode)
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/data/contacts');
        $requestParams = ['merge_mode' => $mergeMode];
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
     * @param int    $counterId
     * @param array  $content
     * @param string $mergeMode
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadOrdersJson(int $counterId, array $content, string $mergeMode): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/data/orders');
        $requestParams = ['merge_mode' => $mergeMode];
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }
}

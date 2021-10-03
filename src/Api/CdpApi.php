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
     * @param array $content
     * @param null  $entitySubtype
     * @param null  $entityType
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function createAttributes(array $content, $entitySubtype = null, $entityType = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/attributes');
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
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function createProducts(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/products');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getattributes.html
     *
     * @param null $entitySubtype
     * @param null $entityType
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getAttributes($entitySubtype = null, $entityType = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/attributes');
        $requestParams = [
            'entity_subtype' => $entitySubtype,
            'entity_type' => $entityType,
        ];

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/uploadings/getlastuploadings.html
     *
     * @param null $limit
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getLastUploadings($limit = null): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/last_uploadings');
        $requestParams = ['limit' => $limit];

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getpredefinedtypes.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getPredefinedTypes(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/predefined_types');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/gettypes.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getTypes(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/types');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/maporderstatuses.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function mapOrderStatuses(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/schema/order_statuses');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadcontactjson.html
     *
     * @param array  $content
     * @param string $mergeMode
     *
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function uploadContactsJson(array $content, string $mergeMode)
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/data/contacts');
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
     * @param array  $content
     * @param string $mergeMode
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadOrdersJson(array $content, string $mergeMode): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/data/orders');
        $requestParams = ['merge_mode' => $mergeMode];
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @deprecated
     *
     * @param string $mergeMode
     * @param array  $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadContactJson(array $content, string $mergeMode): array
    {
        return $this->uploadContactsJson($content, $mergeMode);
    }
}

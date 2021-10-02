<?php

namespace WebCrea\YandexMetrikaSdk\Api;

use \WebCrea\YandexMetrikaSdk\Exceptions\YandexMetrikaException;

/**
 * @see https://yandex.ru/dev/metrika/doc/api2/practice/crm/contacts.html
 */
class CdpApi extends BaseApi
{
    protected $apiUrl = '/cdp/api/v1';

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/createattributes.html
     * @param array $data
     * @param null $entitySubtype
     * @param null $entityType
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function createAttributes(array $data, $entitySubtype = null, $entityType = null)
    {
        $method = '/schema/attributes';
        $params = [
            'entity_subtype' => $entitySubtype,
            'entity_type' => $entityType,
        ];
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, $params, $data);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/createproducts.html
     * @param array $data
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function createProducts(array $data)
    {
        $method = '/schema/products';
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, null, $data);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getattributes.html
     * @param null $entitySubtype
     * @param null $entityType
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function getAttributes($entitySubtype = null, $entityType = null)
    {
        $method = '/schema/attributes';
        $params = [
            'entity_subtype' => $entitySubtype,
            'entity_type' => $entityType,
        ];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl, $params);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/uploadings/getlastuploadings.html
     * @param null $limit
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function getLastUploadings($limit = null)
    {
        $method = '/last_uploadings';
        $params = ['limit' => $limit];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl, $params);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/getpredefinedtypes.html
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function getPredefinedTypes()
    {
        $method = '/schema/predefined_types';
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/gettypes.html
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function getTypes()
    {
        $method = '/schema/types';
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/schema/maporderstatuses.html
     * @param array $data
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function mapOrderStatuses(array $data)
    {
        $method = '/schema/order_statuses';
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, null, $data);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadcontactjson.html
     * @param array $data
     * @param string $mergeMode
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function uploadContactsJson(array $data, string $mergeMode)
    {
        $method = '/data/contacts';
        $params = ['merge_mode' => $mergeMode];
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, $params, $data);
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
     * @param array $data
     * @param string $mergeMode
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function uploadOrdersJson(array $data, string $mergeMode)
    {
        $method = '/data/orders';
        $params = ['merge_mode' => $mergeMode];
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, $params, $data);
    }

    /**
     * @deprecated
     * @param array $data
     * @param string $mergeMode
     * @return mixed
     * @throws YandexMetrikaException
     */
    public function uploadContactJson(array $data, string $mergeMode){
        return $this->uploadContactsJson($data, $mergeMode);
    }
}

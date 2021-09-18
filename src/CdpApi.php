<?php

namespace WC\YandexMetrika;

class CdpApi extends BaseApi
{
    protected $apiUrl = '/cdp/api/v1';

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/crm/data/uploadordersjson.html
     *
     * @param array $data
     * @param string $mergeMode
     * @return mixed
     * @throws \WC\YandexMetrika\YandexMetrikaException
     */
    public function uploadOrdersJson(array $data, string $mergeMode)
    {
        $method = '/data/orders';
        $params = ['merge_mode' => $mergeMode];
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, $params, $data);
    }

    public function uploadContactJson(array $data, string $mergeMode)
    {
        $method = '/data/contacts';
        $params = ['merge_mode' => $mergeMode];
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, $params, $data);
    }

    public function getLastUploading($limit = null)
    {
        $method = '/last_uploadings';
        $params = ['limit' => $limit];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl, $params);
    }

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

    public function createProducts(array $data)
    {
        $method = '/schema/products';
        $data = ['JSON' => $data];
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('POST', $methodUrl, null, $data);
    }

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

    public function getPredefinedTypes()
    {
        $method = '/schema/predefined_types';
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl);
    }

    public function getTypes()
    {
        $method = '/schema/types';
        $methodUrl = $this->apiUrl . $this->getCounterUrl() . $method;

        return $this->query('GET', $methodUrl);
    }
}

<?php

//todo стоит ли счетчик передавать в методы тк не везде используется?


namespace WebCrea\YandexMetrikaSdk\Api;

use WebCrea\YandexMetrikaSdk\Exceptions\YandexMetrikaException;

/**
 * @see https://yandex.ru/dev/metrika/doc/api2/management/intro.html
 */
class ManagementApi extends BaseApi
{
    protected $apiDir = '/management';
    protected $apiVer = '/v1';

    //region Tag management \ Управление счетчиками

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/counters.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function counters(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/counters');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/counter.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function counter(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn());

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/addcounter.html
     *
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addCounter(array $content, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/counters');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/editcounter.html
     *
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editCounter(array $content, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn());
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/deletecounter.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteCounter(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn());

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/undeletecounter.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function undeleteCounter(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/undelete');

        return $this->query('POST', $requestUri);
    }
    //endregion

    //region Goal management \ Управление целями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/goals.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function goals(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/goals');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/goal.html
     *
     * @param int   $goalId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function goal(int $goalId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/goal/$goalId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/addgoal.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addGoal(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/goals');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/editgoal.html
     *
     * @param int   $goalId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editGoal(int $goalId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/goal/$goalId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/deletegoal.html
     *
     * @param int $goalId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteGoal(int $goalId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/goal/$goalId");

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/getmessengers.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getMessengers(): array
    {
        $requestUri = $this->getRequestUri('/messengers');

        return $this->query('GET', $requestUri);
    }

    //endregion

    //region List of filters \ Список фильтров
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/filters.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function filters(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/filters');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/filter.html
     *
     * @param int   $filterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function filter(int $filterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/filter/$filterId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/addfilter.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addFilter(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/filters');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/editfilter.html
     *
     * @param int   $filterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editFilter(int $filterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/filter/$filterId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/deletefilter.html
     *
     * @param int $filterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteFilter(int $filterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/filter/$filterId");

        return $this->query('DELETE', $requestUri);
    }
    //endregion
}

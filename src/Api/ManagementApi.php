<?php

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
    public function getCounters(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/counters');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/counter.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCounter(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId));

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
     * @param int   $counterId
     * @param array $content
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editCounter(int $counterId, array $content, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId));
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/deletecounter.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteCounter(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId));

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/counters/undeletecounter.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function undeleteCounter(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/undelete');

        return $this->query('POST', $requestUri);
    }
    //endregion

    //region Goal management \ Управление целями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/goals.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getGoals(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/goals');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/goal.html
     *
     * @param int   $counterId
     * @param int   $goalId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getGoal(int $counterId, int $goalId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/goal/$goalId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/addgoal.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addGoal(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/goals');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/editgoal.html
     *
     * @param int   $counterId
     * @param int   $goalId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editGoal(int $counterId, int $goalId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/goal/$goalId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/goals/deletegoal.html
     *
     * @param int $counterId
     * @param int $goalId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteGoal(int $counterId, int $goalId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/goal/$goalId");

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
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getFilters(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/filters');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/filter.html
     *
     * @param int   $counterId
     * @param int   $filterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getFilter(int $counterId, int $filterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/filter/$filterId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/addfilter.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addFilter(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/filters');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/editfilter.html
     *
     * @param int   $counterId
     * @param int   $filterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editFilter(int $counterId, int $filterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/filter/$filterId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/filters/deletefilter.html
     *
     * @param int $counterId
     * @param int $filterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteFilter(int $counterId, int $filterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/filter/$filterId");

        return $this->query('DELETE', $requestUri);
    }
    //endregion

    //region Actions management \ Управление операциями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/operations.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOperations(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/operations');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/operation.html
     *
     * @param int   $counterId
     * @param int   $operationId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOperation(int $counterId, int $operationId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/operation/$operationId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/addoperation.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addOperation(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/operations');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/editoperation.html
     *
     * @param int   $counterId
     * @param int   $operationId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editOperation(int $counterId, int $operationId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/operation/$operationId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/deleteoperation.html
     *
     * @param int $counterId
     * @param int $operationId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteOperation(int $counterId, int $operationId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/operation/$operationId");

        return $this->query('DELETE', $requestUri);
    }
    //endregion

    //region Permissions management \ Управление доступами
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/grants.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getGrants(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/grants');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/grant.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getGrant(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/grant');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/public-grants/addgrant.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addPublicGrant(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/public_grant');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/public-grants/deletegrant.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deletePublicGrant(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/public_grant');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/addgrant.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addGrant(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/grants');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/editgrant.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editGrant(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/grant');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/deletegrant.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteGrant(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/grant');

        return $this->query('DELETE', $requestUri, $requestParams);
    }
    //endregion


    //region Accounts management \ Управление аккаунтами
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/accounts/accounts.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getAccounts(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/accounts');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/accounts/deleteaccount.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteAccount(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/account');

        return $this->query('DELETE', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/accounts/updateaccounts.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editAccounts(array $content): array
    {
        $requestUri = $this->getRequestUri('/accounts');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }
    //endregion

    //region Representatives management \ Управление представителями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/delegates/delegates.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getDelegates(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/delegates');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/delegates/adddelegate.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addDelegate(array $content): array
    {
        $requestUri = $this->getRequestUri('/delegates');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/delegates/deletedelegate.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteDelegate(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/delegate');

        return $this->query('DELETE', $requestUri, $requestParams);
    }
    //endregion

    //region Management of Yandex.Direct clients \ Управление клиентами Директа
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/direct_clients/getclients.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getClients(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri('/clients');

        return $this->query('GET', $requestUri, $requestParams);
    }
    //endregion

    //region Label management \ Управление метками
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/labels/getlabels.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getLabels(): array
    {
        $requestUri = $this->getRequestUri('/labels');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/labels/getlabel.html
     *
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getLabel(int $labelId): array
    {
        $requestUri = $this->getRequestUri("/label/$labelId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/labels/createlabel.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addLabel(array $content): array
    {
        $requestUri = $this->getRequestUri('/labels');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/labels/updatelabel.html
     *
     * @param int   $labelId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editLabel(int $labelId, array $content): array
    {
        $requestUri = $this->getRequestUri("/label/$labelId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/labels/deletelabel.html
     *
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteLabel(int $labelId): array
    {
        $requestUri = $this->getRequestUri("/label/$labelId");

        return $this->query('DELETE', $requestUri);
    }

    //endregion

    //region Linking tags to tag labels \ Привязка счетчиков к меткам
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/links/setcounterlabel.html
     *
     * @param int $counterId
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function setCounterLabel(int $counterId, int $labelId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/label/$labelId");

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/links/unsetcounterlabel.html
     *
     * @param int $counterId
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function unsetCounterLabel(int $counterId, int $labelId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/label/$labelId");

        return $this->query('DELETE', $requestUri);
    }

    //endregion

    //region Segment management \ Управление сегментами
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/getsegmentsforcounter.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getSegments(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/apisegment/segments');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/createsegment.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addSegment(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/apisegment/segments');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/getsegment.html
     *
     * @param int $counterId
     * @param int $segmentId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getSegment(int $counterId, int $segmentId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/apisegment/segment/$segmentId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/updatesegment.html
     *
     * @param int   $counterId
     * @param int   $segmentId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editSegment(int $counterId, int $segmentId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/apisegment/segment/$segmentId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/deletesegment.html
     *
     * @param int $counterId
     * @param int $segmentId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteSegment(int $counterId, int $segmentId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/apisegment/segment/$segmentId");

        return $this->query('DELETE', $requestUri);
    }

    //endregion

    //region Comments on charts \ Примечания на графиках
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/findall.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getChartAnnotations(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/chart_annotations');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/get.html
     *
     * @param int $counterId
     * @param int $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getChartAnnotation(int $counterId, int $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/chart_annotation/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/create.html
     *
     * @param int   $counterId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addChartAnnotation(int $counterId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/chart_annotations');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/update.html
     *
     * @param int   $counterId
     * @param int   $id
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editChartAnnotation(int $counterId, int $id, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/chart_annotation/$id");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/delete.html
     *
     * @param int $counterId
     * @param int $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteChartAnnotation(int $counterId, int $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/chart_annotation/$id");

        return $this->query('DELETE', $requestUri);
    }
    //endregion

    //region Managing data uploads \ Список загрузок параметров
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/findall.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getUserParamsUploadings(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/user_params/uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/findbyid.html
     *
     * @param int    $counterId
     * @param string $uploadingId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getUserParamsUploading(int $counterId, string $uploadingId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/user_params/uploading/$uploadingId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/confirm.html
     *
     * @param int    $counterId
     * @param string $uploadingId
     * @param array  $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function confirmUserParamsUploading(int $counterId, string $uploadingId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/user_params/uploading/$uploadingId/confirm");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/upload.html
     *
     * @param int    $counterId
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadUserParams(int $counterId, array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/user_params/uploadings/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/update.html
     *
     * @param int    $counterId
     * @param string $uploadingId
     * @param array  $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editUserParamsUploading(int $counterId, string $uploadingId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/user_params/uploading/$uploadingId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }
    //endregion

    //region Managing offline data \ Управление офлайн-конверсиями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findall.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOfflineConversionsUploadings(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findbyid.html
     *
     * @param int    $counterId
     * @param string $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOfflineConversionsUploading(int $counterId, string $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/offline_conversions/uploading/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/upload.html
     *
     * @param int    $counterId
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadOfflineConversions(int $counterId, array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/enableextendedthreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function enableExtendedThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/extended_threshold');

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/disableextendedthreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function disableExtendedThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/extended_threshold');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/getvisitjointhreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getVisitJoinThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/visit_join_threshold');

        return $this->query('GET', $requestUri);
    }
    //endregion

    //region Managing offline data \ Управление звонками
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findallcalluploadings.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsUploadings(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/calls_uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findcalluploadingbyid.html
     *
     * @param int    $counterId
     * @param string $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsUploading(int $counterId, string $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/offline_conversions/calls_uploading/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/uploadcalls.html
     *
     * @param int    $counterId
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadCalls(int $counterId, array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/upload_calls');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/enablecallsextendedthreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function enableCallsExtendedThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/calls_extended_threshold');

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/disablecallsextendedthreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function disableCallsExtendedThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/calls_extended_threshold');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/getcallsvisitjointhreshold.html
     *
     * @param int $counterId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsExtendedThreshold(int $counterId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/offline_conversions/calls_visit_join_threshold');

        return $this->query('GET', $requestUri);
    }
    //endregion

    //region Manage ad spending downloads \ Управление загрузками расходов на рекламу
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/findall.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getExpenseUploadings(int $counterId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/expense/uploadings');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/findbyid.html
     *
     * @param int    $counterId
     * @param string $uploadingId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getExpenseUploading(int $counterId, string $uploadingId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . "/expense/uploading/$uploadingId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadbody.html
     *
     * @param int    $counterId
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadExpense(int $counterId, array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/expense/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadremovesingleline.html
     *
     * @param int   $counterId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteSingleExpense(int $counterId, array $requestParams): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/expense/delete_single');

        return $this->query('POST', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadremovemultipart.html
     *
     * @param int    $counterId
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteExpense(int $counterId, array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn($counterId) . '/expense/delete');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }
    //endregion
}

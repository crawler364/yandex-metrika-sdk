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

    //region Actions management \ Управление операциями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/operations.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function operations(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/operations');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/operation.html
     *
     * @param int   $operationId
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function operation(int $operationId, array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/operation/$operationId");

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/addoperation.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addOperation(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/operations');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/editoperation.html
     *
     * @param int   $operationId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editOperation(int $operationId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/operation/$operationId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/operations/deleteoperation.html
     *
     * @param int $operationId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteOperation(int $operationId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/operation/$operationId");

        return $this->query('DELETE', $requestUri);
    }
    //endregion

    //region Permissions management \ Управление доступами
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/grants.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function grants(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/grants');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/grant.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function grant(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/grant');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/public-grants/addgrant.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addPublicGrant(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/public_grant');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/public-grants/deletegrant.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function deletePublicGrant(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/public_grant');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/addgrant.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addGrant(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/grants');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/editgrant.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editGrant(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/grant');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/grants/deletegrant.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteGrant(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/grant');

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
    public function accounts(array $requestParams = []): array
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
    public function delegates(array $requestParams = []): array
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
    public function clients(array $requestParams = []): array
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
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function setCounterLabel(int $labelId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/label/$labelId");

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/links/unsetcounterlabel.html
     *
     * @param int $labelId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function unsetCounterLabel(int $labelId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/label/$labelId");

        return $this->query('DELETE', $requestUri);
    }

    //endregion

    //region Segment management \ Управление сегментами
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/getsegmentsforcounter.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getSegments(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/apisegment/segments');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/createsegment.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addSegment(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/apisegment/segments');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/getsegment.html
     *
     * @param int $segmentId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getSegment(int $segmentId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/apisegment/segment/$segmentId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/updatesegment.html
     *
     * @param int   $segmentId
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editSegment(int $segmentId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/apisegment/segment/$segmentId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/segments/deletesegment.html
     *
     * @param int $segmentId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteSegment(int $segmentId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/apisegment/segment/$segmentId");

        return $this->query('DELETE', $requestUri);
    }

    //endregion

    //region Comments on charts \ Примечания на графиках
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/findall.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getChartAnnotations(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/chart_annotations');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/get.html
     *
     * @param int $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getChartAnnotation(int $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/chart_annotation/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/create.html
     *
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function addChartAnnotation(array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/chart_annotations');
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/update.html
     *
     * @param int   $id
     * @param array $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editChartAnnotation(int $id, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/chart_annotation/$id");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/chart_annotation/delete.html
     *
     * @param int $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteChartAnnotation(int $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/chart_annotation/$id");

        return $this->query('DELETE', $requestUri);
    }
    //endregion

    //region Managing data uploads \ Список загрузок параметров
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/findall.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getUserParamsUploadings(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/user_params/uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/findbyid.html
     *
     * @param string $uploadingId
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getUserParamsUploading(string $uploadingId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/user_params/uploading/$uploadingId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/confirm.html
     *
     * @param string $uploadingId
     * @param array  $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function confirmUserParamsUploading(string $uploadingId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/user_params/uploading/$uploadingId/confirm");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('POST', $requestUri, [], $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/upload.html
     *
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadUserParams(array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/user_params/uploadings/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/userparams/update.html
     *
     * @param string $uploadingId
     * @param array  $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function editUserParamsUploading(string $uploadingId, array $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/user_params/uploading/$uploadingId");
        $requestBody = $this->getRequestBody($content, 'JSON');

        return $this->query('PUT', $requestUri, [], $requestBody);
    }
    //endregion

    //region Managing offline data \ Управление офлайн-конверсиями
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findall.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOfflineConversionsUploadings(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findbyid.html
     *
     * @param string $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getOfflineConversionsUploading(string $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/offline_conversions/uploading/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/upload.html
     *
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadOfflineConversions(array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/enableextendedthreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function enableExtendedThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/extended_threshold');

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/disableextendedthreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function disableExtendedThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/extended_threshold');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/getvisitjointhreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getVisitJoinThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/visit_join_threshold');

        return $this->query('GET', $requestUri);
    }
    //endregion

    //region Managing offline data \ Управление звонками
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findallcalluploadings.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsUploadings(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/calls_uploadings');

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/findcalluploadingbyid.html
     *
     * @param string $id
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsUploading(string $id): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/offline_conversions/calls_uploading/$id");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/uploadcalls.html
     *
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadCalls(array $requestParams, string $content): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/upload_calls');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/enablecallsextendedthreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function enableCallsExtendedThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/calls_extended_threshold');

        return $this->query('POST', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/disablecallsextendedthreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function disableCallsExtendedThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/calls_extended_threshold');

        return $this->query('DELETE', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/offline_conversion/getcallsvisitjointhreshold.html
     * @return array
     * @throws YandexMetrikaException
     */
    public function getCallsExtendedThreshold(): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/offline_conversions/calls_visit_join_threshold');

        return $this->query('GET', $requestUri);
    }
    //endregion

    //region Manage ad spending downloads \ Управление загрузками расходов на рекламу
    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/findall.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getExpenseUploadings(array $requestParams = []): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/expense/uploadings');

        return $this->query('GET', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/findbyid.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function getExpenseUploading(string $uploadingId): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . "/expense/uploading/$uploadingId");

        return $this->query('GET', $requestUri);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadbody.html
     *
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function uploadExpense(array $requestParams, string $content)
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/expense/upload');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadremovesingleline.html
     *
     * @param array $requestParams
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteSingleExpense(array $requestParams): array
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/expense/delete_single');

        return $this->query('POST', $requestUri, $requestParams);
    }

    /**
     * @see https://yandex.ru/dev/metrika/doc/api2/management/expenses/uploadremovemultipart.html
     *
     * @param array  $requestParams
     * @param string $content
     *
     * @return array
     * @throws YandexMetrikaException
     */
    public function deleteExpense(array $requestParams, string $content)
    {
        $requestUri = $this->getRequestUri($this->getCounterUrn() . '/expense/delete');
        $requestBody = $this->getRequestBody($content, 'FILE');

        return $this->query('POST', $requestUri, $requestParams, $requestBody);
    }
    //endregion

}

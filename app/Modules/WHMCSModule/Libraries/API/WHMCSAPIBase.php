<?php

namespace App\Modules\WHMCSModule\Libraries\API;


use App\Facades\AQLog;

/**
 * Class WHMCSAPIBase
 *
 * @package App\Modules\WHMCSModule\Libraries\API
 */
abstract class WHMCSAPIBase {
    protected $parameters = [];
    protected $reflection = null;
   /*
    *  @var \App\Modules\WHMCSModule\Libraries\API\WHMCSAPIRequest
    */
    protected $api;
    protected $requestMethod;
    protected $action;
    protected $payload;
    protected $response;
    protected $totalItems;
    protected $data;
    protected $fieldDetails;

    public function __construct(WHMCSAPIRequest $api)
    {
        $this->api = $api;
        $this->requestMethod = 'get';
        $this->action = null;
        $this->payload = [];
        $this->response = null;
        $this->totalItems = 0;
        $this->data = null;
        $this->fieldDetails = null;
    }

    protected abstract function getFieldDetails();
    protected abstract function getDataKeys();

    protected function setAction( $action ) {
        $this->action = $action;
        return $this;
    }

    protected function setRequestMethod( $method ) {
        $this->requestMethod = $method;
        return $this;
    }

    protected function send() {
        switch( $this->requestMethod ) {
            case 'get':
                $this->response = $this->api->get($this->action, $this->payload);

                return $this;
            case 'post':
                $this->response = $this->api->post($this->action, $this->payload);
                return $this;
            default:
                return $this;
        }

    }

    protected function getResponse(): array {

        if ( $this->isValidRequest() ) {

            $values = [];

            AQLog::network( self::class."::getResponse data: " . print_r($this->response,true));

            $this->data = $this->response['data'];

            $this->totalItems = intval( $this->data['totalresults'] );

            $this->fieldDetails = $this->getFieldDetails();

            $fields = array_map( function ( $field ) {

                return $field['name'];

            }, $this->fieldDetails );

            $dataKeys = $this->getDataKeys();

            for ( $i = 0; $i < $this->totalItems; $i ++ ) {
                $value = [];
                foreach ( $fields as $field ) {
                    $value[ $field ] = $this->data[ $dataKeys['plural'] ][ $dataKeys['singular'] ][ $i ][ $field ];
                }
                $values[] = $value;
            }

            $pagination = [];

            if ($this->data['data']['numreturned'] > 0 ) {
                $pagination = $this->genPagination( $this->totalItems, $this->totalItems, 1);
            }

            return [
                "success"    => true,
                "data"       => $values,
                "pagination" => $pagination,
                "fields"     => $this->fieldDetails
            ];
        } else {

            return [
                "success" => false,
            ];
        }
    }

    protected function setArguments( $method, $args ) {
        $this->payload = $this->getMyParameters(
            self::class , $method, $args
        );
        return $this;
    }

    protected function isValidRequest() {
        return
            $this->response['success'] && $this->response['data']['result'] === 'success';
    }

    protected function genPagination($numItems, $itemsPerPage , $page) {

        if ($itemsPerPage === 0) {
            return [];
        }

        $totalPages = intval($numItems/$itemsPerPage);
        $currentPage = $page;
        $nextPage = $page + 1 < $totalPages ? $page + 1 : null;
        $prevPage = $page - 1 > 0 ? $page - 1 : null;
        $lastPage = $totalPages;
        $pages = range(1, $lastPage);
        return ["current_page" => intval($currentPage), "previous_page" => intval($prevPage), "next_page" => intval($nextPage), "last_page" => intval($lastPage), "pages" => $pages ];
    }

    protected function calcStartNumber($page, $limit_num) {
        return $page * $limit_num;
    }

    protected function getMyParameters($class, $method, array $args = array()) {
        // AQLog::info( "WHMCSAPIBase::getMyParameters method params: " . print_r([$class, $method, $args],true));
        try {
            $this->reflection = new \ReflectionMethod( $class, $method );
            $argsIndex = 0;
            foreach($this->reflection->getParameters() as $parameter) {
                $paramName = $parameter->getName();
                AQLog::info( "WHMCSAPIBase parameter name: " . $paramName);

                // AQLog::info( "WHMCSAPIBase parameter: " . print_r($paramName,true));
                // if we have a parameter then
                // do we have a value ?
                // if so add it to the parameters

                if ( isset( $args[ $argsIndex ] ) ) {
                    $value = $args[ $argsIndex ];
                    if ( is_string( $value ) ) {
                        if (strlen($value)) {
                            $this->parameters[ $paramName ] = $value;
                        }
                    } elseif ( is_numeric( $value ) ) {
                        $this->parameters[ $paramName ] = $value;
                    } elseif ( is_object( $value ) ) {
                        if ( ! empty((array) $value) ) {
                            $this->parameters[ $paramName ] = $value;
                        }
                    } else {
                        $this->parameters[ $paramName ] = $value;
                    }
                }
                $argsIndex++;
            }
        } catch ( \ReflectionException $e ) {

        }
        // AQLog::info( "WHMCSAPIBase parameters: " . print_r($this->parameters,true));
        return $this->parameters;
    }

}

<?php

namespace App\Modules\WHMCSModule\Libraries\API;

use App\Facades\AQLog;

/**
 * Class WHMCSInvoicesApi
 *
 * @package App\Modules\WHMCSModule\Libraries\API
 */
class WHMCSInvoicesApi extends WHMCSAPIBase {

    protected function getDataKeys() {
        // $this->data[ products ][ products ][ index ][ field ];
        return [
            'plural' => 'invoices',
            'singular' => 'invoice',
        ];
    }

    protected function getFieldDetails() {
        return [
            [ 'name' => 'id', 'text' => 'id', 'sortable' => false ],
            // [ 'name' => 'gid', 'sortable' => true ],
            [ 'name' => 'userid', 'text' => 'userid', 'sortable' => false ],
            [ 'name' => 'firstname', 'text' => 'firstname', 'sortable' => false ],
            [ 'name' => 'lastname', 'text' => 'lastname', 'sortable' => false ],
            [ 'name' => 'companyname', 'text' => 'companyname', 'sortable' => false ],
            [ 'name' => 'invoicenum', 'text' => 'invoicenum', 'sortable' => false ]
        ];
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

            $pagination = $this->genPagination( $this->totalItems, $this->totalItems, 1 );

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

    /**
     * @param int $limitstart
     * @param int $limitnum
     * @param $userid
     * @param string $status
     * @param $orderby
     * @param $order
     * @param int $page
     *
     * @return array
     */
    public function GetInvoices($limitstart = 0, $limitnum = 25, $userid = null, $status = '', $orderby='', $order=null, $page = 0) {

        $clients = [];

        if ($page !== 0) {
            // we always start at position 0
            $limitstart = ($page - 1) * $limitnum;
            AQLog::info( "GetInvoices limit_start: " . $limitstart);
        }

        $this->setArguments(
            __FUNCTION__, [$limitstart, $limitnum, $userid, $status, $orderby, $order]
        );

        // AQLog::network( "GetClients payload: " . print_r($payload,true));

        $this->response = $this->api->post("GetInvoices", $this->payload);

        // AQLog::network( "GetClients Response: " . print_r($this->response,true));

        $this->data = $this->response['data'];

        // AQLog::network( "GetClients data: " . print_r($data,true));
        // AQLog::network( "GetClients result: " . $this->response['success'] );
        // AQLog::network( "GetClients ['data']['result']: " . $this->response['data']['result'] );

        if ($this->response['success'] && $this->response['data']['result'] === 'success' ) {

            $start = intval($this->data['startnumber']);
            $len = intval($this->data['numreturned']);
            $total = intval($this->data['totalresults']);

            $this->fieldDetails = $this->getFieldDetails();

            $fields = array_map( function ( $field ) {
                return $field['name'];
            }, $this->fieldDetails );

            $dataKeys = $this->getDataKeys();

            $this->totalItems = intval( $this->data['totalresults'] );

            for ( $i = $start; $i < $this->totalItems; $i ++ ) {
                $value = [];
                foreach ( $fields as $field ) {
                    $value[ $field ] = $this->data[ $dataKeys['plural'] ][ $dataKeys['singular'] ][ $i ][ $field ];
                }
                $values[] = $value;
            }

            $pagination = $this->genPagination($total, $len, $page);

            return [
                "success" => true,
                "data" => $clients,
                "pagination" => $pagination,
                "fields" => $this->fieldDetails
            ];

        } else {

            return [
                "success" => false,
            ];

        }

    }

}

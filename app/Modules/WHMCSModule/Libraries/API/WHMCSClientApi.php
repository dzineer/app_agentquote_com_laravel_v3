<?php

namespace App\Modules\WHMCSModule\Libraries\API;

use App\Facades\AQLog;

/**
 * Class WHMCSClientApi
 *
 * @package App\Modules\WHMCSModule\Libraries\API
 */
class WHMCSClientApi extends WHMCSAPIBase {

    protected function getDataKeys() {
        // $this->data[ products ][ products ][ index ][ field ];
        return [
            'plural' => 'clients',
            'singular' => 'client',
        ];
    }

    protected function getFieldDetails() {
        return [
            [ 'name' => 'id', 'text' => 'id', 'sortable' => false ],
            [ 'name' => 'firstname', 'text' => 'firstname', 'sortable' => false ],
            [ 'name' => 'lastname', 'text' => 'lastname', 'sortable' => false ],
            [ 'name' => 'companyname', 'text' => 'company', 'sortable' => false ],
            [ 'name' => 'email', 'text' => 'email', 'sortable' => false ],
            [ 'name' => 'datecreated', 'text' => 'datecreated', 'sortable' => false ],
            [ 'name' => 'groupid', 'text' => 'groupid', 'sortable' => false ],
            [ 'name' => 'status', 'text' => 'status', 'sortable' => false ],
        ];
    }

    /**
     * @param int $limitstart
     * @param int $limitnum
     * @param string $sorting
     * @param string $search
     * @param int $page
     *
     * @return array
     */
    public function GetClients($limitstart = 0, $limitnum = 1000, $sorting = 'ASC', $search = '', $page = 0) {
        $clients = [];

        if ($page !== 0) {
            // we always start at position 0
            $limitstart = ($page - 1) * $limitnum;
            AQLog::info( "GetClients limit_start: " . $limitstart);
        }

        $payload = $this->getMyParameters(
            self::class , __FUNCTION__, [$limitstart, $limitnum, $sorting, $page, $search]
        );

        // AQLog::network( "GetClients payload: " . print_r($payload,true));

        $this->response = $this->api->post("GetClients", $payload);

        AQLog::network( "GetClients Response: " . print_r($this->response,true));

        $data = $this->response['data'];

       // AQLog::network( "GetClients data: " . print_r($data,true));
       // AQLog::network( "GetClients result: " . $this->response['success'] );
       // AQLog::network( "GetClients ['data']['result']: " . $this->response['data']['result'] );

        if ($this->response['success'] && $this->response['data']['result'] === 'success' ) {
            $start = intval($data['startnumber']);
            $len = intval($data['numreturned']);
            $total = intval($data['totalresults']);
            for($i=0;  $i < $len; $i++) {
                $clients[] = [
                    'id' => $data['clients']['client'][$i]['id'],
                    'firstname' => $data['clients']['client'][$i]['firstname'],
                    'lastname' => $data['clients']['client'][$i]['lastname'],
                    'companyname' => $data['clients']['client'][$i]['companyname'],
                    'email' => $data['clients']['client'][$i]['email'],
                    'datecreated' => $data['clients']['client'][$i]['datecreated'],
                    'groupid' => $data['clients']['client'][$i]['groupid'],
                    'status' => $data['clients']['client'][$i]['status']
                ];
            }

            $pagination = $this->genPagination($total, $len, $page);

            return [
              "success" => true,
              "data" => $clients,
              "pagination" => $pagination
            ];

        } else {

            return [
                "success" => false,
            ];

        }
    }
}

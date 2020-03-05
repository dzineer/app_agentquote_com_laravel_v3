<?php

namespace App\Modules\WHMCSModule\Libraries\API;

use App\Facades\AQLog;

/**
 * Class WHMCSProductsApi
 *
 * @package App\Modules\WHMCSModule\Libraries\API
 */
class WHMCSProductsApi extends WHMCSAPIBase {

    protected function getDataKeys() {
        // $this->data[ products ][ products ][ index ][ field ];
        return [
            'plural' => 'products',
            'singular' => 'product',
        ];
    }

    protected function getFieldDetails() {
        return [
            [ 'name' => 'pid', 'text' => 'pid', 'sortable' => false ],
            // [ 'name' => 'gid', 'sortable' => true ],
            [ 'name' => 'type', 'text' => 'type', 'sortable' => false ],
            [ 'name' => 'name', 'text' => 'name', 'sortable' => false ],
            [ 'name' => 'description', 'text' => 'description', 'sortable' => false ],
            [ 'name' => 'module', 'text' => 'module', 'sortable' => false ],
            [ 'name' => 'paytype', 'text' => 'pay type', 'sortable' => false ]
        ];
    }

    /**
     * @param int $pid
     * @param int $gid
     * @param null $module
     *
     * @return array
     */
    public function GetProducts($pid = 0, $gid = 0, $module = null) {

        return
            $this->setAction('GetProducts')
                 ->setRequestMethod('post')
                 ->setArguments(__FUNCTION__, [ $pid, $gid, $module ] )
                 ->send()
                 ->getResponse();

       // AQLog::network( "GetClients data: " . print_r($this->data,true));
       // AQLog::network( "GetClients result: " . $this->response['success'] );
       // AQLog::network( "GetClients ['data']['result']: " . $this->response['data']['result'] );

    }

}

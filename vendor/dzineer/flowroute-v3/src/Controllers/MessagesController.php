<?php
/*
 * DZFlowroute
 *
 * This file was automatically generated by APIMATIC v2.0 (https://apimatic.io).
 */

namespace DZFlowroute\Controllers;

use DZFlowroute\APIException;
use DZFlowroute\APIHelper;
use DZFlowroute\Configuration;
use DZFlowroute\Models;
use DZFlowroute\Exceptions;
use DZFlowroute\Utils\DateTimeHelper;
use DZFlowroute\Http\HttpRequest;
use DZFlowroute\Http\HttpResponse;
use DZFlowroute\Http\HttpMethod;
use DZFlowroute\Http\HttpContext;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class MessagesController extends BaseController
{
    /**
     * @var MessagesController The reference to *Singleton* instance of this class
     */
    private static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     * @return MessagesController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (NULL === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Retrieves a list of Message Detail Records (MDRs) within a specified date range. Date and time is
     * based on Coordinated Universal Time (UTC).
     *
     * @param DateTime $startDate  The beginning date and time, in UTC, on which to perform an MDR search. The DateTime
     *                             can be formatted as YYYY-MM-DDor YYYY-MM-DDTHH:mm:ss.SSZ.
     * @param DateTime $endDate    (optional) The ending date and time, in UTC, on which to perform an MDR search. The
     *                             DateTime can be formatted as YYYY-MM-DD or YYYY-MM-DDTHH:mm:ss.SSZ.
     * @param integer  $limit      (optional) The number of MDRs to retrieve at one time. You can set as high of a
     *                             number as you want, but the number cannot be negative and must be greater than 0
     *                             (zero).
     * @param integer  $offset     (optional) The number of MDRs to skip when performing a query. The number must be 0
     *                             (zero) or greater, but cannot be negative.
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getLookUpASetOfMessages(
        $startDate,
        $endDate = NULL,
        $limit = NULL,
        $offset = NULL
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'start_date' => DateTimeHelper::toRfc3339DateTime($startDate),
            'end_date'   => DateTimeHelper::toRfc3339DateTime($endDate),
            'limit'      => $limit,
            'offset'     => $offset,
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return $response->body;
    }

    /**
     * Sets the account level callback for SMS messages.
     *
     * @param url to set for SMS callbacks
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function setAccountSMSCallback(
        $body
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages/sms_callback';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'content-type'  => 'application/vnd.api+json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers, Request\Body::Json($body));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 403) {
            throw new Exceptions\ErrorException(
                'Forbidden – You don\'t have permission to access this resource.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\ErrorException(
                'Unprocessable Entity - You tried to enter an incorrect value.',
                $_httpContext
            );
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return $response->body;
    }

    /**
     * Sets the account level callback for MMS messages.
     *
     * @param url to set for MMS callbacks
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function setAccountMMSCallback(
        $body
    ) {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages/mms_callback';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'content-type'  => 'application/vnd.api+json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers, Request\Body::Json($body));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 403) {
            throw new Exceptions\ErrorException(
                'Forbidden – You don\'t have permission to access this resource.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\ErrorException(
                'Unprocessable Entity - You tried to enter an incorrect value.',
                $_httpContext
            );
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return $response->body;
    }

    /**
     * Sets the account level callback for DLRs.
     *
     * @param url to set for DLR callbacks
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function setAccountDLRCallback(
        $body
    ) {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages/dlr_callback';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'content-type'  => 'application/vnd.api+json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers, Request\Body::Json($body));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 403) {
            throw new Exceptions\ErrorException(
                'Forbidden – You don\'t have permission to access this resource.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\ErrorException(
                'Unprocessable Entity - You tried to enter an incorrect value.',
                $_httpContext
            );
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return $response->body;
    }


    public function setDIDSMSCallback(
        $did,
        $body
    ) {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;

        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2/numbers/';
        $_queryBuilder .= $did;
        $_queryBuilder .= '/relationships/dlr_callback';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'content-type'  => 'application/vnd.api+json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 403) {
            throw new Exceptions\ErrorException(
                'Forbidden – You don\'t have permission to access this resource.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        if ($response->code == 422) {
            throw new Exceptions\ErrorException(
                'Unprocessable Entity - You tried to enter an incorrect value.',
                $_httpContext
            );
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);
        return $response->body;
    }

    /**
     * Sends an SMS or MMS from a Flowroute long code or toll-free phone number to another valid phone
     * number.
     *
     * @param Models\Message $body The SMS or MMS message to send.
     * @return string response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createSendAMessage(
        $body
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'content-type'  => 'application/vnd.api+json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($body));

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 403) {
            throw new Exceptions\ErrorException(
                'Forbidden – You don\'t have permission to access this resource.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        if ($response->code == 422) {
            var_dump($body);
            var_dump($response);
            throw new Exceptions\ErrorException(
                'Unprocessable Entity - You tried to enter an incorrect value.',
                $_httpContext
            );
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        return $response->body;
    }

    /**
     * Searches for a specific message record ID and returns a Message Detail Record (in MDR2 format).
     *
     * @param string $id The unique message detail record identifier (MDR ID) of any message. When entering the MDR ID,
     *                   the number should include the mdr2- preface.
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getLookUpAMessageDetailRecord(
        $id
    ) {

        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/v2.1/messages/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id' => $id,
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'Flowroute SDK v3.0',
            'Accept'        => 'application/json'
        );

        //set HTTP basic auth parameters
        Request::auth(Configuration::$basicAuthUserName, Configuration::$basicAuthPassword);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
        $_httpContext = new HttpContext($_httpRequest, $_httpResponse);

        //call on-after Http callback
        if ($this->getHttpCallBack() != NULL) {
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\ErrorException(
                'Unauthorized – There was an issue with your API credentials.',
                $_httpContext
            );
        }

        if ($response->code == 404) {
            throw new Exceptions\ErrorException('The specified resource was not found', $_httpContext);
        }

        //handle errors defined at the API level
        $this->validateResponse($_httpResponse, $_httpContext);

        $mapper = $this->getJsonMapper();

        return $mapper->mapClass($response->body, 'DZFlowroute\\Models\\MDR2');
    }
}
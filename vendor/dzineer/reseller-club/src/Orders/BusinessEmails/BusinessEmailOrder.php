<?php

namespace DZResellerClub\Orders\BusinessEmails;

use DZResellerClub\Api;
use DZResellerClub\Config;
use DZResellerClub\Orders\BusinessEmails\Requests\AddEmailAccountRequest;
use DZResellerClub\Orders\BusinessEmails\Requests\BusinessEmailOrderRequest;
use DZResellerClub\Orders\BusinessEmails\Requests\DeleteEmailAccountRequest;
use DZResellerClub\Orders\BusinessEmails\Requests\RenewRequest;
use DZResellerClub\Orders\BusinessEmails\Responses\AddedEmailAccountResponse;
use DZResellerClub\Orders\BusinessEmails\Responses\AddedEmailAccountResponseFactory;
use DZResellerClub\Orders\BusinessEmails\Responses\BusinessEmailOrderResponse;
use DZResellerClub\Orders\BusinessEmails\Responses\CreateResponse;
use DZResellerClub\Orders\BusinessEmails\Responses\DeletedEmailAccountResponse;
use DZResellerClub\Orders\BusinessEmails\Responses\GetResponse;
use DZResellerClub\Orders\BusinessEmails\Responses\RenewalResponse;
use DZResellerClub\Orders\Order;

class BusinessEmailOrder
{
    /**
     * @var Config
     */
    private $api;

    /**
     * Create a new business email order instance.
     *
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Place a business email order for the specified domain name.
     *
     * @see https://manage.resellerclub.com/kb/answer/2156
     *
     * @param BusinessEmailOrderRequest $request
     *
     * @return CreateResponse
     */
    public function create(BusinessEmailOrderRequest $request): CreateResponse
    {
        $response = $this->api->post(
            'eelite/us/add.json',
            [
                'domain-name'    => $request->domain(),
                'customer-id'    => $request->customerId(),
                'months'         => $request->forNumberOfMonths(),
                'no-of-accounts' => $request->numberOfAccounts(),
                'invoice-option' => (string) $request->invoiceOption(),
            ]
        );

        return CreateResponse::fromApiResponse($response);
    }

    /**
     * Makes a POST request to ResellerClub's 'delete' business email order API.
     *
     * @see https://manage.resellerclub.com/kb/answer/2162
     *
     * @param Order $request
     *
     * @return BusinessEmailOrderResponse
     */
    public function delete(Order $request): BusinessEmailOrderResponse
    {
        $response = $this->api->post(
            'eelite/us/delete.json',
            [
                'order-id' => $request->id(),
            ]
        );

        return BusinessEmailOrderResponse::fromApiResponse($response);
    }

    /**
     * Makes a GET request to ResellerClub's 'details' business email order API.
     *
     * @see https://manage.resellerclub.com/kb/answer/2163
     *
     * @param Order $request
     *
     * @return GetResponse
     */
    public function get(Order $request): GetResponse
    {
        $response = $this->api->get(
            'eelite/us/details.json',
            [
                'order-id' => $request->id(),
            ]
        );

        return GetResponse::fromApiResponse($response);
    }

    /**
     * Renew an existing business email order.
     *
     * @see https://manage.resellerclub.com/kb/answer/2157
     *
     * @param RenewRequest $request
     *
     * @return RenewalResponse
     */
    public function renew(RenewRequest $request): RenewalResponse
    {
        $response = $this->api->post('eelite/us/renew.json', [
            'order-id'       => $request->orderId(),
            'months'         => $request->months(),
            'no-of-accounts' => $request->numberOfAccounts(),
            'invoice-option' => (string) $request->invoiceOption(),
        ]);

        return RenewalResponse::fromApiResponse($response);
    }

    /**
     * Add email accounts to an existing business email order.
     *
     * @see https://manage.resellerclub.com/kb/answer/2158
     *
     * @param AddEmailAccountRequest $request
     *
     * @return AddedEmailAccountResponse
     */
    public function addEmailAccounts(AddEmailAccountRequest $request): AddedEmailAccountResponse
    {
        $response = $this->api->post('eelite/us/add-email-account.json', [
            'order-id'       => $request->orderId(),
            'no-of-accounts' => $request->numberOfAccounts(),
            'invoice-option' => (string) $request->invoiceOption(),
        ]);

        /*
         * The response body for pay invoice and keep invoice contains an extra level, which annoyingly means we need
         * remove this to have a standardised response.
         */
        return AddedEmailAccountResponse::fromApiResponse(
            AddedEmailAccountResponseFactory::response($request->invoiceOption(), $response)
        );
    }

    /**
     * Delete email accounts from an existing business email order.
     *
     * @see https://manage.resellerclub.com/kb/answer/2159
     *
     * @param DeleteEmailAccountRequest $request
     *
     * @return DeletedEmailAccountResponse
     */
    public function deleteEmailAccounts(DeleteEmailAccountRequest $request): DeletedEmailAccountResponse
    {
        $response = $this->api->post('eelite/us/delete-email-account.json', [
            'order-id'       => $request->orderId(),
            'no-of-accounts' => $request->numberOfAccounts(),
        ]);

        return DeletedEmailAccountResponse::fromApiResponse($response);
    }
}

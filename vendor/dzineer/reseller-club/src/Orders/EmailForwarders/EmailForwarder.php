<?php

namespace DZResellerClub\Orders\EmailForwarders;

use DZResellerClub\Api;
use DZResellerClub\Orders\EmailAccounts\EmailAccount;
use DZResellerClub\Orders\EmailAccounts\Requests\DeleteRequest;
use DZResellerClub\Orders\EmailAccounts\Responses\DeletedResponse;
use DZResellerClub\Orders\EmailForwarders\Requests\CreateRequest;
use DZResellerClub\Orders\EmailForwarders\Responses\CreateResponse;

class EmailForwarder
{
    /**
     * @var Api
     */
    private $api;

    /**
     * Create a new email forwarder instance.
     *
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Add a forward-only email account.
     *
     * @see https://manage.resellerclub.com/kb/answer/1038
     *
     * @param CreateRequest $request
     *
     * @return CreateResponse
     */
    public function create(CreateRequest $request): CreateResponse
    {
        $response = $this->api->post('mail/user/add-forward-only-account.json', [
            'order-id' => $request->orderId(),
            'email'    => (string) $request->email(),
            'forwards' => $request->forwarders(),
        ]);

        return CreateResponse::fromApiResponse($response);
    }

    /**
     * Makes a POST request to ResellerClub's 'delete' email accounts.
     *
     * @see https://manage.resellerclub.com/kb/answer/1049
     *
     * @param DeleteRequest $request
     *
     * @return DeletedResponse
     */
    public function delete(DeleteRequest $request): DeletedResponse
    {
        return (new EmailAccount($this->api))->delete($request);
    }
}

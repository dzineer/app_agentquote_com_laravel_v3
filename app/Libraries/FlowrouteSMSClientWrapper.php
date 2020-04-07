<?php


namespace App\Libraries;

use DZFlowroute\Models\Message as FlowrouteMessage;
use DZFlowroute\Models\MessageCallback as FlowrouteMessageCallback;
use DZFlowroute\FlowrouteNumbersAndMessagingClient as FlowrouteClient;

/**
 * Class AQSMSMessaging
 * @package App\Libraries
 */
class FlowrouteSMSClientWrapper implements SMSClientWrapperInterface
{
    /**
     * @var FlowrouteMessage
     */

    private $client;
    /**
     * @var
     */
    private $messages;
    private $result;
    private $username;
    private $password;
    /**
     * @var array
     */
    private $our_numbers;

    /**
     * SMSClientWrapper constructor.
     * @param $client
     * @param $username
     * @param $password
     */
    public function __construct($client, $username='', $password='')
    {
        // $this->client = $client;

        $this->username = $username;
        $this->password = $password;

        // Access your Flowroute API credentials as local environment variables
        // either the username and password can be passed in or overridden in .env file
        $this->username = !empty($username) ? $username : env('FLOWROUTE_ACCESS_KEY');
        $this->password = !empty($password) ? $password: env('FLOWROUTE_SECRET_KEY');

        // create our client object
        // if our object has already been created let's use that one but if not
        // create it here
        $this->client = isset($client) ? $client : new FlowrouteClient($this->username, $this->password);

        // List all our numbers
        $this->our_numbers = $this->getNumbers();
    }

    private function getNumbers()
    {
        $return_list = array();

        // List all phone numbers in our account paging through them 1 at a time
        //  If you have several phone numbers, change the 'limit' variable below
        //  This example is intended to show how to page through a list of resources

        // create a numbers instance
        $numbers = $this->client->getNumbers();

        // query all our numbers
        $startsWith = NULL;
        $endsWith = NULL;
        $contains = NULL;
        $limit = 10;
        $offset = 0;

        $result = $numbers->getAccountPhoneNumbers($startsWith, $endsWith, $contains, $limit, $offset);
        //var_dump($result);

        foreach($result as $item) {
            foreach($item as $entry) {
                var_dump($entry);
                echo "--------------------------------------\n";
                $return_list[] = $entry;
            }
            echo "--------------------------------------\n";
        }

        $this->our_numbers = $return_list;
        return $this->our_numbers;
    }

    public function getMessages() {
        return $this->client->getMessages();
    }

    /**
     * @param SMSMessageBuilderInterface $message
     * @param null $callback_url
     * @return mixed
     */
    public function send(SMSMessageBuilderInterface $message, $callback_url=null) {

        $this->messages = $this->getMessages();

        if (!empty($callback_url)) {
            $body = new FlowrouteMessageCallback();
            $body->callback_url = $callback_url;
            $this->result = $this->messages->setAccountSMSCallback($body);

        }

        $package = $message->build();

        $package->from = $this->our_numbers[0]->id;

        $this->messages->CreateSendAMessage(
            $package
        );


    }

}

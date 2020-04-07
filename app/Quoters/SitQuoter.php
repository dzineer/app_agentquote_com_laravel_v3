<?php

namespace App\Quoters;

use App\Models\AccountQuote;
use App\Models\AffiliateAd;
use App\Models\Carrier;
use App\Models\CategoriesInsurance;

class SitQuoter {

    const SIT_CATEGORY = 2;

	public function getAccount( $userId ) {
		$acct = AccountQuote::find( $userId );
		// dd($acct);
		return $acct;
	}

	public function mapFields( $fields ) {

		/*
			[id] => 3
			[state] => CA
			[month] => 1
			[day] => 1
			[year] => 1990
			[gender] => M
			[term] => 15
			[tobacco] => N
			[benefit] => 900
			[period] => 0
			[age] => 0
			[age_or_date] => date
			[category] => 1
		 */

		$searchBy = (isset($fields['search_by']) && strlen($fields['search_by']) !== 0);

		$map 	= 	array(
			'id'           =>   $fields['id'],
			'age'          =>   $fields['age'],
			'age_or_date'  =>   $fields['age_or_date'],
			'state'        => 	$fields['state'],
			'month'        => 	$fields['month'],
			'day'          => 	$fields['day'],
			'year'         => 	$fields['year'],
			'gender'       => 	$fields['gender'],
			'term'         => 	$fields['term'],
			'tobacco'      => 	$fields['tobacco'],
			'benefit'      => 	$fields['benefit'],
			'period'       => 	$fields['period'],
			'category'     => 	$fields['category'] );

		// echo "<pre>Map: <br/>" . print_r($map,true); exit;

		if ($searchBy) {
			$map['search_by'] = $fields['search_by'];
		}

		return $map;
	}

	protected function genAgentGuideLink($company, $productName) {
		return '/guides/'.sha1($company." ".$productName).'.pdf';
	}

	protected function genUnderwritingGuidelinesLink($company) {
		return '/uwgl/'.sha1($company).'.pdf';
	}

	protected function genPolicyDetailsLink($company) {
		return '/pd/'.sha1($company).'.pdf';
	}

	public function filterResults( $user, $results ) {

		/* return filtered data */
		$filteredPolicies = array();
		$carriers = CategoriesInsurance::getCarriers($user->id,2);

		$carrierIds = array();
		$carriersLookup = array();


        $ad_record = AffiliateAd::where('affiliate_id', '=', $user->affiliate_id)
            ->where('category_id', '=', self::SIT_CATEGORY)
            ->first();

        // dd($ad_record);

        // echo json_encode($carriers); exit;

        if ($ad_record && $ad_record->company_id !== 0) {

            $found = array_filter($carriers, function($carrier) use($ad_record) {
                return $ad_record->company_id === $carrier->company_id;
            });

            if (! $found) {
                $carrier = Carrier::find($ad_record->company_id);
                dd($carrier);

                $carriers[] = $carrier;
            }

        }

		// echo '<div><pre><br>results: <br>' . print_r( $results, true ) . '<br></pre></div>';
		// echo '<div><pre><br>results: <br>' . print_r( $carriers, true ) . '<br></pre></div>'; exit;



        foreach( $carriers as $carrier ) {
            // echo '<div><pre><br>results: <br>' . print_r( $carrier, true ) . '<br></pre></div>'; exit;
            if ( $carrier->selected != 0 || ($ad_record && $ad_record->company_id === $carrier->company_id )) {
                $carrierIds[] = $carrier->company_id;
            }
            $carriersLookup[ $carrier->company_id ] = $carrier;

        }

		// echo '<div><pre><br>results: <br>' . print_r( $carriersLookup, true ) . '<br></pre></div>'; exit;
		// echo '<div><pre><br>results sss: <br>' . print_r( $results, true ) . '<br></pre></div>'; exit;
		// exit;

        // echo json_encode($results); exit;

		foreach( $results as $key => $result )  {
			if ( $key !== 'inputs' )
			{
				//echo '<div><pre><br>key: <br>' . print_r( $key, true ) . '<br></pre></div>';
				// echo '<div><pre><br>result: <br>' . print_r( $result, true ) . '<br></pre></div>'; exit;
				// $carrier_fk = $result['CompanyFK'];
				// echo '<div><pre><br>result: <br>' . print_r($result, true) . '<br></pre></div>';
				if (in_array(intval($result['CompanyFK']), $carrierIds))
				{
					// echo "in array"; exit;
					$carrier = $carriersLookup[intval($result['CompanyFK'])];
					// echo '<div><pre><br>carrier: <br>' . print_r($carrier, true) . '<br></pre></div>';
					$result['agent_guide_link']             = $this->genAgentGuideLink($result['CompanyName'], $result['ProductName']);
					$result['carrier_link']                 = $carrier->link2;
					$result['link1']                        = $result['agent_guide_link'];
					$result['link2']                        = $result['carrier_link'];

					$carrierDetails['name']                 = $result['CompanyName'];
					$carrierDetails['address1']             = $result['Address1'];
					$carrierDetails['address2']             = $result['Address2'];
					$carrierDetails['addressHeader']        = $result['AddressHeader'];
					$carrierDetails['addressTrailer']       = $result['AddressTrailer'];
					$carrierDetails['assets']               = $result['Assets'];
					$carrierDetails['city']        			= $result['City'];
					$carrierDetails['disclaimer']        	= $result['Disclaimer'];
					$carrierDetails['insuranceInForce']     = $result['InsuranceInForce'];
					$carrierDetails['lastChangedOn']        = $result['LastChangedOn'];
					$carrierDetails['liabilities']        	= $result['Liabilities'];
					$carrierDetails['nwYorkCompany']        = $result['NewYorkCompany'];
					$carrierDetails['phone']        		= $result['PhoneNumber'];
					$carrierDetails['reviewedOn']       	= $result['ReviewedOn'];
					$carrierDetails['stateAbbreviation']    = $result['StateAbbreviation'];
					$carrierDetails['website']        		= $result['Website'];
					$carrierDetails['zipCode']       	    = $result['ZipCode'];
					$carrierDetails['reference']            = $result['Reference'];

					$result['CarrierDetails']               = $carrierDetails;

					$filteredPolicies[]                     = $result;
					// echo '<div><pre><br>result: <br>' . print_r( $result, true ) . '<br></pre></div>';
				}
			}
		}

        // echo json_encode($filteredPolicies); exit;

		// echo '<div><pre><br>carriersLookup: <br>' . print_r( $carriersLookup, true ) . '<br></pre></div>';
		// echo '<div><pre><br>filteredPolicies: <br>' . print_r( $filteredPolicies, true ) . '<br></pre></div>'; exit;

		return $filteredPolicies;

	}

	public function getQuote($user, $fields) {
		$acct = $this->getAccount( 1 );
		$curlconnection	=	$acct->hostname; //fetch term connection url
		$endpoint	    =	$acct->endpoint; //fetch endpoint

		$gw = new AquoterGateway();
		$gw->setHostname( $curlconnection );
		$gw->setEndpoint( $endpoint );

		// echo "<br>host: " . $curlconnection;
		// echo "<br>endpoint: " . $endpoint;

		$response = $gw->getAccessToken( $acct );

		// dd($response);

		$gw->setAccessToken( $response['access_token'] );

		// echo "<br>access token: " . $response['access_token'];
		// echo "<br>response: " . print_r( $response, true );

		$fields['id'] = 3;
		$fields['period'] = 1;
		$fields['category'] = 'Simplified Issue Term';

		$mappedFields = $this->mapFields( $fields );

		if ( !empty($_GET['debug']) && $_GET['debug'] == 'on' ) {
			echo '<pre><br>mappedFields: <br>' . print_r( $mappedFields, true );
		}

		$quote = $gw->getQuote( $mappedFields );
		// echo "<br>quote: " . print_r($quote,true); exit;

		if ( !empty($_GET['debug']) && $_GET['debug'] == 'on' ) {
			echo '<br>quote: <br>' . print_r( json_decode($quote, true), true ) . '<br></pre>';
		}

		$decodedQuote = json_decode($quote, true);

		// echo '<br>quote: <br>' . print_r( $decodedQuote, true ) . '<br></pre>';

		$quote = $this->filterResults($user, $decodedQuote["response"]["Quote"]);

		return $quote;

	}
}

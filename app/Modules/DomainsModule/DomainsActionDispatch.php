<?php

namespace App\Modules\DomainsModule;

use App\Models\Affiliate;
use App\Models\UserDomain;
use App\User;
use Dzineer\CustomModules\CustomModules;

class DomainsActionDispatch {

    public function dispatch( $action, $options ) {
        if ( $action === 'load' ) {

            $config = json_decode( $options, true );

            if ( $config['request'] === 'affiliates' ) {

                $affiliates = Affiliate::where( [ 'active' => 1 ] )->get()->map( function ( $affiliate ) {
                    return [ "id" => $affiliate->id, "name" => $affiliate->name ];
                } )->toArray();

                return [
                    "success"    => true,
                    "affiliates" => $affiliates
                ];
            } elseif ( $config['request'] === 'affiliate.users' ) {

                if ( ! isset( $config['affiliate_id'] ) ) {
                    return [
                        "success" => false,
                        "message" => 'Invalid request'
                    ];
                }

                $affiliate_id = intval( $config['affiliate_id'] );
                $affiliate    = Affiliate::find( $affiliate_id );

                if ( $affiliate ) {

                    $users = User::where( [ 'affiliate_id' => $affiliate_id ] )->get()->map( function ( $user ) {
                        return [ "id" => $user->id, "email" => $user->email ];
                    } )->toArray();

                    return [
                        "success" => true,
                        "users"   => $users
                    ];
                } else {
                    return [
                        "success" => false,
                        "message" => 'Invalid affiliate request'
                    ];
                }

            }
        } elseif ( $action === 'add' ) {
            $config = json_decode( $options, true );

            if ( ! isset( $config['affiliate_id'] ) && ! isset( $config['user_id'] ) && ! isset( $config['domain'] ) ) {
                return [
                    "success" => false,
                    "message" => 'Invalid request'
                ];
            }

            $affiliate_id = intval( $config['affiliate_id'] );
            $affiliate    = Affiliate::find( $affiliate_id );

            if ( $affiliate ) {

                $user_id = intval( $config['user_id'] );

                $user = User::where( [ 'affiliate_id' => $affiliate_id, 'id' => $user_id, 'active' => 1 ] )->get();

                if ( ! $user ) {
                    return [
                        "success" => false,
                        "message" => 'Invalid request'
                    ];
                }

                $domain = $config['domain'];

                $existingDomain = UserDomain::where( "domain", '=', $domain )->first();

                if ( $existingDomain ) {
                    return [
                        "success" => false,
                        "info"    => $domain,
                        "message" => 'Domain already being used.'
                    ];
                }

                UserDomain::create( [
                    "user_id" => $user_id,
                    "domain"  => $domain
                ] );

                return [
                    "success" => true,
                    "message" => 'Affiliated user domain added.'
                ];
            } else {
                return [
                    "success" => false,
                    "message" => 'Invalid affiliate request'
                ];
            }
        } elseif ( $action === 'remove' ) {
            $config = json_decode( $options, true );

            if ( ! isset( $config['domain_id'] ) ) {
                return [
                    "success" => false,
                    "message" => 'Invalid request'
                ];
            }

            $domain_id      = intval( $config['domain_id'] );
            $existingDomain = UserDomain::find( $domain_id );

            if ( $existingDomain ) {
                $existingDomain->delete();

                return [
                    "success" => true,
                    "message" => 'Domain removed successfully.'
                ];
            }

            return [
                "success" => false,
                "message" => 'Domain not removed.'
            ];
        }

        return [
            "success" => false,
            "message" => 'update failed.'
        ];
    }
}

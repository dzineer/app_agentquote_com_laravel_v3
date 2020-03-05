<?php

namespace App\Subscriptions;

class SubscriptionFields
{
    public static function findFields( $custom_fields, $fields = [] ) {
        $found = [];
        foreach( $fields as $field )
        {
            foreach ($custom_fields as $f) {
                if ($field === $f['label']) {
                    $found[ $field ] = $f['value_formatted'];
                }
            }
        }
        return $found;
    }
}
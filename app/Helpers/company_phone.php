<?php

if (! function_exists('company_phone')) {

    function company_phone($company)
    {
        return is_array($company['phone']) ? $company['phone'][0] : $company['phone'];
    }
}

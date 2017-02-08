<?php
if (wa()->getUser()->isAdmin() && empty(shopRees46Plugin::getSettings('shop_id'))) {

    if (!function_exists('curl_init')) {
        return false;
    }

    $firstname = wa()->getUser()->get('firstname');
    $lastname = wa()->getUser()->get('lastname');
    $email = wa()->getUser()->get('email', 'default');
    $phone = wa()->getUser()->get('phone', 'default');
    $company = wa()->getUser()->get('company');
    $position = wa()->getUser()->get('jobtitle');
    $timezone = wa()->getUser()->getTimezone();
    $location = wa()->getUser()->get('address');
    $city = !empty($location[0]['data']['city']) ? $location[0]['data']['city'] : '';
    $country = !empty($location[0]['data']['country']) ? $location[0]['data']['country'] : '';
    $website = wa()->getRootUrl(true);

    $url = 'https://rees46.com/trackcms/shopscript';

    $lead_info = [  
                    'first_name' => $firstname, 
                    'last_name' => $lastname,
                    'email' => $email, 
                    'phone' => $phone,
                    'website' => $website,
                    'city' => $city,
                    'country' => $country,
                    'company' => $company,
                    'position' => $position,
                    'time_zone' => $timezone
                    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $lead_info);
    curl_exec($ch);
    curl_close($ch);
}

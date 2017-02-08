<?php
if (wa()->getUser()->isAdmin() && empty(shopRees46Plugin::getSettings('shop_id'))) {
    if (!function_exists('curl_init')) {
        return false;
    }
    // Адрес магазина, установившего плагин
    $website = wa()->getRootUrl(true);
    $url = 'https://rees46.com/trackcms/shopscript';
    $lead_info = ['website' => $website];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $lead_info);
    curl_exec($ch);
    curl_close($ch);
}

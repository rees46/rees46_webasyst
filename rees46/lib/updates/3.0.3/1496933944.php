<?php

// Удаляем файлы отсутствующие в текущей версии плагина
// Версия плагина 3.0.3

$app_config = wa()->getConfig()->getAppConfig('shop');
$plugin_path = $app_config->getPluginPath('rees46');
$remove_files_list = array('/lib/actions/shopFrontendRees46.controller.php');

foreach($remove_files_list as $file) {
    $file = $plugin_path.$file;
    try {
        if (!file_exists($file) || !is_writable($file)) {
            throw new Exception('file not exists or not writable');
        }
        unlink($file);
    } catch(Exception $e) {
//        echo ("'".$file."' ".$e->getMessage());
    }
}


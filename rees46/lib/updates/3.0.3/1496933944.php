<?php

// Удаляем файлы отсутствующие в текущей версии плагина
// Версия плагина 3.0.3

$remove_files_list = array('../actions/shopFrontendRees46.controller.php');
foreach($remove_files_list as $file) {
    try {
        if (!file_exists($file) || !is_writable($file)) {
            throw new Exception('file not exists or not writable');
        }
        unlink($file);
    } catch(Exception $e) {
//        echo ("'".$file."' ".$e->getMessage());
    }
}


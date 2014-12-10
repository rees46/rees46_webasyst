<?php

class shopRees46PluginSettingsAction extends waViewAction
{
    public function execute()
    {
        $app_settings_model = new waAppSettingsModel();
        $rees46_shop_id = $app_settings_model->get(array('shop', 'rees46'), 'shop_id');
        $this->view->assign('rees46_shop_id', $rees46_shop_id);

        $rees46_secret_key = $app_settings_model->get(array('shop', 'rees46'), 'secret_key');
        $this->view->assign('rees46_secret_key', $rees46_secret_key); 

        $rees46_is_enabled = $app_settings_model->get(array('shop', 'rees46'), 'is_enabled');
        $this->view->assign('rees46_is_enabled', $rees46_is_enabled);    
    }
}

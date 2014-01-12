<?php

use Rain\Tpl;

class BemokiController extends Controller{

    protected $to_json = false;

    function __construct($route) {
        Tpl::configure(array(
                'tpl_dir'=> TEMPLATES_DIR,
                'cache_dir' => CACHE_DIR,
                'auto_escape' => false,
                'debug' => false,
            ));
        parent::__construct($route);
    }

    public function getIndex() {
        $current_price = (float) BitcoinApi::getCurrentPrice();
        $tpl = new Tpl();
        $tpl->assign('current_price', $current_price);
        return $tpl->draw('main', true);
    }

    public function getAddAlert() {
        $alert = Input::get('price', 'You must set the alert price');
        $phone = Input::get('phone', 'Enter the phone number');
    }

}
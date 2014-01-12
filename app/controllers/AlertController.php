<?php

class AlertController extends Controller{

    public function getIndex() {

        $number = Input::get('From');
        $body = Input::get('Body');
        $city = Input::get('FromCity');
        $zip = Input::get('FromZip');
        $state = Input::get('FromState');
        $country = Input::get('FromCountry');

        $msg = Input::getAll();
        file_put_contents('/tmp/twilio.txt', "get: " . print_r($msg,1), FILE_APPEND);

        $high = $low = 0;

        $call = (strpos($body, '!') !== false || strpos($body, 'call') !== false) ? true : false;
        if (preg_match('/alert (\d*)/i', $body, $match)) {
            $current_price = (float) BitcoinApi::getCurrentPrice();

            if ($match[1] > $current_price) {
                $high = $match[1];
                Alert::setHigh($number, $high, $call);
            } else {
                $low = $match[1];
                Alert::setLow($number, $low, $call);
            }
        }
        if (empty($high) && empty($low)){
            throw new Exception("set high or low");
        }
        return array('status' => 'success', 'body' => $body, 'number' => $number, 'high' => $high, 'low' => $low, 'call' => $call);
    }

    public function getCurrentPrice() {
      $this->postCurrentPrice();
    }
    public function postCurrentPrice() {
      $this->to_json = false;

      $current_price = (int) BitcoinApi::getCurrentPrice();
      $message = "";

      for ($i=0;$i<10;$i++) {
        $message .= "Bitcoin is currently $current_price dollar.";
      }
      echo  '<Response>
       <Say voice="man">'.$message.'</Say>
      </Response>';
    }

}

<?php
class Sms {
    public $user;
    public $pass;
    public $sender;
    public $priority;
    public $stype;
    
    public function sendSMS( $data )
    {	        
        $receiverMobNo = $data['receiverMobNo']; 
        $templateType = $data['templateType'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://bhashsms.com/api/sendmsg.php',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                    'user' => SMS_CONFIG_USER,
                    'pass' => SMS_CONFIG_PASS,
                    'sender' => SMS_CONFIG_SENDER,
                    'phone' => $data['receiverMobNo'],
                    'text' => $data['msg'],
                    'priority' => SMS_CONFIG_PRIORITY,
                    'stype' => SMS_CONFIG_STYPE
            )
        ));
        $resp = curl_exec($curl);

        if( strpos($resp,'S.') == 0)
        {
            $bhasSMSId = $resp;
            $deliveryStatus = 'success';
            $errorReason = '';
        }
        else
        {
            $bhasSMSId ='';
            $deliveryStatus = 'fail';
            $errorReason = $resp;
        }
        
        $data['bhasSMSId'] = $bhasSMSId;
        $data['senderMobNo'] = $this->user;
        $data['message'] = $data['msg'];
        $data['deliveryStatus'] = $deliveryStatus;
        $data['errorReason'] = $errorReason;
        $data['templateType'] = $data['templateType'];
        
        
        return json_encode( $data );        
    }
}

<?php
include('phpmailer/PHPMailerAutoload.php');

class Email extends PHPMailer
{
    public function __construct() 
    {
        parent::__construct();
        
        $this->IsSMTP();
        $this->SMTPAuth   = EMAIL_CONFIG_SMTPAuth;     
        $this->SMTPDebug = EMAIL_CONFIG_SMTPDebug;
        $this->Port = EMAIL_CONFIG_PORT;
        $this->Host       = EMAIL_CONFIG_HOST;
        $this->Username   = EMAIL_CONFIG_USERNAME;
        $this->Password   = EMAIL_CONFIG_PASSWORD;
    }
}
?>

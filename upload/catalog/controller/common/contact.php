<?php
class ControllerCommonContact extends Controller 
{
    public function index() 
    {		
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $data['name'] = '';
        $data['email'] = '';
        $data['mobile'] = '';
        $data['subject'] = '';
        $data['message'] = '';
        $data['errro_message'] = array();
        $data['success_message'] = array();
        
                
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) 
        {
            $name = $this->request->post['name'];
            $email = $this->request->post['email'];
            $mobile = $this->request->post['mobile'];
            $subject = $this->request->post['subject'];
            $message = $this->request->post['message'];
            $captcha = $this->request->post['captcha'];
               
            $dataArray = array('name'=>$name,'email'=>$email,'mobile'=>$mobile,'subject'=>$subject,'message'=>$message);

            if( $captcha != $_SESSION['vercode'])
            {
                $data['name'] = $name;
                $data['email'] = $email;
                $data['mobile'] = $mobile;
                $data['subject'] = $subject;
                $data['message'] = $message;
                array_push($data['errro_message'], 'Captcha not matched.');
            }
            else       
            {           
                array_push($data['success_message'], 'Your message has been sent. Our team will contact you soon.');
                
                /*$querymail = new Mail();
                $querymail->protocol = 'smtp';

                $querymail->hostname = EMAIL_CONFIG_HOSTNAME;
                $querymail->username = EMAIL_CONFIG_USERNAME;
                $querymail->password = EMAIL_CONFIG_PASSWORD;
                $querymail->port = EMAIL_CONFIG_PORT;
                $querymail->timeout = EMAIL_CONFIG_TIMEOUT;
                $querymail->setTo($email);
                $querymail->setFrom(EMAIL_CONFIG_SETFROM);
                $querymail->setSender(EMAIL_CONFIG_SETSENDER);
                $querymail->setSubject(html_entity_decode('Please ignore this email. This is just for testing.', ENT_QUOTES, 'UTF-8'));
                $querymail->setHtml(html_entity_decode('Please ignore this email. This is just for testing.', ENT_QUOTES, 'UTF-8')); 
                $sendsendmail = $querymail->send();*/
            }
        }
             
        $this->response->setOutput($this->load->view('common/contact', $data));
    }
    
    protected function validate() 
    {
        //$this->error['warning'] = '';
        
        if (!$this->error) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
    

    public function getCaptchaImage() 
    {
        $len = 5;
                
        $word = array_merge(range('0', '9'), range('A', 'Z'));
        shuffle($word);
        
        $ranStr = substr(implode($word), 0, $len);
        $_SESSION["vercode"] = $ranStr;

        $height = 35; //CAPTCHA image height
        $width = 150; //CAPTCHA image width
        $font_size = 24; 

        $image_p = imagecreate($width, $height);
        $graybg = imagecolorallocate($image_p, 245, 245, 245);
        $textcolor = imagecolorallocate($image_p, 34, 34, 34);

        imagefttext($image_p, $font_size, -2, 15, 26, $textcolor, 'extras/fonts/mono.ttf', $ranStr);
        imagepng($image_p);
    }

}

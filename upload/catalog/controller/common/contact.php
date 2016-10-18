<?php
class ControllerCommonContact extends Controller 
{
    public function index() 
    {		
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) 
        {
            $name = $this->request->post['name'];
            $email = $this->request->post['email'];
            $mobile = $this->request->post['mobile'];
            $subject = $this->request->post['subject'];
            $message = $this->request->post['message'];
            
            $dataArray = array('name'=>$name,'email'=>$email,'mobile'=>$mobile,'subject'=>$subject,'message'=>$message);
            
            $querymail = new Mail();
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
            $sendsendmail = $querymail->send();   
            var_dump($sendsendmail);die;
        }
        
        
        // Captcha
        if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) 
        {
            $data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
        } 
        else 
        {
            $data['captcha'] = '';
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

}

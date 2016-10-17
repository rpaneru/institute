<?php
class ControllerCommonContact extends Controller 
{
    public function index() 
    {		
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

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
}

<?php
class ControllerCommonHeader extends Controller 
{
    public function index() 
    {
        $data = array();
        return $this->load->view('common/header', $data);
    }
}

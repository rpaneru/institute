<?php
require_once (DIR_APPLICATION.'../system/library/resize.image.class.php');

class ControllerCommonGallery extends Controller 
{
    public function index() 
    {		
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->load->model('common/gallery');
        $data['gallery_data'] = $this->model_common_gallery->getGalleryData();        
        
        $this->response->setOutput($this->load->view('common/gallery', $data));
    }
    
    public function resize()
    {
        $resize_image = new Resize_Image();
        
        $image = $this->request->get['imageName'];          
        $resize_image->new_width = $this->request->get['new_width'];
        $resize_image->new_height = $this->request->get['new_height'];
        $images_dir = DIR_APPLICATION . "../extras/gallery/img/";
        $resize_image->image_to_resize =  $images_dir.$image;
        $resize_image->ratio = false;
        $process = $resize_image->resize();           
    }
        
}
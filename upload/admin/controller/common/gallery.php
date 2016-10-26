<?php
require_once (DIR_APPLICATION.'../system/library/resize.image.class.php');

class ControllerCommonGallery extends Controller 
{
    private $error = array();
    
    public function index() 
    {                    
        $this->load->language('common/gallery');        
        $this->load->model('common/gallery');
        $this->getList();
    }

    protected function getList() 
    {
        if (isset($this->request->get['sort'])) {
                $sort = $this->request->get['sort'];
        } else {
                $sort = 'id';
        }

        if (isset($this->request->get['order'])) {
                $order = $this->request->get['order'];
        } else {
                $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
        } else {
                $page = 1;
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true)
        );

        $data['add'] = $this->url->link('common/gallery/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link('common/gallery/delete', 'token=' . $this->session->data['token'] . $url, true);
        

        $filter_data = array(
                'sort'  => $sort,
                'order' => $order,
                'start' => ($page - 1) * $this->config->get('config_limit_admin'),
                'limit' => $this->config->get('config_limit_admin')
        );


        $gallery_total = $this->model_common_gallery->getTotalGallery();
        
        $data['gallery'] = array();
        
        $results = $this->model_common_gallery->getGalleryData($filter_data);                
        
        foreach ($results as $result) 
        {
            $data['gallery'][] = array(
                'id'            => $result['id'],
                'thumbnail'     => $result['thumbnail'],
                'heading'       => $result['heading'],                
                'caption'     => $result['caption'],
                'edit'          => $this->url->link('common/gallery/edit', 'token=' . $this->session->data['token'] . '&id=' . $result['id'] . $url, true)
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_thumbnail'] = $this->language->get('column_thumbnail');
        $data['column_heading'] = $this->language->get('column_heading');
        $data['column_caption'] = $this->language->get('column_caption');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
        } else {
                $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
                $data['success'] = $this->session->data['success'];

                unset($this->session->data['success']);
        } else {
                $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
                $data['selected'] = (array)$this->request->post['selected'];
        } else {
                $data['selected'] = array();
        }

        $url = '';

        if ($order == 'ASC') {
                $url .= '&order=DESC';
        } else {
                $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_name'] = $this->url->link('common/gallery', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $gallery_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($gallery_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($gallery_total - $this->config->get('config_limit_admin'))) ? $gallery_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $gallery_total , ceil($gallery_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['token'] = $this->session->data['token'];
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('common/gallery', $data));
    }
    
    public function add() 
    {
        $this->load->language('common/gallery');        

        $this->document->setTitle($this->language->get('heading_title'));
        
        $this->load->model('common/gallery');
        

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) 
        {
                $this->model_common_gallery->addGallery($this->request->post);

                $this->session->data['success'] = $this->language->get('text_success');

                $url = '';

                if (isset($this->request->get['sort'])) 
                {
                    $url .= '&sort=' . $this->request->get['sort'];
                }

                if (isset($this->request->get['order'])) 
                {
                    $url .= '&order=' . $this->request->get['order'];
                }

                if (isset($this->request->get['page'])) 
                {
                    $url .= '&page=' . $this->request->get['page'];
                }

                $this->response->redirect($this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    protected function getForm() 
    {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        

        $data['entry_heading'] = $this->language->get('entry_heading');
        $data['entry_caption'] = $this->language->get('entry_caption'); 

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) 
        {
            $data['error_warning'] = $this->error['warning'];
        } 
        else
        {
            $data['error_warning'] = '';
        }

        if (isset($this->error['heading'])) 
        {
            $data['error_heading'] = $this->error['heading'];
        } 
        else 
        {
            $data['error_heading'] = '';
        }
        
        if (isset($this->error['caption'])) 
        {
            $data['error_caption'] = $this->error['caption'];
        } 
        else 
        {
            $data['error_caption'] = '';
        }

        $url = '';

        if (isset($this->request->get['sort'])) 
        {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) 
        {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) 
        {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true)
        );

        if (!isset($this->request->get['id'])) 
        {
            $data['action'] = $this->url->link('common/gallery/add', 'token=' . $this->session->data['token'] . $url, true);
        } 
        else 
        {
            $data['action'] = $this->url->link('common/gallery/edit', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'] . $url, true);
        }

        $data['cancel'] = $this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->request->get['id']) && $this->request->server['REQUEST_METHOD'] != 'POST') 
        {
            $gallery_info = $this->model_common_gallery->getGalleryInfo($this->request->get['id']);            
        }
        
        
        
        if (isset($this->request->post['id'])) 
        {
            $data['id'] = $this->request->post['id'];
        } 
        elseif (!empty($gallery_info)) 
        {
            $data['id'] = $gallery_info['id'];
        }  
        else
        {
            $data['id'] = '';
        }

        if (isset($this->request->post['heading'])) 
        {
            $data['heading'] = $this->request->post['heading'];
        } 
        elseif (!empty($gallery_info)) 
        {
            $data['heading'] = $gallery_info['heading'];
        } 
        else 
        {
            $data['heading'] = '';
        }

        
        if (isset($this->request->post['caption'])) 
        {
            $data['caption'] = $this->request->post['caption'];
        } 
        elseif (!empty($gallery_info)) 
        {
            $data['caption'] = $gallery_info['caption'];
        } 
        else 
        {
            $data['caption'] = '';
        }             
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('common/gallery_form', $data));
    }
    
    public function edit() 
    {
        $this->load->language('common/gallery');    

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('common/gallery');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) 
        {
            $this->model_common_gallery->editGallery($this->request->get['id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) 
            {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) 
            {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) 
            {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getForm();
    }

    public function delete() 
    {
        $this->load->language('common/gallery');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('common/gallery');

        if (isset($this->request->post['selected']) && $this->validateDelete()) 
        {
            foreach ($this->request->post['selected'] as $id) 
            {
                $this->model_common_gallery->deleteGallery($id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) 
            {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) 
            {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) 
            {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('common/gallery', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }    

    protected function validateForm() 
    {
        if (!$this->user->hasPermission('modify', 'common/gallery')) 
        {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['heading']) < 1) || (utf8_strlen(trim($this->request->post['heading'])) > 32)) 
        {
            $this->error['heading'] = $this->language->get('error_heading');
        }

        if ((utf8_strlen($this->request->post['caption']) < 1) || (utf8_strlen(trim($this->request->post['caption'])) > 32)) 
        {
            $this->error['caption'] = $this->language->get('error_caption');
        }

        if ($this->error && !isset($this->error['warning'])) 
        {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }


    protected function validateDelete() 
    {
        if (!$this->user->hasPermission('modify', 'common/gallery')) 
        {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
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
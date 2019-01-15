<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->model("Pages_model");
        }
        
	public function index(){           
            $this->load->view('pages_view');
	}
        
        function list_items(){   
            $data['title']= "Page List";         
            $data['page_title'] = "Page List";
            $data['page'] = "list_items";
            $data['breadcrumb'] = array( "Dashboard" => base_url('dashboard/'),"Page List"=>  base_url('pages/list_items'));
           _layout($data);
        }
        
        function list_items_ajax(){                       
                $res = $this->Pages_model->list_items_ajax();
              
                echo json_encode($res);                                 
        }
        
       
       
        
        function add(){   
       
                
            $data['title'] = "Add Page";
            $data['page_title'] = "Add Page";
            $data['page'] = "add";
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Page List"=>  base_url('pages/list_items'), "Add Page"=>  base_url('pages/add'));            
           
            $this->form_validation->set_rules('page_name','Page Name',"required");
            //$this->form_validation->set_rules('image','Image',"required");
		    $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('description','Description','required');
           /*  $this->form_validation->set_rules('metatitle','Meta Title','required');
            $this->form_validation->set_rules('metakeyword','Meta Keyword','required');
		    $this->form_validation->set_rules('metadescription','Meta Description','required');
            */ $this->form_validation->set_rules('status','Status','required');
            

            if(!empty($_FILES['image']['name'])){
                $imageconfig['upload_path'] = 'uploads/profile_image';
                $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
                $imageconfig['file_name'] = $_FILES['image']['name'];
                /* pr($_FILES['picture']);
                die();
                 *///Load upload library and initialize configuration
                $this->load->library('upload',$imageconfig);
                $this->upload->initialize($imageconfig);
                 
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }
            

            if($this->form_validation->run()){

                
                $this->Pages_model->add();
                $this->session->set_flashdata("alert",array("c"=>"s","m"=>"Page Added Successfully. "));
                redirect("pages/list_items");
                
            }        
             
            _layout($data);
           
        }
        
        public function edit() {

        $id = ID_decode($this->uri->segment('3'));
        $data['res'] = $this->Pages_model->viewData($id);
        //pr($data['res']);die;
        $this->form_validation->set_rules('page_name','Page Name',"required");
       
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('description','Description','required');
        /* $this->form_validation->set_rules('metatitle','Meta Title','required');
        $this->form_validation->set_rules('metakeyword','Meta Keyword','required');
        $this->form_validation->set_rules('metadescription','Meta Description','required');
        */ $this->form_validation->set_rules('status','Status','required');

        if(!empty($_FILES['image']['name'])){
            $imageconfig['upload_path'] = 'uploads/profile_image';
            $imageconfig['allowed_types'] = 'jpg|jpeg|png|gif';
            $imageconfig['file_name'] = $_FILES['image']['name'];
            /* pr($_FILES['picture']);
            die();
             *///Load upload library and initialize configuration
            $this->load->library('upload',$imageconfig);
            $this->upload->initialize($imageconfig);
             
            if($this->upload->do_upload('image')){
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            }else{
                $picture = '';
            }
        }else{
            $picture = '';
        }
        
      
            if($this->form_validation->run()){
                $this->Pages_model->edit($id);
                $this->session->set_flashdata("alert", array("c" => "s", "m" => "Page Updated Successfully. "));
                redirect('pages/list_items');
            
               
            }
                
        $data['title'] = "Edit Page";
        $data['page_title'] = "Edit Page";
        $data['page'] = "edit";
        $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'), "Page List" => base_url('pages/list_items'),"Edit Page" =>"");
       
        _layout($data);
    }


    public function view($id = "") {
       
        $id = ID_decode($id);
        
        if (!empty($id)) {
            
            $data['res'] = $this->Pages_model->view($id);
            /* pr($data);
            die; */
            //$data['res'] = $this->Pages_model->view(@$id);
            $data['title'] = 'View Page';
            $data['page_title'] = 'View Page';
            $data['breadcrumb'] = array("Dashboard" => base_url('dashboard/'),"Page List" => base_url('pages/list_items'),"View Page" => "");
            $page = 'user/view';
            //pr($data);die;
            $data['page'] = "view";
            _layout($data);
        }
    }
    


}
        
        


/* End of file users.php */
/* Location: ./application/modules/users/controllers/users.php */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    public $head;
    public $js;
    public $css;

    public function __construct() {
        parent::__construct();


        $this->head = head('Blog:: Dashboard');
        $this->css = css(array(
            'bootstrap.min',
            'clean-blog.min'
        ));
        $this->js = js(array(
            'jquery',
            'bootstrap.min',
            'clean-blog.min',
            'ckeditor/ckeditor'
        ));

        
        $this->load->model('dbObject_model');
        $this->load->model('premission');
        
        $this->load->helper('functions_helper');
    }

    public function index() {
        
        return $this->posts();
    }
    
    /*
     * @Description : Function below will be handling Users Functionality 
     */
    
    private function _get_rules(){
        $group['table'] = MSTABLE_GROUPS;
        $group['where'] = array('gro_super_role' => 0, 'gro_va' => 0);
        return $this->dbObject_model->get($group);
    }

    public function users($perpage = FALSE){
        if ($this->premission->userLoged('users')) {
            
            if (!$perpage) {
                $st = 0;
            } else {
                $st = (int) $perpage;
            }
            
            $user['table'] = MSTABLE_USERS . " as a";
            $user['join'] = array(MSTABLE_GROUPS . ' as c' => 'c.gro_id = a.gro_id');
            $user['display'] = array('a.usr_id as usr_id', 'gro_name_en','usr_email', 'usr_name', 'usr_created', 'usr_fname', 'usr_lname');
            $rows = $this->dbObject_model->get($user);
            
            $this->load->library('pagination');
            $config['base_url'] = site_url("admin/users");
            $config['total_rows'] = count($rows);
            $config['per_page'] = 4;
            $this->db->limit(4, $st);
            $config['uri_segment'] = 3;
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_link'] = '&lt;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_link'] = '<<';
            $config['first_tag_open'] = '<a >';
            $config['first_tag_close'] = '</a>';
            $config['last_link'] = '>>';
            $config['last_tag_open'] = '<a>';
            $config['last_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            $data['users'] = $this->dbObject_model->get($user);
//            var_dump($rows);
            
            $data['page'] = 'users/list_all';
            $this->load->view('admin_template',$data);    
        }
    }
    
    public function add_user($msg = FALSE) {
        if ($this->premission->userLoged('users')) {
            if($msg){
                $data['msg'] = $msg;
            }
            $data['rules'] = $this->_get_rules();
            $data['page'] = 'users/add_user';
            $this->load->view('admin_template',$data);  
        }
    }
    
    public function create_user() {
        if ($this->premission->userLoged('users')) {
            $this->form_validation->set_rules('usr_name', 'User Name', 'trim|required|is_unique[users.usr_name]');
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[users.usr_email]');
            if ($this->form_validation->run() == FALSE) {
                self::add_user(array('error' => validation_errors()));
            } else {
                $now = date('Y-m-d H:i:s');
                $user['table'] = MSTABLE_USERS;
                $user['setdata'] = array(
                    'usr_name' => $this->input->post('usr_name'),
                    'usr_fname' => $this->input->post('fname'),
                    'usr_lname' => $this->input->post('lname'),
                    'gro_id' => $this->input->post('gro_id'),
                    'usr_password' => md5($this->input->post('password')),
                    'usr_email' => $this->input->post('email'),
                    'usr_created' => $now
                );
                $userid = $this->dbObject_model->insert_data($user);
                redirect(site_url('admin/users'));
            }
        }
    }
    
    public function edit_user($usr_id, $msg = FALSE) {
        if ($this->premission->userLoged('users')) {
            if($msg){
                $data['msg'] = $msg;
            }
            
            $user['table'] = MSTABLE_USERS . " as a";
            $user['join'] = array(MSTABLE_GROUPS . ' as c' => 'c.gro_id = a.gro_id');
            $user['where'] = array('usr_id' => (int) $usr_id);
            $data['user'] = $this->dbObject_model->get($user);
            
            $data['rules'] = $this->_get_rules();
            $data['page'] = 'users/edit_user';
            $this->load->view('admin_template',$data);   
        }
    }
    
    public function update_user($usr_id) {
        if ($this->premission->userLoged('users')) {
            $this->form_validation->set_rules('usr_name', 'User Name', 'trim|required');
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                self::edit_user((int) $usr_id,array('error' => validation_errors()));
            } else {
                $user['table'] = MSTABLE_USERS;
                $user['where'] = array('usr_id' => (int) $usr_id);
                $user['setdata'] = array(
                    'usr_name' => $this->input->post('usr_name'),
                    'usr_fname' => $this->input->post('fname'),
                    'usr_lname' => $this->input->post('lname'),
                    'gro_id' => $this->input->post('gro_id'),
                    'usr_email' => $this->input->post('email')
                );
                if($this->input->post('password')){
                    $user['setdata']['usr_password'] = md5($this->input->post('password'));
                }
                $this->dbObject_model->update_date($user);
                redirect(site_url('admin/edit_user/' . (int) $usr_id));
            }
        
        }
    }
    
    public function delete_user($usr_id) {
        if ($this->premission->userLoged('users')) {
            $user['table'] = MSTABLE_USERS;
            $user['delData'] = array($usr_id);
            $user['key'] = "usr_id";
            $this->dbObject_model->delete_data($user);
            redirect(site_url('admin/users'));
        }
    }
    
    /*
     * @Description : Function below will be handling Categories Functionality 
     */
    
    public function categories($perpage = FALSE){
        if ($this->premission->userLoged('categories')) {
            if (!$perpage) {
                $st = 0;
            } else {
                $st = (int) $perpage;
            }
            
            $cates['table'] = MSTABLE_CATEGORY ;
            $rows = $this->dbObject_model->get($cates);
            
            $this->load->library('pagination');
            $config['base_url'] = site_url("admin/categories");
            $config['total_rows'] = count($rows);
            $config['per_page'] = 4;
            $this->db->limit(4, $st);
            $config['uri_segment'] = 3;
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_link'] = '&lt;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_link'] = '<<';
            $config['first_tag_open'] = '<a >';
            $config['first_tag_close'] = '</a>';
            $config['last_link'] = '>>';
            $config['last_tag_open'] = '<a>';
            $config['last_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            $data['categories'] = $this->dbObject_model->get($cates);
            
            $data['page'] = 'admin/categories/categories';
            $this->load->view('admin_template',$data);  
        }
    }
    
    public function add_category($msg = FALSE){
        if ($this->premission->userLoged('categories')) {
            if($msg){
                $data['msg'] = $msg;
            }
            $data['page'] = 'admin/categories/add_category';
            $this->load->view('admin_template',$data);  
        }
    }
    public function create_category(){
        if ($this->premission->userLoged('categories')) {
            $this->form_validation->set_rules('cat_name', 'Categorey Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                self::add_category(array('error' => validation_errors()));
            } else {
                $now = date('Y-m-d H:i:s');
                $user['table'] = MSTABLE_CATEGORY;
                $user['setdata'] = array(
                    'cat_name_en' => $this->input->post('cat_name'),
                    'cat_created' => $now
                );
                $userid = $this->dbObject_model->insert_data($user);
                redirect(site_url('admin/categories'));
            }
        }
    }
    public function edit_category($cat_id, $msg = FALSE){
        if ($this->premission->userLoged('categories')) {
            if($msg){
                $data['msg'] = $msg;
            }
            
            $category['table'] = MSTABLE_CATEGORY ;
            $category['where'] = array('cat_id' => (int) $cat_id);
            $data['category'] = $this->dbObject_model->get($category);
            
            $data['page'] = 'admin/categories/edit_category';
            $this->load->view('admin_template',$data); 
        }
    }
    
    public function update_category($cat_id){
        if ($this->premission->userLoged('categories')) {
            $this->form_validation->set_rules('cat_name', 'Categorey Name', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                self::edit_category((int) $cat_id, array('error' => validation_errors()));
            } else {
                $category['table'] = MSTABLE_CATEGORY;
                $category['where'] = array('cat_id' => (int) $cat_id);
                $category['setdata'] = array(
                    'cat_name_en' => $this->input->post('cat_name')
                );
                $userid = $this->dbObject_model->update_date($category);
                redirect(site_url('admin/edit_category/'.(int) $cat_id));
            }
        }
    }
    public function delete_category($cat_id){
        if ($this->premission->userLoged('categories')) {
            $category['table'] = MSTABLE_CATEGORY;
            $category['delData'] = array($cat_id);
            $category['key'] = "cat_id";
            $this->dbObject_model->delete_data($category);
            redirect(site_url('admin/categories'));
        }
    }
    
    /*
     * @Description : Function below will be handling Posts Functionality 
     */

    public function posts($perpage = FALSE) {
         if ($this->premission->userLoged()){
            
             if (!$perpage) {
                $st = 0;
            } else {
                $st = (int) $perpage;
            }
            
            $posts['table'] = MSTABLE_POSTS ." as a" ;
            $posts['join'] = array(MSTABLE_USERS . ' as b' => 'b.usr_id = a.post_user_id');
            
            $rows = $this->dbObject_model->get($posts);
            $this->load->library('pagination');
            $config['base_url'] = site_url("admin/posts");
            $config['total_rows'] = count($rows);
            $config['per_page'] = 4;
            $this->db->limit(4, $st);
            $config['uri_segment'] = 3;
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_link'] = '&lt;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_link'] = '<<';
            $config['first_tag_open'] = '<a >';
            $config['first_tag_close'] = '</a>';
            $config['last_link'] = '>>';
            $config['last_tag_open'] = '<a>';
            $config['last_tag_close'] = '</a>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            
            $data['posts'] = $this->dbObject_model->get($posts);
            
            
            $data['page'] = 'admin/posts/posts';
            $this->load->view('admin_template',$data);
         }
    }
    
    public function add_post($msg) {
         if ($this->premission->userLoged()){
             if($msg){
                $data['msg'] = $msg;
            }
            $categories['table'] = MSTABLE_CATEGORY;
            $data['categories'] = $this->dbObject_model->get($categories);
            
            $data['page'] = 'admin/posts/add_post';
            $this->load->view('admin_template',$data);  
         }
    }
    
    public function create_post() {
         if ($this->premission->userLoged()){
             $this->form_validation->set_rules('post_title', 'Post Title', 'trim|required');
             $this->form_validation->set_rules('post_body', 'Post Body', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                self::add_post(array('error' => validation_errors()));
            } else {//`post_title`, ``, `post_created_date`, ``
                $now = date('Y-m-d H:i:s');
                $post['table'] = MSTABLE_POSTS;
                $post['setdata'] = array(
                    'post_title' => $this->input->post('post_title'),
                    'post_body' => $this->input->post('post_body'),
                    'post_category_id' => $this->input->post('cat_id'),
                    'post_user_id' => $this->session->userdata('user_id'),
                    'post_created_date' => $now
                );
                $userid = $this->dbObject_model->insert_data($post);
                redirect(site_url('admin/posts'));
            }
         }
    }
    
    public function edit_post($post_id, $msg = FALSE) {
         if ($this->premission->userLoged()){
             if($msg){
                $data['msg'] = $msg;
            }
            
            $categories['table'] = MSTABLE_CATEGORY;
            $data['categories'] = $this->dbObject_model->get($categories);
            
            $post['table'] = MSTABLE_POSTS;
            $post['where'] = array('post_id' => (int) $post_id);
            $data['post'] = $this->dbObject_model->get($post);
            
            $data['page'] = 'admin/posts/edit_post';
            $this->load->view('admin_template',$data);  
         }
    }
    
    public function update_post($post_id) {
        if ($this->premission->userLoged()){
             $this->form_validation->set_rules('post_title', 'Post Title', 'trim|required');
             $this->form_validation->set_rules('post_body', 'Post Body', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                self::edit_post((int) $post_id, array('error' => validation_errors()));
            } else {
                $now = date('Y-m-d H:i:s');
                $post['table'] = MSTABLE_POSTS;
                $post['where'] = array('post_id' => (int) $post_id);
                $post['setdata'] = array(
                    'post_title' => $this->input->post('post_title'),
                    'post_body' => $this->input->post('post_body'),
                    'post_category_id' => $this->input->post('cat_id')
                );
                $userid = $this->dbObject_model->update_date($post);
                redirect(site_url('admin/edit_post/'.(int) $post_id));
            }
         }
    }
    
    public function delete_post($post_id) {
        if ($this->premission->userLoged()) {
            $post['table'] = MSTABLE_POSTS;
            $post['delData'] = array($post_id);
            $post['key'] = "post_id";
            $this->dbObject_model->delete_data($post);
            redirect(site_url('admin/posts'));
        }
    }
    
    
}    
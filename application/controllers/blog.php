<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    public $head;
    public $js;
    public $css;

    public function __construct() {
        parent::__construct();

        $this->load->helper('autoload_helper');

        $this->head = head('Blog:: Home Page');
        $this->css = css(array(
            'bootstrap.min',
            'clean-blog.min'
        ));
        $this->js = js(array(
            'jquery',
            'bootstrap.min',
            'clean-blog.min'
        ));

        
        $this->load->model('dbObject_model');
        $this->load->model('Options_model');
    }

    public function index($perpage = FALSE) {
//        var_dump($_GET);exit;
        if (!$perpage) {
            $st = 0;
        } else {
            $st = (int) $perpage;
        }
        
        $cates['table'] = MSTABLE_CATEGORY ;
        $data['categories'] = $this->dbObject_model->get($cates);
        
        $users['table'] = MSTABLE_USERS ;
        $data['users'] = $this->dbObject_model->get($users);
        
        $posts['table'] = MSTABLE_POSTS ." as a" ;
        $posts['join'] = array(MSTABLE_USERS . ' as b' => 'b.usr_id = a.post_user_id');
        
        if($_GET['sortPostsByAuthor']){
            $posts['where'] = array('usr_id' => (int) $_GET['sortPostsByAuthor']);
        }
        
        if($_GET['sortByDate']){
            $posts['orderby'] = 'post_created_date '.$_GET['sortByDate'];
        }
        
        if($_GET['sortPostsByCategory']){
            $posts['where'] = array('post_category_id' => (int) $_GET['sortPostsByCategory']);
        }
        
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

        $data['page'] = 'blog/hompe_page';
        $this->load->view('template',$data);
    }
    
    public function post($post_id){
        $posts['table'] = MSTABLE_POSTS ." as a" ;
        $posts['join'] = array(MSTABLE_USERS . ' as b' => 'b.usr_id = a.post_user_id');
        $posts['where'] = array('post_id' => (int) $post_id);
        $data['post'] = $this->dbObject_model->get($posts);
        
        $data['page'] = 'blog/post';
        $this->load->view('template',$data);
    }
    


}    
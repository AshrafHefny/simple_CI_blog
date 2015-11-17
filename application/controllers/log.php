<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log extends CI_Controller {

    /**
     * @author Ashraf Hefny
     * @copyright 2014 Ashraf Hefny
     */
    public $head;
    public $js;
    public $css;

    public function __construct() {
        parent::__construct();
        $this->head = head(DefaultTitle);
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
        // $this->load->model('process_model');
    }

    public function index() {
        if ($this->session->userdata('user_id')) {
            redirect(site_url('blog/index'));
        } else {
            self::_loginPage();
        }
    }

    private function _loginPage($mes = false) {
        $data = "";
        if ($mes) {
            $data['mes'] = $mes;
        }
        $this->load->view('users/login', $data);
    }

    public function check_login() {
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            self::_loginPage(array('error' => validation_errors()));
        } else {
            $vars['table'] = MSTABLE_USERS;
            $vars['where'] = array('usr_name' => $this->input->post('username'), 'usr_password' => md5($this->input->post('password')));
            $userDet = $this->dbObject_model->get($vars);
            if (count($userDet) > 0) {
                $userId = $userDet[0]['usr_id'];
                $this->session->set_userdata(array('user_id' => $userId));
                $this->config->set_item('name', $userDet[0]['usr_name']);

                redirect(site_url());
            } else {
                self::_loginPage(array('error' => 'Your User Name / Password Is Incorrect'));
            }
        }
    }

    public function reset_password() {
        $this->css .= css(array('login', 'forms'));
        $this->load->view('reset_password');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    

    public function logout() {
        $this->load->library('cart');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('coupon_data');
        $this->cart->destroy();
        redirect(site_url('log/index'));
    }

}

?>

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission extends CI_Controller {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    public $head;
    public $js;
    public $css;
    public $breadCrumb;

    public function __construct() {
        parent::__construct();
        if ($this->premission->userLoged('viewPermissions')) {
            $this->head = head(DefaultTitle);
            $this->css = css(array(
                'dashstyle'
                ));
            $this->js = js(array('jquery-1.9.0.min'));
            
            $this->lang->load('area');
            $this->load->model('process_model');
            $this->load->model('dbObject_model');
            $this->load->vars($setGlobalVars);
        }
    }

    public function index() {
        $this->breadCrumb .= " > <b>Permission</b>";

        $vars['table'] = MSTABLE_GROUPS;
        $vars['display'] = array('gro_name_en', 'gro_id');
//        $vars['langFeild'] = array('gro_name');
        $vars['where'] = array('gro_super_role' => 0, 'gro_va' => 0, 'gro_deleted' => 0, 'gro_name_en !=' => 'admin');
        $data['group'] = $this->dbObject_model->get($vars);
//        echo '<pre>';
//        print_r($this->dbObject_model->get($vars));
        $this->load->view('dash/permission/index', $data);
    }

    public function rules($groupID) {
        $this->js = js(array(
            'jquery-1.9.0.min'));
        $data['groupID'] = $groupID;
        $groupID = (int) $groupID;
        $get['table'] = MSTABLE_GROUPS;
        $get['display'] = array('gro_name_en', 'gro_name_en as groupName', 'permission');
        $data['group'] = $this->dbObject_model->get($get, array('gro_id' => $groupID));
        $vars['table'] = MSTABLE_RULES;
        $vars['display'] = array('rul_name_en', 'rul_id', 'parent', 'rul_slug');
        $vars['orderby'] = "parent";
        $rule = $this->dbObject_model->get($vars);
        //print_r($rule);
        $data['rules'] = array();
        for ($i = 0; $i < count($rule); $i++) {
            if ($rule[$i]['parent'] == 0 || $rule[$i]['parent'] == "") {
                $data['rules'][$rule[$i]['rul_id']] = $rule[$i];
            } else {
                $data['rules'][$rule[$i]['parent']]['child'][] = $rule[$i];
            }
        }
//        print_r($rule);
//        exit();
        unset($rule);
        $this->load->view('dash/permission/rules', $data);
    }

    public function update() {
        if ($this->input->post('group') != "") {
            $gro_id = (int) $this->input->post('group');
            $rules = serialize($this->input->post('rules'));
            $set['table'] = MSTABLE_GROUPS;
            if ($this->input->post('rules')) {
                $set['setdata'] = array('permission' => $rules);
            } else {
                $set['setdata'] = array('permission' => NULL);
            }
            $set['where'] = array('gro_id' => $gro_id);
            $this->dbObject_model->update_date($set);
            redirect(site_url('permission/rules/' . $gro_id));
            //echo count($this->input->post('rules'));
        } else {
            redirect(site_url('permission'));
        }
    }

}
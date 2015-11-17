<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class premission extends CI_Model {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    private $userdata = array();

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('user_id')) {

            $this->db->select(MSTABLE_GROUPS . '.gro_name_en, ' . MSTABLE_GROUPS . '.permission');
            $this->db->from(MSTABLE_GROUPS);
            $this->db->where(array(MSTABLE_USERS . '.usr_id' => $this->session->userdata('user_id')));
            $this->db->join(MSTABLE_USERS, MSTABLE_USERS . '.gro_id = ' . MSTABLE_GROUPS . '.gro_id');
            $user = $this->db->get()->result_array();
            if (count($user) > 0) {
                $this->userdata = $user[0];
            }
        }
    }

    public function userLoged($rule = "", $redirect = true) {
        if ($rule != "") {

            if (count($this->userdata) > 0) {

                if (($this->userdata['gro_name_en'] == "admin" || $this->userdata['gro_name_en'] == "super admin")) {
                    return true;

                } else {
                    $userRule = ($this->userdata['permission'] != "") ? unserialize($this->userdata['permission']) : array();
                                       
                    if (in_array($rule, $userRule)) {
                        
                        return true;
                    } else {
                        
                        $this->session->set_flashdata('error');
                        if ($redirect)
                            redirect(site_url());

                        return false;

                    }
                }
            } else {
                //
                $this->session->set_flashdata('error');
                if ($redirect)
                    redirect(site_url('log/index'));

                return false;
            }
        } else {
            if ($this->session->userdata('user_id')) {
                return true;
            } else {
                if ($redirect)
                    redirect(site_url('log/index'));
                return false;
            }
        }
    }

    public function checkAdmin() {
        if (isset($this->userdata['gro_name_en'])) {
            if ($this->userdata['gro_name_en'] != "admin" && $this->userdata['gro_name_en'] != "super admin") {
                $this->session->set_flashdata('error');
                redirect(site_url('profile/index'));

                return false;
            } else {
                return true;
            }
        } else {
            $this->session->set_flashdata('error');
            redirect(site_url());
        }
    }

    

   
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Options_model extends CI_Model {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */
    function __construct() {

        parent::__construct();
        $this->load->model('dbObject_model');
    }

   
    function getName($id, $table, $display = false, $lang = false) {
        $sendVarName['table'] = $table;
        if ($display)
            $sendVarName['display'] = $display;
        if ($lang)
            $sendVarName['langFeild'] = $display;
        $ret = $this->dbObject_model->get($sendVarName, $id);
        if (count($ret) > 0) {
            return $ret[$display[0]];
        } else {
            return false;
        }
    }

    function getTotalUsers($userID) {

        $userID = (int) $userID;

        $this->db->select('usr_totalUsers');

        $this->db->from(MSTABLE_USERS);

        $this->db->where(array('usr_id' => $userID));

        $data = $this->db->get()->row_array();

        return $data['usr_totalUsers'];
    }

    public function isThisAdmin($id) {
        $user['table'] = MSTABLE_USERS;
        $user['display'] = array('usr_id');
        $user['join'] = array(MSTABLE_GROUPS => MSTABLE_GROUPS . '.gro_id = ' . MSTABLE_USERS . '.gro_id');
        $user['where'] = array(
            MSTABLE_GROUPS . '.gro_name_en' => "admin",
            MSTABLE_USERS . '.usr_id' => $id
        );
        $res = $this->dbObject_model->get($user);
        if (count($res) > 0) {
            return true;
        } else {
            return false;
        }
    }


    function generatePassword() {
        $password = '';
        $a2z = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r',
            's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        for ($i = 0; $i <= 8; $i++) {
            $char = rand(0, 1);
            if ($char == 0) {
                $password.=rand(0, 9);
            } else {
                $password.=$a2z[rand(0, 25)];
            }
        }
        return $password;
    }

}

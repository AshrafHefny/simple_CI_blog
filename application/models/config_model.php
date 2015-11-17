<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Config_model extends CI_Model {

    /**
     * @author Ashraf Hefny
     * @copyright 2015 Ashraf Hefny
     */

    function __construct() {
        parent::__construct();
        $tables = $this->db->query('SELECT 
                                    table_name AS ' . MSTABLEFIELD . ' 
                                    FROM 
                                    information_schema.tables
                                    WHERE 
                                    table_schema = DATABASE()
                                    ')->result_array();
        foreach ($tables as $item) {
            $uppercase = strtoupper(MSTABLEPREFIX . $item[MSTABLEFIELD]);
            define($uppercase, $item[MSTABLEFIELD]);
        }

        define('IMAGES', base_url('images'));
        define('UPLOAD', base_url('uploads'));
        define('JS', base_url('js'));
        define('CSS', base_url('css'));
    }
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DbObject_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get($vars, $id = array()) {
        extract($vars, EXTR_OVERWRITE);
        if (isset($display)) {
            if (count($display) > 0) {
                if (isset($langFeild)) {
                    if (count($langFeild) > 0) {
                        for ($i = 0; $i < count($langFeild); $i++) {
                            $key = array_search($langFeild[$i], $display);
                            if ($key != "" || $key == 0) {
                                $display[$key] = $langFeild[$i] . lang('prefix') . ' as ' . $langFeild[$i];
                            }
                        }
                    }
                }
            }
            $show = implode(',', $display);
            $this->db->select($show);
        }
        if (isset($id)) {
            if (count($id) > 0) {
                $query = $this->db->get_where($table, $id);

                return $query->row_array();
            } else {

                if (isset($table))
                    $this->db->from($table);
                if (isset($join)) {
                    if (count($join) > 0) {
                        foreach ($join as $key => $value) {
                            if (is_array($value)) {
                                $get_value = implode(',', $value);
                            } else {
                                $get_value = $value;
                            }
                            $this->db->join($key, $get_value);
                        }
                    }
                }
                if (isset($leftjoin)) {
                    if (count($leftjoin) > 0) {
                        foreach ($leftjoin as $leftkey => $leftvalue) {
                            if (is_array($leftvalue)) {
                                $get_leftvalue = implode(',', $leftvalue);
                            } else {
                                $get_leftvalue = $leftvalue;
                            }
                            $this->db->join($leftkey, $get_leftvalue, 'left');
                        }
                    }
                }
                if (isset($where))
                    $this->db->where($where);
                if (isset($orwhere)) {
                    if (count($orwhere) > 0) {
                        $this->db->or_where($orwhere);
                    }
                }
                if (isset($like)) {
                    if (!isset($likeoptions)) {
                        $this->db->like($like);
                    } else {
                        $this->db->like($like, $likeoptions);
                    }
                }
                if (isset($wherein)) {                    
                    foreach ($wherein as $key => $value) {
                        $this->db->where_in($key, $wherein[$key]);
                    }
                    
                }
                if (isset($wherenotin)) {
                    $this->db->where_not_in($wherenotinoptions, $wherenotin);
                }

                if (isset($orlike)) {
                    if (!isset($orlikeoptions)) {
                        $this->db->or_like($orlike);
                    } else {
                        $this->db->or_like($orlike, $orlikeoptions);
                    }
                }

                if (isset($notlike))
                    $this->db->not_like($notlike);


                if (isset($ornotlike))
                    $this->db->or_not_like($ornotlike);

                if (isset($groupby)) {
                    if (count($groupby) > 0) {
                        $this->db->group_by($groupby);
                    }
                }
                if (isset($orderby)) {
                    $this->db->order_by($orderby);
                }
                if (isset($limit))
                    $this->db->limit($limit);

                $result = $this->db->get()->result_array();
                unset($display);
                unset($langFeild);
                unset($id);
                unset($table);
                unset($join);
                unset($where);
                unset($orwhere);
                unset($like);
                unset($orlike);
                unset($notlike);
                unset($ornotlike);
                unset($groupby);
                unset($orderby);
                unset($limit);
                return $result;
            }
        }
    }

    public function insert_data($vars) {
        extract($vars, EXTR_SKIP);
        $this->db->set($setdata);
        $this->db->insert($table);
        $id = $this->db->insert_id();
        unset($setdata);
        unset($table);
        return $id;
    }

    public function update_date($vars) {
        extract($vars, EXTR_SKIP);
        $this->db->set($setdata);
        $this->db->where($where);
        $this->db->update($table);
        unset($setdata);
        unset($table);
        unset($where);
        return $this->db->affected_rows();
    }

    public function delete_data($vars) {
        extract($vars, EXTR_SKIP);
        for ($i = 0; $i < count($delData); $i++) {
            $this->db->delete($table, array($key => $delData[$i]));
        }


//return $this->db->affected_rows();
    }

}

?>
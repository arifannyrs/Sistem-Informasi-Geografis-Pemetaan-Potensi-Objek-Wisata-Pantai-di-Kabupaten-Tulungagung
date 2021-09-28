<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pengguna_model extends CI_Model {

    public function get_all_pengguna($sort = 'asc')
    {
        $this->db->order_by('id_pengguna', $sort);
        return $this->db->get('login');
    }

    public function get_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->get('login');
    }

    public function add_pengguna($params)
    {
        return $this->db->insert('login', $params);
    }
    
    public function daftar($params)
    {
        return $this->db->insert('login', $params);
    }

    public function update_pengguna($id_pengguna, $params)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->update('login', $params);
    }

    public function delete_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->delete('login');
    }

    public function get_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('login');
    }

    public function cek_unik_username($username, $username_tmp)
    {
        $this->db->where('username', $username);
        $this->db->where('username <>', $username_tmp);
        return $this->db->get('login');
    }

    public function cek_unik_email($email, $email_tmp)
    {
        $this->db->where('email', $email);
        $this->db->where('email <>', $email_tmp);
        return $this->db->get('login');
    }

}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
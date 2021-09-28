<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jenis_model extends CI_Model
{

    public function get_all_jenis($sort = 'asc')
    {
        $this->db->order_by('id_jenis', $sort);
        return $this->db->get('jenis');
    }

    public function get_jenis($id_jenis)
    {
        $this->db->where('id_jenis', $id_jenis);
        return $this->db->get('jenis');
    }

    public function add_jenis($params)
    {
        return $this->db->insert('jenis', $params);
    }

    public function update_jenis($id_jenis, $params)
    {
        $this->db->where('id_jenis', $id_jenis);
        return $this->db->update('jenis', $params);
    }

    public function delete_jenis($id_jenis)
    {
        $this->db->where('id_jenis', $id_jenis);
        return $this->db->delete('jenis');
    }
}

/* End of file Jenis_model.php */
/* Location: ./application/models/Jenis_model.php */
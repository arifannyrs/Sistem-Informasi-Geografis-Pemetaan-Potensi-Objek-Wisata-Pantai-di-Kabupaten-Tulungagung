<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Nilai_model extends CI_Model
{

    public function get_all_nilai($sort = 'asc')
    {
        $this->db->order_by('id_nilai', $sort);
        return $this->db->get('nilai');
    }

    public function get_nilai($id_nilai)
    {
        $this->db->where('id_nilai', $id_nilai);
        return $this->db->get('nilai');
    }

    public function add_nilai($params)
    {
        return $this->db->insert('nilai', $params);
    }

    public function update_nilai($id_nilai, $params)
    {
        $this->db->where('id_nilai', $id_nilai);
        return $this->db->update('nilai', $params);
    }

    public function delete_nilai($id_nilai)
    {
        $this->db->where('id_nilai', $id_nilai);
        return $this->db->delete('nilai');
    }

    public function update_prioritas($params)
    {
        return $this->db->update('nilai', $params);
    }

    public function get_rentang_nilai($nilai)
    {
        $this->db->where('batas_2 >=', $nilai);
        $this->db->where('batas_1 <=', $nilai);
        return $this->db->get('nilai');
    }
}

/* End of file Nilai_model.php */
/* Location: ./application/models/Nilai_model.php */
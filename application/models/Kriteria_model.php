<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kriteria_model extends CI_Model
{

    public function get_all_kriteria($sort = 'asc')
    {
        $this->db->order_by('id_kriteria', $sort);
        return $this->db->get('kriteria');
    }

    public function get_kriteria($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->get('kriteria');
    }

    public function add_kriteria($params)
    {
        return $this->db->insert('kriteria', $params);
    }

    public function update_kriteria($id_kriteria, $params)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->update('kriteria', $params);
    }

    public function delete_kriteria($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->delete('kriteria');
    }

    public function update_prioritas($params)
    {
        return $this->db->update('kriteria', $params);
    }
}

/* End of file Kriteria_model.php */
/* Location: ./application/models/Kriteria_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pantai_kriteria_model extends CI_Model {

    public function get_pantai_kriteria($id_pantai, $id_kriteria)
    {
        $this->db->where('id_pantai', $id_pantai);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->get('pantai_kriteria');
    }

    public function add_pantai_kriteria($params)
    {
        return $this->db->insert('pantai_kriteria', $params);
    }

    public function update_pantai_kriteria($id_pantai, $id_kriteria, $params)
    {
        $this->db->where('id_pantai', $id_pantai);
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->update('pantai_kriteria', $params);
    }

    public function get_all_pantai_kriteria()
    {
        return $this->db->get('pantai_kriteria');
    }

    public function update_by_id($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('pantai_kriteria', $params);
    }

}

/* End of file Pantai_kriteria_model.php */
/* Location: ./application/models/Pantai_kriteria_model.php */
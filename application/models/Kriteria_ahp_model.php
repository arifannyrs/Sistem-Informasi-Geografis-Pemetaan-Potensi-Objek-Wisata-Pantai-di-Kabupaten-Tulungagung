<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kriteria_ahp_model extends CI_Model
{

    public function get_kriteria_ahp($id_kriteria_1, $id_kriteria_2)
    {
        $this->db->where('id_kriteria_1', $id_kriteria_1);
        $this->db->where('id_kriteria_2', $id_kriteria_2);
        return $this->db->get('kriteria_ahp');
    }

    public function add_kriteria_ahp($params)
    {
        return $this->db->insert('kriteria_ahp', $params);
    }

    public function update_kriteria_ahp($id_kriteria_1, $id_kriteria_2, $params)
    {
        $this->db->where('id_kriteria_1', $id_kriteria_1);
        $this->db->where('id_kriteria_2', $id_kriteria_2);
        return $this->db->update('kriteria_ahp', $params);
    }

    public function delete_kriteria_ahp()
    {
        return $this->db->empty_table('kriteria_ahp');
    }
}

/* End of file Kriteria_nilai_model.php */
/* Location: ./application/models/Kriteria_nilai_model.php */
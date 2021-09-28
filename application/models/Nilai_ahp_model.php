<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Nilai_ahp_model extends CI_Model
{

    public function get_nilai_ahp($id_nilai_1, $id_nilai_2)
    {
        $this->db->where('id_nilai_1', $id_nilai_1);
        $this->db->where('id_nilai_2', $id_nilai_2);
        return $this->db->get('nilai_ahp');
    }

    public function add_nilai_ahp($params)
    {
        return $this->db->insert('nilai_ahp', $params);
    }

    public function update_nilai_ahp($id_nilai_1, $id_nilai_2, $params)
    {
        $this->db->where('id_nilai_1', $id_nilai_1);
        $this->db->where('id_nilai_2', $id_nilai_2);
        return $this->db->update('nilai_ahp', $params);
    }

    public function delete_nilai_ahp()
    {
        return $this->db->empty_table('nilai_ahp');
    }
}

/* End of file Nilai_ahp_model.php */
/* Location: ./application/models/Nilai_ahp_model.php */
<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Hasil_model extends CI_Model
{

    public function get_all_hasil($sort = 'asc', $id_jenis = '')
    {
        $this->db->order_by('id_hasil', $sort);
        $this->db->join('pantai', 'pantai.id_pantai=hasil.id_pantai', 'left');
        if (!empty($id_jenis)) {
            $this->db->where('hasil.id_jenis', $id_jenis);
        }
        return $this->db->get('hasil');
    }

    public function get_by_nilai($id_jenis)
    {
        $this->db->order_by('nilai_hasil', 'desc');
        $this->db->join('pantai', 'pantai.id_pantai=hasil.id_pantai', 'left');
        $this->db->where('hasil.id_jenis', $id_jenis);
        return $this->db->get('hasil');
    }

    public function add_hasil($params)
    {
        return $this->db->insert('hasil', $params);
    }

    public function delete_hasil($id_jenis)
    {
        $this->db->where('id_jenis', $id_jenis);
        return $this->db->delete('hasil');
    }
}

/* End of file Hasil_model.php */
/* Location: ./application/models/Hasil_model.php */
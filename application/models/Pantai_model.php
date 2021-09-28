<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pantai_model extends CI_Model
{

    public function get_all_pantai($sort = 'asc', $id_jenis = '')
    {
        $this->db->order_by('id_pantai', $sort);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan=pantai.id_kecamatan', 'left');
        $this->db->join('jenis', 'jenis.id_jenis=pantai.id_jenis', 'left');
        if (!empty($id_jenis)) {
            $this->db->where('pantai.id_jenis', $id_jenis);
        }
        return $this->db->get('pantai');
    }

    public function get_pantai($id_pantai)
    {
        $this->db->where('id_pantai', $id_pantai);
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan=pantai.id_kecamatan', 'left');
        $this->db->join('jenis', 'jenis.id_jenis=pantai.id_jenis', 'left');
        return $this->db->get('pantai');
    }

    public function get_all_marker()
    {
        $this->db->select('*');
        $this->db->from('pantai');
        return $this->db->get()->result();
    }

    public function add_pantai($params)
    {
        $this->db->insert('pantai', $params);
        return $this->db->insert_id();
    }

    public function update_pantai($id_pantai, $params)
    {
        $this->db->where('id_pantai', $id_pantai);
        return $this->db->update('pantai', $params);
    }

    public function delete_pantai($id_pantai)
    {
        $this->db->where('id_pantai', $id_pantai);
        return $this->db->delete('pantai');
    }
}

/* End of file Pantai_model.php */
/* Location: ./application/models/Pantai_model.php */
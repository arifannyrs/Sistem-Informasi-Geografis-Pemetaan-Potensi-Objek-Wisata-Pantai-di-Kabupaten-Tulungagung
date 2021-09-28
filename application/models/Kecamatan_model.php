<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kecamatan_model extends CI_Model
{

    public function get_all_kecamatan($sort = 'asc')
    {
        $this->db->order_by('id_kecamatan', $sort);
        return $this->db->get('kecamatan');
    }

    public function get_geojson()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        return $this->db->get()->result();
    }

    public function get_kecamatan($id_kecamatan)
    {
        $this->db->where('id_kecamatan', $id_kecamatan);
        return $this->db->get('kecamatan');
    }

    public function add_kecamatan($params)
    {
        return $this->db->insert('kecamatan', $params);
    }

    public function update_kecamatan($id_kecamatan, $params)
    {
        $this->db->where('id_kecamatan', $id_kecamatan);
        return $this->db->update('kecamatan', $params);
    }

    public function delete_kecamatan($id_kecamatan)
    {
        $this->db->where('id_kecamatan', $id_kecamatan);
        return $this->db->delete('kecamatan');
    }
}

/* End of file Kecamatan_model.php */
/* Location: ./application/models/Kecamatan_model.php */
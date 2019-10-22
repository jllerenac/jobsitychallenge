<?php

class Test_model extends CI_Model {
    function testEntry($data)
    {
       $this->db->insert('josellerena.user_entry', $data);
       return $this->db->insert_id();
    }
    function lastId()
    {
        $last = $this->db->order_by('id',"desc")
		->limit(1)
		->get('josellerena.user_entry')
		->row();
        return $last->id;
    }
    function deleteId($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('josellerena.user_entry');
    }
}

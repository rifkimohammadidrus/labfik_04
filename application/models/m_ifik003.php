<?php

class M_ifik003 extends CI_Model {

	public function read_data($where,$table){
		if ($where == NULL){
			return $this->db->get($table);
		}else{
			return $this->db->get_where($table, $where);
		}
	}

	public function read_value_data($where, $table, $collumn){
		$dataTest = $this->db->get_where($table, $where)->row_array();
		return $dataTest['status'];
	}
	public function input_data($data, $table){
		 $this->db->insert($table,$data);
	}
	public function hapus_data($where, $table){
		 $this->db->where($where);
		 $this->db->delete($table);
	}
	public function edit_data($where, $table){
		 return $this->db->get_where($table, $where);
	}
	public function update_data($where, $data, $table){
		 $this->db->where($where);
		 $this->db->update($table, $data);
	}

	public function detail_data($where, $table){
		//$query = $this->db->get_where($table,  array('id' => $where))->row();
		return $this->db->get_where($table, $where);
	}
}
?>
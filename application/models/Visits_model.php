<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visits_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function update($dados){
		if(isset($dados['id']) && $dados['id'] > 0):
			// Conteúdo já existe, editar
			$this->db->where('id', $dados['id']);
			unset($dados['id']);
			$this->db->update('visits', $dados);
			return $this->db->affected_rows();
		else:
			// Não existe, salvar
			$this->db->insert('visits', $dados);
			return $this->db->insert_id();
		endif;
	}

	public function getOnline($end_date){
       $this->db->where('end_date >= ', $end_date);
	   $query = $this->db->get('visits');
	   return $query->num_rows();
	}

	public function getTotal($date){
       $this->db->where('DATE(start_date)',$date);
	   $query = $this->db->get('visits');
	   return $query->num_rows();
	}


}

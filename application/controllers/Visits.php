<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visits extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('visits_model', 'visits');
	}


	// Verifica se já existe sessão e cria uma nova ou atualiza a sessão existete
	public function index(){

		$start_date = date('Y-m-d H:i:s');
   		$end_date   = date($start_date, strtotime("-1 minutes"));

		if($this->session->userdata('visitor') != TRUE){
			$data['start_date'] = $start_date;
			$data['end_date']   = $start_date;
			if($id_session = $this->visits->update($data)){		
				$this->session->set_userdata('visitor', $id_session);
				$return['id']      = $id_session;
				$return['msg']     = 'Criar Sessao';
				$return['status']  = 0;		
			}	
		}else{
			$data['end_date'] =  $start_date;
			$data['id'] 	= $_SESSION['visitor'];
			if($id_session = $this->visits->update($data)){				
				$return['id']     = $id_session;
				$return['msg']    = 'Atualizar Sessao';
				$return['status'] = 1;
			}
		}
		echo json_encode($return);
	}


	// Retorna quantos usuários estão online e o total do dia 
	public function getVisitors(){
		$start_date = date('Y-m-d H:i:s');
		$end_date = date('Y-m-d H:i:s',strtotime('-1 minutes',strtotime($start_date)));
   		$today = date('Y-m-d ');

   		$return['current'] = $all = $this->visits->getOnline($end_date);
   		$return['total']   = $all = $this->visits->getTotal($today);
   		echo json_encode($return);

	}
		 

}

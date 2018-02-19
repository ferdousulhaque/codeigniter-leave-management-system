<?php 
class Modelcom extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_rowscount_bycondition($tablename, $conditionarray){
		$returnval = '';
		if($conditionarray !=''){
			$this->db->where($conditionarray);
		}
		$gettrue = '';
		if($tablename !=''){
			$gettrue = $this->db->from($tablename);
		}
		if($gettrue !=''){
			$returnval = $this->db->count_all_results();
		}
		return $returnval;
	}
	
	function get_onerow_allval_bycondition($tablename, $conditionarray){
		$returnval = '';
		if($conditionarray !=''){
			$this->db->where($conditionarray);
		}		
		$query = '';
		if($tablename !=''){
			$query = $this->db->get($tablename);
		}		
		if($query !=''){
			foreach ($query->result() as $row){
				$returnval = $row;
				//echo $returnval['lnaguage_id'];
			}
		}
		return $returnval;
		
	}
	function getallrow($tablename, $conditionarray){
		if($conditionarray !=''){
			$this->db->where($conditionarray);
		}
		$query = $this->db->get($tablename); 		
		if($query)
			return $query->result();
		else
			return false;
	}
	function insert_table($tablename, $insert_array){
		$dbquery = $this->db->insert($tablename, $insert_array);
		if($dbquery)
			return $this->db->insert_id();
		else
			return false;
	}
	function dropdownlist($tablename,$name,$id){
		$query = $this->db->get($tablename);
		foreach($query->result() as $row){
			$language = $row->$name;
			$lan_id=$row->$id;
			echo '<option value="'.$lan_id.'" id="'.$lan_id.'">'.$language.'</option>';
		}	
	}
	function update_table($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 

		if($dbquery)
			return true;
		else
			return false;
	}
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		$this->db->where($tableidname, $tableidvalue);
		$dbquery =$this->db->delete($tablename);
		
		if($dbquery)
			return true;
		else
			return false;
	}
	public function record_count() {
	        return $this->db->count_all('fifsfc_db');
	    }
	   
   public function encrypt($text)
	{
		return urlencode(base64_encode($text));
		//define('SECURITYKEY', 'qwerty123456');
		//return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SECURITYKEY, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}
	
	public function decrypt($text)
	{
		return base64_decode(urldecode($text));
		//base64_decode(urldecode($text))
		//define('SECURITYKEY', 'qwerty123456');
		//return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SECURITYKEY, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}
	
	public function get_list_for_approval($email){
	//$condition=array('mail_to'=> $email, 'mail_cc' => $email);
	//$rows=$this->get_rowscount_bycondition('reporting',$condition);
	//$query='';
	//	if($rows>0){
		$query = $this->db->query("SELECT * FROM leave_table WHERE leave_table.emp_id IN (SELECT emp_id FROM reporting  WHERE reporting.mail_to = '".$email."' OR reporting.mail_cc = '".$email."') AND app_status=0;");
		if($query!=0){
			//$query = $this->db->query('SELECT id, emp_id, mail_to, mail_cc FROM	hrm_system.reporting');
			//$result = $this->db->get();
			return $query;
		}
	    //}
	    //return $query;
	}
	
	public function get_tocc_for_approval($id){
		$user_cc=array(
						'emp_id' => $id
		);
		$row_count=$this->get_rowscount_bycondition('reporting',$user_cc);
		if($row_count>0){
			$get_cc=$this->get_onerow_allval_bycondition('reporting',$user_cc);
			return $get_cc;
		}
		return '';
	}
	
	public function email_purpose($email_to,$email_cc,$subject,$message){
		try{
			if($email_to!="" and $message!= "" and $subject!=""){
				//configuration for mailing
				
				$config = Array(
				'smtp_host' => 'mail.siriusbd.com',
                                'smtp_port' => 465,
                                'smtp_crypto' => 'ssl',
                                'smtp_user' => 'hr.leave@siriusbd.com',
                                'smtp_pass' => 'hrleave@321',
                                'mailtype'  => 'html',
                                'charset'   => 'iso-8859-1',
                                'protocol' => 'smtp',
								'smtp_timeout'=> 50
							);   
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				//sending properties
				$this->email->from('hr.leave@siriusbd.com', 'HRM System Administrator');
				$this->email->to($email_to);
				if ($email_cc!=""){
					$this->email->cc($email_cc);
				}
				$this->email->bcc('shahriar.rohmotullah@siriusbd.com,ferdousul.haque@siriusbd.com');
				$this->email->subject($subject);
				$this->email->message($message);
				if($this->email->send()){
					//echo $this->email->print_debugger();
				}
				else{
					show_error($this->email->print_debugger());
				}
			}
		}catch (Exception $e) {
			echo 'Caught exception: ',  $this->email->print_debugger().' '.$e->getMessage(), "\n";
		}
	}
	
	public function user_id_to_name($id){
		$user_id_con=array(
						'emp_id' => $id
		);
		$row_count=$this->get_rowscount_bycondition('emp_info',$user_id_con);
		if($row_count>0){
			$get_name=$this->get_onerow_allval_bycondition('emp_info',$user_id_con);
			return $get_name->emp_full_name;
		}
		return '';
	}
	
	public function leave_id_to_name($id1){
		$leave_id_con=array(
						'id' => $id1
		);
		$row_count=$this->get_rowscount_bycondition('leave_type',$leave_id_con);
		if($row_count>0){
			$get_name=$this->get_onerow_allval_bycondition('leave_type',$leave_id_con);
			return $get_name->leave_name;
		}
		return '';
	}
	
	public function dept_id_to_name($id1){
		$dept_id_con=array(
						'dept_id' => $id1
		);
		$row_count=$this->get_rowscount_bycondition('department',$dept_id_con);
		if($row_count>0){
			$get_dname=$this->get_onerow_allval_bycondition('department',$dept_id_con);
			return $get_dname->dept_name;
		}
		return '';
	}
	
	public function user_id_to_email($id){
		$user_id_email=array(
						'emp_id' => $id
		);
		$row_count=$this->get_rowscount_bycondition('emp_info',$user_id_email);
		if($row_count>0){
			$get_user_email=$this->get_onerow_allval_bycondition('emp_info',$user_id_email);
			return $get_user_email->emp_email;
		}
		return '';
	}
	public function fetch_detail($tablename, $limit, $start, $conditionarray) {
	    if($conditionarray !=''){
			$this->db->where($conditionarray);
			}
			$this->db->limit($limit, $start);
	        $query = $this->db->get($tablename);
	 
	    if ($query->num_rows() > 0) {
	        foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	        return false;
    }
	
	function active_check($conditionarray){
		$returnval = '';
		if($conditionarray !=''){
			$this->db->select('status');
			$this->db->where($conditionarray);
		}		
		//$query = '';
		$query = $this->db->get('user_info');	
		if($query !=''){
			foreach ($query->result() as $row){
				$returnval = $row;
			}
		}
		return $returnval;
	}
	
	
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mgt_controller extends CI_Controller {

	function __construct()
	{	parent::__construct();
		$this->load->model('modelcom');
		$this->load->library('uri');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}
	
	public function index()
	{	$data['page_right']='login_page';
		$this->load->view('front_page',$data);
	}
	
	public function chg_pro_pic()
	{	$data['status']='old';
		$data['page_right']='user_pro_pic';
		$this->load->view('main_page',$data);
	}
	
	public function chg_pass()
	{	$data['status']='old';
		$data['page_right']='user_pass_chng';
		$this->load->view('main_page',$data);
	}
	
	public function apply_leave()
	{	$data['status']='old';
		$data['page_right']='user_leave';
		$this->load->view('main_page',$data);
	}
	
	public function logout()
	{	$memberarray = array(	'user_id'   =>'',
								'user_name' =>'',
								'last_login'=>'',
								'dept_id'=>'',
								'emp_id'=>'',
								'emp_email'=>''
								);											
		$this->session->unset_userdata($memberarray);
		redirect('mgt_controller');
	}
	
	public function check_login(){
	$this->form_validation->set_rules('user_name','User Name','trim|required|min_length[5]|max_length[15]');
 	$this->form_validation->set_rules('user_pass','Password','trim|required|min_length[5]|max_length[15]');
		if($this->form_validation->run()==FALSE){
			$data['page_right']='login_page';
			$data['error_message']="User Password or name is not correct";
			$this->load->view('front_page',$data);
		}
		else{
			$user_name = $this->input->post('user_name');
			$user_password = $this->modelcom->encrypt($this->input->post('user_pass'));
			
			$condition = array( 'user_name'=>$user_name,'status'=>1);			
			$rowcount3 = $this->modelcom->get_rowscount_bycondition('user_info', $condition);
			if($rowcount3==1){
				
				$condition2 = array('user_name'   =>$user_name,
						'user_pass'=>$user_password);			
				$membersrow = $this->modelcom->get_onerow_allval_bycondition('user_info', $condition2);
				if($membersrow !=''){
					$email_condition=array('emp_id' => $user_name);
					$get_email=$this->modelcom->get_onerow_allval_bycondition('emp_info',$email_condition);
					$memberarray = array(	'user_id'   =>$membersrow->user_id,
											'user_name' =>$membersrow->user_name,
											'emp_email' =>$get_email->emp_email,
											'emp_gender'=>$get_email->emp_gender,
											'dept_id'   =>$membersrow->dept_id,
											'emp_id'    =>$membersrow->emp_id,
											'user_type' =>$membersrow->user_type,
											'last_login'=>$membersrow->last_login
											);											
					$this->session->set_userdata($memberarray);
					$update_data=array(
								'last_login'       => time()
						);
					$this->modelcom->update_table('user_info','user_name',$this->session->userdata('emp_id'), $update_data);
					redirect('mgt_controller/dashboard');
				}
				else{
					$data['error_message']='Sorry! your password is incorrect. Please type correct password.'.$rowcount;
					$data['page_right']='login_page';
					$this->load->view('front_page',$data);
				 }
 			}
 			else{
			 	$data['error_message']='Sorry! We could not found the User Name. Please check if your supervisor or HR whether it is activated or not.';
				$data['page_right']='login_page';
				$this->load->view('front_page',$data);
			}
		}
	}
	
	public function add_employee(){
		if($this->input->post('status')=='new'){
			$this->form_validation->set_rules('emp_id','Employee ID','trim|required|min_length[2]|max_length[6]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_email','Email','trim|required|valid_email|min_length[5]|max_length[100]');
			$this->form_validation->set_rules('emp_full_name','Employee Full Name','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_father_name','Employee Father Name','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_blood','Employee Blood Group','trim|required|min_length[2]|max_length[3]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_designation','Employee Designation','trim|required|min_length[2]|max_length[100]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_join_date','Employee Joining Date','trim|required|min_length[2]|max_length[100]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_dob','Employee Date of Birth','trim|required|min_length[2]|max_length[100]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_mob_no','Employee Office Mobile','trim|required|min_length[2]|max_length[15]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_mob_no_own','Employee Own Mobile','trim|required|min_length[2]|max_length[15]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_extension','Employee Extension Number','trim|required|min_length[2]|max_length[4]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_address','Employee Present Address','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_per_address','Employee Permanent Address','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('user_pass','User Password','trim|required|min_length[2]');
			//$this->form_validation->set_rules('mail_to','User Password','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
					if(!$this->session->userdata('user_id')){
						$data['page_right']='user_addedit_page';
						$data['status']='new';
						$this->load->view('front_page',$data);
					}else{
						$data['page_right']='user_addedit_page';
						$data['status']='old';
						$this->load->view('main_page',$data);
					}
				}
			else{
			$user_name_exist_condition=array('user_name'=>$this->input->post('emp_id'));
			$user_exist_rowcount=$this->modelcom->get_rowscount_bycondition('user_info',$user_name_exist_condition);
				// //new user but email still exist
				if($user_exist_rowcount>0){
					$data['error_message']='This user already exists.Please enter another user name to make a new account';
					$data['page_right']='user_addedit_page';
					$data['status']='new';
					$this->load->view('front_page',$data);
					}
				else{
					//$insert_data_reporting_info=array(
					//				'emp_id'  		=> $this->input->post('emp_id')
									//'mail_to'       => $this->input->post('mail_to'),
									//'mail_cc'       => $this->input->post('mail_cc')
					//	);
					//$last_id=$this->modelcom->insert_table('reporting', $insert_data_reporting_info);
					$insert_data_emp_info=array(
									'emp_id'  		=> $this->input->post('emp_id'),
									'emp_full_name'         => $this->input->post('emp_full_name'),
									'emp_father_name'       => $this->input->post('emp_father_name'),
									'emp_mother_name'       => $this->input->post('emp_mother_name'),
									'emp_gender'            => $this->input->post('emp_gender'),
									'emp_blood'             => $this->input->post('emp_blood'),
									'emp_designation'       => $this->input->post('emp_designation'),
									'emp_maritial_status'   => $this->input->post('emp_maritial_status'),
									'emp_join_date'         => $this->input->post('emp_join_date'),
									'emp_dob'               => $this->input->post('emp_dob'),
									'emp_mob_no'            => $this->input->post('emp_mob_no'),
									'emp_mob_no_own'        => $this->input->post('emp_mob_no_own'),
									'emp_extension'         => $this->input->post('emp_extension'),
									'emp_email'             => $this->input->post('emp_email'),
									'emp_address'           => $this->input->post('emp_address'),
									'emp_per_address'       => $this->input->post('emp_per_address'),
									'emp_profile_image'     => 'AnonymousUser.png'
						);
					$last_id=$this->modelcom->insert_table('emp_info', $insert_data_emp_info);
					$insert_data_user_info=array(
									'user_name'  			=> $this->input->post('emp_id'),
									'user_pass'       		=> $this->modelcom->encrypt($this->input->post('user_pass')),
									'dept_id'       		=> $this->input->post('department'),
									'emp_id'  				=> $this->input->post('emp_id')
						);
					$last_id=$this->modelcom->insert_table('user_info', $insert_data_user_info);
					$this->modelcom->email_purpose($this->input->post('emp_email'),'','HRM System Admin','<br/><br/>Dear '.$this->input->post('emp_full_name').',<br/><br/> Your user name <strong>'.$this->input->post('emp_id').'</strong> has been created accordingly.<bt/>Please contact with HR or supervisor to activate the account.<br/><p><a href="http://174.37.141.189/~siriusbd/hrmsystem/">Click Here to login</a><p><br/>Thanks,<br/>SIRIUS HRM System<br/>Mobile:8801730781310');
					$data['error_message']='Successfully added to the profile. Please wait for activation.';
					$data['page_right']='login_page';
					$this->load->view('front_page',$data);
				}
			 }
		}
		else{
			$this->form_validation->set_rules('emp_address','Present Address','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			$this->form_validation->set_rules('emp_per_address','Permanent Address','trim|required|min_length[2]|max_length[500]|htmlspecialchars|xss_clean');
			if ($this->form_validation->run() == FALSE)
				{
					if(!$this->session->userdata('user_id')){
						$data['page_right']='user_addedit_page';
						$data['status']='new';
						$this->load->view('front_page',$data);
					}else{
						$data['page_right']='user_addedit_page';
						$data['status']='old';
						$this->load->view('main_page',$data);
					}
				}
				else{
					$update_data=array(
										'emp_address'       => $this->input->post('emp_address'),
										'emp_per_address'       => $this->input->post('emp_per_address')	
								);
					$this->modelcom->update_table('emp_info','emp_id',$this->session->userdata('emp_id'), $update_data);
					$data['page_right']='user_view_page';
					$this->load->view('main_page',$data);
			}
		}
	}
	
	public function dashboard()
	{
		$data['page_right']='user_view_page';
		$this->load->view('main_page',$data);
	}
	
	public function user_approval()
	{
		$data['page_right']='user_approval';
		$this->load->view('main_page',$data);
	}
	
	public function user_edit()
	{
		if(!$this->session->userdata('user_id')){
			$data['page_right']='user_addedit_page';
			$data['status']='new';
			$this->load->view('front_page',$data);
		}else{
			$data['page_right']='user_addedit_page';
			$data['status']='old';
			$this->load->view('main_page',$data);
		}
	}
	
	public function change_password(){
		$user_passpre=$this->modelcom->encrypt($this->input->post('user_passprev'));
		$user_passcon=$this->modelcom->encrypt($this->input->post('user_passcon'));
		$user_pass=$this->modelcom->encrypt($this->input->post('user_pass'));
		$dept_id=$this->session->userdata('dept_id');
		$emp_id=$this->session->userdata('emp_id');
		if($user_passpre!="" and $user_passcon!="" and $user_pass!=""){
			$get_prepass_condition=array('user_name' => $emp_id);
			$get_prepass=$this->modelcom->get_onerow_allval_bycondition('user_info', $get_prepass_condition);
			if($user_passpre!=$get_prepass->user_pass){
				$data['status']='old';
				$data['error_message']="Password doesn't match the previous password";
				$data['page_right']='user_pass_chng';
				$this->load->view('main_page',$data);
			}
			else{
				if($user_passcon==$user_pass){
					$update_data=array(
										'user_pass'       => $user_pass
								);
								$this->modelcom->update_table('user_info','user_name',$this->session->userdata('emp_id'), $update_data);
					$this->modelcom->email_purpose($this->session->userdata('emp_email'),'','HRM System Admin','Dear '.$this->modelcom->user_id_to_name($this->session->userdata('emp_id')).',<br/> Your password has been changed accordingly.<br/>Thanks,<br/>SIRIUS HRM System<br/>Mobile:8801730781310');
					$data['status']='old';
					$data['error_message']="Successfully updated the password. Please loging again with the new password";
					$data['page_right']='user_pass_chng';
					$this->load->view('main_page',$data);
				}
				else{
					$data['status']='old';
					$data['error_message']="Password and Confirmation password does not match";
					$data['page_right']='user_pass_chng';
					$this->load->view('main_page',$data);
				}
			}
		}
		else{
			$data['status']='old';
			$data['error_message']="Password field can't be empty";
			$data['page_right']='user_pass_chng';
			$this->load->view('main_page',$data);
		}
	}
	
	public function submit_leave(){
		if($this->session->userdata('emp_gender')==1 and $this->input->post('leave_type')==4){
			$data['status']='old';
			$data['error_message']="Male can not apply for Maternity leave.";
			$data['page_right']='user_leave';
			$this->load->view('main_page',$data);
		}
		elseif($this->session->userdata('emp_gender')==2 and $this->input->post('leave_type')==5){
			$data['status']='old';
			$data['error_message']="Female can not apply for Paternity leave.";
			$data['page_right']='user_leave';
			$this->load->view('main_page',$data);
		}
		else{
			if($this->input->post('from_date')!="" and $this->input->post('to_date')!="" and $this->input->post('join_date')!=""){
				$now = time();
				$today = getdate();
				$join_date = strtotime($this->input->post('join_date')); // or your date as well
				$from_date = strtotime($this->input->post('from_date'));
				$to_date = strtotime($this->input->post('to_date'));
				$date_diff_to=floor(($to_date-$now)/(60*60*24));
				$date_diff_from=floor(($from_date-$now)/(60*60*24));
				$date_diff_join=floor(($join_date-$now)/(60*60*24));
				// if($date_diff_to>0 and $date_diff_from>0 and $date_diff_join>0){
					$datediff = $join_date - $from_date;
					$total_days=floor($datediff/(60*60*24));
					if($total_days>0){
						 $get_leave_total_condition=array('id' => $this->input->post('leave_type'));
						 $get_leave_total=$this->modelcom->get_onerow_allval_bycondition('leave_type', $get_leave_total_condition);
							 if($total_days<$get_leave_total->total){
								if($this->modelcom->user_id_to_name($this->session->userdata('emp_id'))!=""){
									$today = getdate();
									$submit_leave_info=array(
																'emp_id'  		=> $this->session->userdata('emp_id'),
																'leave_type'    => $this->input->post('leave_type'),
																'from_date'     => $this->input->post('from_date'),
																'to_date'       => $this->input->post('to_date'),
																'no_of_days'    => floor($datediff/(60*60*24)),
																'join_date'     => $this->input->post('join_date'),
																'sub_date'      => $today[year].'-'.$today[mon].'-'.$today[mday],
																'comment'       => $this->input->post('comment')
													);
									$last_id=$this->modelcom->insert_table('leave_table', $submit_leave_info);
									$mail_query=$this->modelcom->get_tocc_for_approval($this->session->userdata('user_name'));
									$mail_to=$mail_query->mail_to;
									$name_app=$this->modelcom->user_id_to_name($this->session->userdata('emp_id'));
									$emp_id=$this->session->userdata('emp_id');
									if($mail_query->mail_cc!=''){
										$mail_cc=$mail_query->mail_cc;
									}
									$this->modelcom->email_purpose($mail_to,$mail_cc,"HRM System Admin",'Dear Supervisor,<br/><br,/>Mr.'.$name_app.'(<strong>'.$emp_id.'</strong>) applied for leave.<br/>Please <a href="http://174.37.141.189/~siriusbd/hrmsystem/">login</a> to approve him<br/><br/>Thanks<br/>HRM System<br/><br/>By SIRIUS<br/>Mobile:8801730781310');
									$data['status']='old';
									$data['error_message']="Successfully applied for the leave.";
									$data['page_right']='user_leave';
									$this->load->view('main_page',$data);
								}
							}else{
								$data['status']='old';
								$data['error_message']="You number of days is greater than the total leave for the type".$total_days.$get_leave_total->total;
								$data['page_right']='user_leave';
								$this->load->view('main_page',$data);
							}
					}else{
						$data['status']='old';
						$data['error_message']="Numbers of days must be greater or equal 1.";
						$data['page_right']='user_leave';
						$this->load->view('main_page',$data);
					}
				// }
				// else{
					// $data['status']='old';
					// $data['error_message']="Please enter join from and to date properly".$date_diff_to.$date_diff_from.$date_diff_join;
					// $data['page_right']='user_leave';
					// $this->load->view('main_page',$data);
				// }
			}else{
				$data['status']='old';
				$data['error_message']="Please enter data properly";
				$data['page_right']='user_leave';
				$this->load->view('main_page',$data);
			}
		}
	}
	
	function user_pic_upload()
	{
		$config['upload_path'] = './images/emp_image/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']= TRUE;
		$config['file_name'] = $this->session->userdata('emp_id').'.jpg';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$data['error_message'] = $this->upload->display_errors();
			$data['status']='old';
			$data['page_right']='user_pro_pic';
			$this->load->view('main_page',$data);
			
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$update_data=array(
								'emp_profile_image'       => $this->session->userdata('emp_id').'.jpg'
						);
			$this->modelcom->update_table('emp_info','emp_id',$this->session->userdata('emp_id'), $update_data);
			$this->modelcom->email_purpose($this->session->userdata('emp_email'),'','HRM System Admin','Dear '.$this->modelcom->user_id_to_name($this->session->userdata('emp_id')).',<br/> Your profile picture has been changed accordingly.<br/>Thanks,<br/>SIRIUS HRM System<br/>Mobile:8801730781310');
			$data['page_right']='user_view_page';
			$this->load->view('main_page',$data);
		}
	}
	
	public function approve($emp_idforapproval,$row_idforapproval,$leave_type,$no_of_days){
		$update_approve=array(
				'id'       => $this->modelcom->decrypt($row_idforapproval),
				'emp_id'       => $this->modelcom->decrypt($emp_idforapproval),
		);
		$user_exist_rowcount=$this->modelcom->get_rowscount_bycondition('leave_table',$update_approve);
		if($user_exist_rowcount==1){
			//approve the leave information
			$approve_value=array('app_status' => '1', 'app_by_id' => $this->session->userdata('emp_id'));
			$this->modelcom->update_table('leave_table','id',$this->modelcom->decrypt($row_idforapproval), $approve_value);
			$leave_data=$this->modelcom->get_onerow_allval_bycondition('leave_table',$update_approve);
			//update the number of leaves for employees
			$leave_type_emp_id_condition=array('emp_id' 	=> $this->modelcom->decrypt($emp_idforapproval),
												'leave_type'=> $this->modelcom->decrypt($leave_type));
			$get_row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers',$leave_type_emp_id_condition);
			if($get_row_count>0){
				//update
				$get_id=$this->modelcom->get_onerow_allval_bycondition('leave_numbers',$leave_type_emp_id_condition);
				$update_data=array(
									'emp_leave_taken' => $get_id->emp_leave_taken+$this->modelcom->decrypt($no_of_days)
				);
				$this->modelcom->update_table('leave_numbers','id',$get_id->id, $update_data);
			}else{
				//insert
				$insert_data=array(
									'emp_id'	  => $this->modelcom->decrypt($emp_idforapproval),
									'leave_type'	  => $this->modelcom->decrypt($leave_type),
									'emp_leave_taken' => $this->modelcom->decrypt($no_of_days)
				);
				$this->modelcom->insert_table('leave_numbers', $insert_data);
			}
			//end
			$emp_approve_email=$this->modelcom->user_id_to_email($this->modelcom->decrypt($emp_idforapproval));
			$this->modelcom->email_purpose($emp_approve_email,'','HRM System Admin','Dear ,Mr.'.$this->modelcom->user_id_to_name($this->modelcom->decrypt($emp_idforapproval)).'(<strong>'.$this->modelcom->decrypt($emp_idforapproval).'</strong>),<br/><br/> Your leave has been approved by'.$this->modelcom->user_id_to_name($this->session->userdata('emp_id')).'.<br/>Please <a href="http://174.37.141.189/~siriusbd/hrmsystem/">login</a> to check for the leave report<br/><br/>Thanks<br/>HRM System<br/>By SIRIUS<br/>Mobile:8801730781310');
			$data['error_message']='Leave has been approved';
			$data['page_right']='user_approval';
			$this->load->view('main_page',$data);
		}
		
	}
	public function emp_list_view(){
		// if($condition_src==""){
			// $condition='';
		// }
		// else{
			$condition='';
		// }
		//testing pagination
		$config = array();
		$config["base_url"] = site_url('/') . "mgt_controller/emp_list_view";
		$config["total_rows"] = $this->modelcom->get_rowscount_bycondition('emp_info',$condition);
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$config["first_link"] = "First";
		//$config['full_tag_open'] = "<div class='pager' id='pager'>";
		//$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->modelcom->fetch_detail('emp_info', $config["per_page"], $page, $condition);
		$data["links"] = $this->pagination->create_links();
		$data['page_right']='user_list_page';
		$this->load->view('list_page',$data);
	}
	
	public function user_detail_view($oth_emp_id){
		$data['oth_emp_id']=$this->modelcom->decrypt($oth_emp_id);
		$data['page_right']='other_view_page';
		$this->load->view('main_page',$data);
	}
	
	public function user_active($emp_id){
		$active_id=$this->modelcom->decrypt($emp_id);
		$update_data=array(
						'status'       => 1
						);
		$this->modelcom->update_table('user_info','user_name',$active_id, $update_data);
		redirect('mgt_controller/emp_list_view');
	}
	
	public function user_inactive($emp_id){
		$inactive_id=$this->modelcom->decrypt($emp_id);
		$update_data=array(
						'status'       => 0
						);
		$this->modelcom->update_table('user_info','user_name',$inactive_id, $update_data);
		redirect('mgt_controller/emp_list_view');
	}
}
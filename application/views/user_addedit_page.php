<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		g_globalObject = new JsDatePick({
			useMode:2,
			target:"emp_dob",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		g_globalObject1 = new JsDatePick({
			useMode:2,
			target:"emp_join_date",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
	};
</script>

<h1>SIRIUS HRM system :: <?php if($status=="old"){ echo 'Edit';}else{echo 'Create';}?> Page </h1>
        <?php
				$userformattributes = array('name' => 'frmuserlogin');
				echo form_open_multipart(site_url("/").'mgt_controller/add_employee', $userformattributes);
			
				if(validation_errors()!='' || (isset($error_message) && $error_message !='')){
					echo '<div class="errorbox"><div class="errorbox32x32"></div><div class="errorboxright">';
					
					echo validation_errors();
					if((isset($error_message) && $error_message !=''))
						echo $error_message;
					echo '</div></div>';
				}
				?> 
        	<div class="userpage_column1">
                <div class="form_row"> 
				<?php 
					$dept_id=$this->session->userdata('dept_id');
					$emp_id=$this->session->userdata('emp_id');
					$condition_emp = array('emp_id'=>$emp_id);			
					$emp_get = $this->modelcom->get_onerow_allval_bycondition('emp_info', $condition_emp);
					?>
					<h3>Personal Information</h3>
				<table width="506">
					<tr>
						<th><label>Employee Full Name: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_full_name;
								}else{
									if(set_value('emp_full_name') !=''){ $user_val = set_value('emp_full_name');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_full_name',
															'id'       => 'emp_full_name',
															'tabindex' => '1',
															'value'    => $user_val,
															'maxlength'=> '100',
															'size'     => '50',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Employee Father's Name: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_father_name;
								}else{
									if(set_value('emp_father_name') !=''){ $user_val = set_value('emp_father_name');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_father_name',
															'id'       => 'emp_father_name',
															'tabindex' => '2',
															'value'    => $user_val,
															'maxlength'=> '100',
															'size'     => '50',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Employee Mother's Name: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_mother_name;
								}else{
									if(set_value('emp_mother_name') !=''){ $user_val = set_value('emp_mother_name');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_mother_name',
															'id'       => 'emp_mother_name',
															'tabindex' => '3',
															'value'    => $user_val,
															'maxlength'=> '100',
															'size'     => '50',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Gender: </label></th>
						<td><?php if($status=="old"){
									if($emp_get->emp_gender==1)
										echo "Male";
									else if($emp_get->emp_gender==2)
										echo "Female";
									else{
										echo '';
									}
								}else{?>
									<select name="emp_gender" tabindex ='3'>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
								<?php }
							  ?></td>
					</tr>
					<tr>
						<th><label>Maritial Status: </label></th>
						<td><?php if($status=="old" and $emp_get->emp_maritial_status!=0){
									$maritial=array('Single','Married','Divorced');
									echo $maritial[$emp_get->emp_maritial_status-1];
									}else{?>
									<select name="emp_maritial_status" tabindex ='4'>
										<option value="1">Single</option>
										<option value="2">Married</option>
										<option value="3">Divorced</option>
									</select>
								<?php }
							  ?></td>
					</tr>
					<tr>
						<th><label>Blood Group: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_blood;
								}else{
									if(set_value('emp_blood') !=''){ $user_val = set_value('emp_blood');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_blood',
															'id'       => 'emp_blood',
															'tabindex' => '5',
															'value'    => $user_val,
															'maxlength'=> '3',
															'size'     => '3',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					
					<tr>
						<th><label>Employee Birth Date: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_dob;
								}else{
									if(set_value('emp_dob') !=''){ $user_val = set_value('emp_dob');}
											else{ $user_val = '';} 
											$expired_date=date('Y-m-d',mktime(0,0,0,date('m')+1,date('d'),date('Y')));?>
											<input type="text" name="emp_dob" class="input-medium" tabindex ='6' style="width: 100px;" id="emp_dob" title="YYYY-MM-DD" placeholder="YYYY-MM-DD" />
								<?php }
							  ?></td>
					</tr>
					<tr>
						<th><label>Mobile No(Personal): </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_mob_no_own;
								}else{
									if(set_value('emp_mob_no_own') !=''){ $user_val = set_value('emp_mob_no_own');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_mob_no_own',
															'id'       => 'emp_mob_no_own',
															'tabindex' => '7',
															'value'    => $user_val,
															'maxlength'=> '13',
															'size'     => '13',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Present Address: </label></th>
						<td><?php if($status=="old"){
								//echo $emp_get->emp_address;
								$user_val=$emp_get->emp_address;
								}else{
									if(set_value('emp_address') !=''){ $user_val = set_value('emp_address');}
											else{ $user_val = '';}
								}
								$data = array(	'name'     => 'emp_address',
															'id'       => 'emp_address',
															'tabindex' => '8',
															'value'    => $user_val,
															'maxlength'=> '100',
															'rows'	   => '2',
															'cols'     => '35',
															'type'	   => 'text'
														);															
								echo form_textarea($data);
							  ?></td>
					</tr>
					<tr>
						<th><label>Permanent Address: </label></th>
						<td><?php if($status=="old"){
								//echo $emp_get->emp_address;
								$user_val=$emp_get->emp_per_address;
								}else{
									if(set_value('emp_per_address') !=''){ $user_val = set_value('emp_per_address');}
											else{ $user_val = '';}
								}
								$data = array(	'name'     => 'emp_per_address',
												'id'       => 'emp_per_address',
												'tabindex' => '9',
												'value'    => $user_val,
												'maxlength'=> '100',
												'rows'	   => '2',
												'cols'     => '35',
												'type'	   => 'text'
														);															
								echo form_textarea($data);
							  ?></td>
					</tr>					
				</table>
				
				<h3>Official Information</h3>
				<table width="400">
					<tr>
						<th><label>Department: </label></th>
						<td><?php if($status=="old"){
								$condition_dept = array('dept_id'=>$dept_id);			
								$dept_get = $this->modelcom->get_onerow_allval_bycondition('department', $condition_dept);
								echo $dept_get->dept_name;	
							}else{?>
							<select name="department" tabindex ='10'>
								<option value="1">Research (Qual+Quant)</option>
								<option value="2">Research (Media)</option>
								<option value="3">Analysis</option>
								<option value="4">HR</option>
								<option value="5">Project Management & International Business</option>
								<option value="6">Commertial</option>
								<option value="7">Field</option>
								<option value="8">IT</option>
								<option value="9">Admin</option>
							</select>
							<?php } ?>
					</td>
					</tr>
					<tr>
						<th><label>Employee ID: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_id;
								}else{
									if(set_value('emp_id') !=''){ $user_val = set_value('emp_id');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_id',
															'id'       => 'emp_id',
															'tabindex' => '11',
															'value'    => $user_val,
															'maxlength'=> '5',
															'size'     => '5',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Employee Designation: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_designation;
								}else{
									if(set_value('emp_designation') !=''){ $user_val = set_value('emp_designation');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_designation',
															'id'       => 'emp_designation',
															'tabindex' => '12',
															'value'    => $user_val,
															'maxlength'=> '100',
															'size'     => '50',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Employee Joining Date: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_join_date;
								}else{
									if(set_value('emp_join_date') !=''){ $user_val = set_value('emp_join_date');}
											else{ $user_val = '';} 
											$expired_date=date('Y-m-d',mktime(0,0,0,date('m')+1,date('d'),date('Y')));?>
											<input type="text" tabindex ='13' name="emp_join_date" class="input-medium" style="width: 100px;" id="emp_join_date" title="YYYY-MM-DD" placeholder="YYYY-MM-DD" />
								<?php }
							  ?></td>
					</tr>
					<tr>
						<th><label>Employee Ext Number: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_extension;
								}else{
									if(set_value('emp_extension') !=''){ $user_val = set_value('emp_extension');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_extension',
															'id'       => 'emp_extension',
															'tabindex' => '14',
															'value'    => $user_val,
															'maxlength'=> '3',
															'size'     => '3',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<tr>
						<th><label>Mobile No(Office): </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_mob_no;
								}else{
									if(set_value('emp_mob_no') !=''){ $user_val = set_value('emp_mob_no');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_mob_no',
															'id'       => 'emp_mob_no',
															'tabindex' => '15',
															'value'    => $user_val,
															'maxlength'=> '13',
															'size'     => '13',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<?php if($status!="old"){ ?>
					<tr>
						<th><label>Password: </label></th>
						<td><?php
								if(set_value('user_pass') !=''){ $user_val = set_value('user_pass');}
										else{ $user_val = '';}
										$data = array(	'name'     => 'user_pass',
														'id'       => 'user_pass',
														'tabindex' => '16',
														'value'    => $user_val,
														'maxlength'=> '15',
														'size'     => '15',
														'type'	   => 'password'
													);															
								echo form_input($data);
							  ?>
						</td>
					</tr>
					<tr>
						<th><label>Confirm Password: </label></th>
						<td><?php
							if(set_value('user_passcon') !=''){ $user_val = set_value('user_passcon');}
									else{ $user_val = '';}
									$data = array(	'name'     => 'user_passcon',
													'id'       => 'user_passcon',
													'tabindex' => '17',
													'value'    => $user_val,
													'maxlength'=> '15',
													'size'     => '15',
													'type'	   => 'password'
												);															
							echo form_input($data);
							  ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th><label>Employee Email: </label></th>
						<td><?php if($status=="old"){
								echo $emp_get->emp_email;
								}else{
									if(set_value('emp_email') !=''){ $user_val = set_value('emp_email');}
											else{ $user_val = '';}
											$data = array(	'name'     => 'emp_email',
															'id'       => 'emp_email',
															'tabindex' => '18',
															'value'    => $user_val,
															'maxlength'=> '100',
															'size'     => '50',
															'type'	   => 'text'
														);															
									echo form_input($data);
								}
							  ?></td>
					</tr>
					<!--<tr>
						<th><label>Reporting Head: </label></th>
						 <td><?php //if($status=="old"){
										// $dept_id=$this->session->userdata('dept_id');
										// $emp_id=$this->session->userdata('emp_id');
										// $condition_rep = array('emp_id'=>$dept_id.$emp_id);			
										// $rep_get = $this->modelcom->get_onerow_allval_bycondition('reporting', $condition_emp);
										// echo $rep_get->mail_to;
								// }else{
									// if(set_value('mail_to') !=''){ $user_val = set_value('mail_to');}
											// else{ $user_val = '';}
											// $data = array(	'name'     => 'mail_to',
															// 'id'       => 'mail_to',
															// 'tabindex' => '19',
															// 'value'    => $user_val,
															// 'maxlength'=> '100',
															// 'size'     => '50',
															// 'type'	   => 'text'
														// );															
									// echo form_input($data);
								// }
							  ?></td>
					</tr>
					<tr>
						<th><label>Reporting CC: </label></th>
						 <td><?php //if($status=="old"){
								// echo $rep_get->mail_cc;
								// }else{
									// if(set_value('mail_cc') !=''){ $user_val = set_value('mail_cc');}
											// else{ $user_val = '';}
											// $data = array(	'name'     => 'mail_cc',
															// 'id'       => 'mail_cc',
															// 'tabindex' => '20',
															// 'value'    => $user_val,
															// 'maxlength'=> '100',
															// 'size'     => '50',
															// 'type'	   => 'text'
														// );															
									// echo form_input($data);
								// }
							  ?></td>
					</tr>-->
				</table>
				<input type="hidden" name="status" value="<?php echo $status;?>" />
				</div>
            <div class="form_row"> 
				<input type="submit" value="Save" name="submit" tabindex ='21' class="submit_btn_02" />
            </div>
			</div>
			<?php if($status!="new"){ ?>
            <div class="right_column1">
				<a href="<?php echo site_url('/'); ?>/mgt_controller/logout"> Logout</a></br>				
				<a href="<?php echo site_url('/'); ?>/mgt_controller/dashboard"> Back to profile</a></br>
            </div>
            <?php } 
			else{?>
			<div class="right_column1">
				<a href="<?php echo site_url('/'); ?>/mgt_controller/index"> Login Page</a></br>
			</div>
			<?php } ?>
        </form>
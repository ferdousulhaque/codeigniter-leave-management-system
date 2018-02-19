<h1>SIRIUS HRM system :: User Page</h1>
        <?php
				$userformattributes = array('name' => 'frmuserlogin');
				echo form_open_multipart(site_url("/").'mgt_controller/check_login', $userformattributes);
			
				if(validation_errors()!='' || (isset($error_message) && $error_message !='')){
					echo '<div class="errorbox"><div class="errorbox32x32"></div><div class="errorboxright">';
					
					echo validation_errors();
					if((isset($error_message) && $error_message !=''))
						echo $error_message;
					echo '</div></div>';
				}
				?> 
        	<div class="userpage_column">
                <div class="form_row"> 
				<table width="410" border="1">
					<tr>
						<th><label>Name: </label></th>
						<td><?php echo $this->session->userdata('user_name'); 
						  $user_name=$this->session->userdata('user_name');
						  $dept_id=$this->session->userdata('dept_id');
						  $emp_id=$this->session->userdata('emp_id');
						?>
						</td>
					</tr>
					
					<tr>
						<th><label>Department: </label></th>
						<td><?php $condition_dept = array('dept_id'=>$dept_id);			
						$dept_get = $this->modelcom->get_onerow_allval_bycondition('department', $condition_dept);
						echo $dept_get->dept_name;			
						?>
						</td>
					</tr>
					<?php $condition_emp = array('emp_id'=>$emp_id);			
					$emp_get = $this->modelcom->get_onerow_allval_bycondition('emp_info', $condition_emp);
					?>
					<tr>
						<th><label>Employee ID: </label></th>
						<td><?php echo $emp_get->emp_id; ?></td>
					</tr>
					
					<tr>
						<th><label>Employee Full Name: </label></th>
						<td><?php echo $emp_get->emp_full_name; ?></td>
					</tr>
					<tr>
						<th><label>Employee Designation: </label></th>
						<td><?php echo $emp_get->emp_designation; ?></td>
					</tr>
					<tr>
						<th><label>Gender: </label></th>
						<td><?php 
						$gender=array('Male','Female');
						echo $gender[$emp_get->emp_gender-1]; ?></td>
					</tr>
					<tr>
						<th><label>Blood Group: </label></th>
						<td><?php echo $emp_get->emp_blood; ?></td>
					</tr>
					<tr>
						<th><label>Employee Joining Date: </label></th>
						<td><?php echo $emp_get->emp_join_date; ?></td>
					</tr>
					<tr>
						<th><label>Employee Date of Birth: </label></th>
						<td><?php echo $emp_get->emp_dob; ?></td>
					</tr>
					<tr>
						<th><label>Employee Mobile Number: </label></th>
						<td><?php echo $emp_get->emp_mob_no; ?></td>
					</tr>
					<tr>
						<th><label>Employee Ext Number: </label></th>
						<td><?php echo $emp_get->emp_extension; ?></td>
					</tr>
					<tr>
						<th><label>Employee Email: </label></th>
						<td><?php echo $emp_get->emp_email; ?></td>
					</tr>
					<tr>
						<th><label>Employee Address: </label></th>
						<td><?php echo $emp_get->emp_address; ?></td>
					</tr>					
				</table>
				</div>
            <div class="form_row"> 
            </div>
			</div>
			
            <div class="right_column">
	                <img src="<?php if($emp_get->emp_profile_image!=""){
																			echo base_url().'images/emp_image/'.$emp_get->emp_profile_image;}
																		else{
																			echo base_url().'images/emp_image/AnonymousUser.png';
																		}?>" height="150" width="150" /><br/>
                <a href="<?php echo site_url('/'); ?>mgt_controller/logout"> Logout</a></br>
				<a href="<?php echo site_url('/'); ?>mgt_controller/chg_pass"> Change password</a></br>
				<a href="<?php echo site_url('/'); ?>mgt_controller/user_edit"> Change information</a></br>
				<a href="<?php echo site_url('/'); ?>mgt_controller/chg_pro_pic"> Change profile picture</a>
            </div>
            
        </form>
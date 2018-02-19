<h1>SIRIUS HRM system :: User Page</h1>
        <?php
				$userformattributes = array('name' => 'frmuserlogin');
				echo form_open_multipart(site_url("/").'mgt_controller/index', $userformattributes);
			
				if(validation_errors()!='' || (isset($error_message) && $error_message !='')){
					echo '<div class="errorbox"><div class="errorbox32x32"></div><div class="errorboxright">';
					
					echo validation_errors();
					if((isset($error_message) && $error_message !=''))
						echo $error_message;
					echo '</div></div>';
				}
				
				$dept_id=$this->session->userdata('dept_id');
			    $emp_id=$this->session->userdata('emp_id');
				$condition_emp = array('emp_id'=>$emp_id);			
				$emp_get = $this->modelcom->get_onerow_allval_bycondition('emp_info', $condition_emp);
				?> 
        	<div class="userpage_column">
				<table width="570" border="1">
					<tr>
						<td><strong>Employee Name</strong></td>
						<td><strong>Leave Type</strong></td>
						<td><strong>From Date</strong></td>
						<td><strong>To Date </strong></td>
						<td><strong>Join Date </strong></td>
						<td><strong>Comment </strong></td>
						<td><strong>Status </strong></td>
					</tr>
					
					<tr>
						<?php $data=$this->modelcom->get_list_for_approval($emp_get->emp_email);
						foreach ($data->result() as $row){
							echo '<td>'.$this->modelcom->user_id_to_name($row->emp_id).'</td>';
							echo '<td>'.$this->modelcom->leave_id_to_name($row->leave_type).'</td>';
							echo '<td>'.$row->from_date.'</td>';
							echo '<td>'.$row->to_date.'</td>';
							echo '<td>'.$row->join_date.'</td>';
							echo '<td>'.$row->comment.'</td>';
							if($row->app_status!=1){ echo '<td>'.'<a href="'.site_url('/').'mgt_controller/approve/'.$this->modelcom->encrypt($row->emp_id).'/'.$this->modelcom->encrypt($row->id).'/'.$this->modelcom->encrypt($row->leave_type).'/'.$this->modelcom->encrypt($row->no_of_days).'">Waiting</a>'.'</td>';}
							else{ echo '<td>'.'Approved'.'</td>';}
						}
						?>
					</tr>
				</table>
            <div class="form_row"> 
            </div>
			</div> 
        </form>
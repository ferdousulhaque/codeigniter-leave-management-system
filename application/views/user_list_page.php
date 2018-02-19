<h1>SIRIUS HRM system :: Employee List</h1>
        <?php
				$userformattributes = array('name' => 'frmuserlogin');
				echo form_open_multipart('#', $userformattributes);
			
				if(validation_errors()!='' || (isset($error_message) && $error_message !='')){
					echo '<div class="errorbox"><div class="errorbox32x32"></div><div class="errorboxright">';
					
					echo validation_errors();
					if((isset($error_message) && $error_message !=''))
						echo $error_message;
					echo '</div></div>';
				}
				
			    $emp_id=$this->session->userdata('emp_id');
				$condition_emp = array('emp_id'=>$emp_id);			
				$emp_get = $this->modelcom->get_onerow_allval_bycondition('emp_info', $condition_emp);
				?> 
        	<div class="userpage_column">
				<table border="1" align="center">
					<tr>
						<td width="200"><strong>Employee Name</strong></td>
						<td width="15"><strong>ID</strong></td>
						<td><strong>Designation</strong></td>
						<td><strong>Email</strong></td>
						<td><strong>Mobile 1</strong></td>
						<td><strong>Mobile 2</strong></td>
						<td><strong>Ext</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>View</strong></td>
					</tr>
					
					<tr>
						<?php 
							if($results>0){
								foreach($results as $data) { 
								$emp_id=$data->emp_id;
							?>
                                <tr>
									<td><?php echo $data->emp_full_name; ?></td>
									<td><?php echo $data->emp_id; ?></td>
									<td><?php echo $data->emp_designation; ?></td>
									<td><?php echo $data->emp_email; ?></td>
									<td><?php echo $data->emp_mob_no; ?></td>
									<td><?php echo $data->emp_mob_no_own; ?></td>
									<td><?php echo $data->emp_extension; ?></td>
									<td>
									<?php
										 $condition=array('user_name' => $emp_id);
										 $row=$this->modelcom->active_check($condition);
											 foreach($row as $active){
												 if($active==1){
													if($this->session->userdata('user_type')==1){
														echo '<a href="'.site_url('/').'mgt_controller/user_active/'.$this->modelcom->encrypt($emp_id).'">Active</a>';
													}else{
														echo "Active";
													}
												 }
												 elseif($active==0){
													 if($this->session->userdata('user_type')==1){
														echo '<a href="'.site_url('/').'mgt_controller/user_inactive/'.$this->modelcom->encrypt($emp_id).'">Inactive</a>';
													}else{
														echo "Inactive";
													}
												 }
											 }
									?>
                                    </td>
									<td><a href="<?php echo site_url('/').'mgt_controller/user_detail_view/'.$this->modelcom->encrypt($emp_id); ?>"><strong>View Detail</a></strong></td>
                                </tr>
							<?php 
								}
							}?> 
					</tr>
				</table>
            <div class="form_row"> 
            </div>
			</div> 
        </form>
		<p><?php echo $links; ?></p>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIRIUS Leave management System</title>
<meta name="keywords" content="Leave management process of SIRIUS" />
<meta name="description" content="Leave management process of SIRIUS" />
<link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>/css/gallery_style.css" rel="stylesheet" type="text/css"  />
</head>
<body>
<?php 

?>
<div id="container">
<div id="top_panel">
	<div id="header_section">
		<div id="header">
        	<img src="<?php echo base_url(); ?>/images/sirius_logo.jpg" />
        </div>
    </div> <!-- end of header section -->
    
    <div id="menu_login_section">
    	<div id="menu_section">
        	<div id="menu_panel">
                <ul>
                    <li><a href="<?php echo site_url('/'); ?>mgt_controller/dashboard" class="current">Home</a></li>
                    <li><a href="#">News</a></li>                 
                </ul> 
            </div> <!-- end of menu -->
        </div>
    </div> <!-- end of menu login section -->
</div> <!-- end of top panel -->
<div id="content_panel_1">

	<div id="news_section">
    	<h1>Leave Statistics</h1>
        <div class="news_box">
			<p><table>
			<tr><th>Privilage Leave:</th> 
					<td>20 Days</td>
					<td>Left: <?php 
						$emp_id=$this->session->userdata('emp_id');
						$condition_leave_total = array('id' => '1');			
						$emp_leave_total = $this->modelcom->get_onerow_allval_bycondition('leave_type', $condition_leave_total);
						$condition_leave_taken = array('emp_id'=>$emp_id,'leave_type' => '1');			
						$row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers', $condition_leave_taken);
						if($row_count>0){
							$emp_leave_taken = $this->modelcom->get_onerow_allval_bycondition('leave_numbers', $condition_leave_taken);
							$remain=$emp_leave_total->total-$emp_leave_taken->emp_leave_taken;
							echo $remain;
						}
						else{
							echo $emp_leave_total->total;
						}
					?> Days</td>
			</tr>
			<tr><th>Casual Leave:</th> 
					<td>10 Days</td>
					<td>Left: <?php $remain=0;
						$emp_id=$this->session->userdata('emp_id');
						$condition_leave_total = array('id' => '3');			
						$emp_leave_total = $this->modelcom->get_onerow_allval_bycondition('leave_type', $condition_leave_total);
						$condition_leave_taken = array('emp_id'=>$emp_id,'leave_type' => '3');			
						$row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers', $condition_leave_taken);
						if($row_count>0){
							$emp_leave_taken = $this->modelcom->get_onerow_allval_bycondition('leave_numbers', $condition_leave_taken);
							$remain=$emp_leave_total->total-$emp_leave_taken->emp_leave_taken;
							echo $remain;
						}
						else{
							echo $emp_leave_total->total;
						}
					?> Days</td>
			</tr>
			<tr><th>Sick Leave:</th> 
					<td>14 Days</td>
					<td>Left: <?php $remain=0;
						$emp_id=$this->session->userdata('emp_id');
						$condition_leave_total = array('id' => '2');			
						$emp_leave_total = $this->modelcom->get_onerow_allval_bycondition('leave_type', $condition_leave_total);
						$condition_leave_taken = array('emp_id'=>$emp_id,'leave_type' => '2');			
						$row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers', $condition_leave_taken);
						if($row_count>0){
							$emp_leave_taken = $this->modelcom->get_onerow_allval_bycondition('leave_numbers', $condition_leave_taken);
							$remain=$emp_leave_total->total-$emp_leave_taken->emp_leave_taken;
							echo $remain;
						}
						else{
							echo $emp_leave_total->total;
						}
					?> Days</td>
			</tr>
			<?php
				if($this->session->userdata('emp_gender')==2){
			?><tr><th>Maternal Leave:</th> 
					<td>120 Days</td>
					<td>Left: <?php $remain=0;
						$dept_id=$this->session->userdata('dept_id');
						$emp_id=$this->session->userdata('emp_id');
						$condition_leave_total = array('id' => '4');			
						$emp_leave_total = $this->modelcom->get_onerow_allval_bycondition('leave_type', $condition_leave_total);
						$condition_leave_taken = array('emp_id'=>$emp_id,'leave_type' => '4');			
						$row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers', $condition_leave_taken);
						if($row_count>0){
							$emp_leave_taken = $this->modelcom->get_onerow_allval_bycondition('leave_numbers', $condition_leave_taken);
							$remain=$emp_leave_total->total-$emp_leave_taken->emp_leave_taken;
							echo $remain;
						}
						else{
							echo $emp_leave_total->total;
						}
					?> Days</td>
			</tr>
			<?php }else{?>
			<tr><th>Paternal Leave:</th> 
					<td>5 Days</td>
					<td>Left: <?php $remain=0;
						$dept_id=$this->session->userdata('dept_id');
						$emp_id=$this->session->userdata('emp_id');
						$condition_leave_total = array('id' => '5');			
						$emp_leave_total = $this->modelcom->get_onerow_allval_bycondition('leave_type', $condition_leave_total);
						$condition_leave_taken = array('emp_id'=>$emp_id,'leave_type' => '5');			
						$row_count=$this->modelcom->get_rowscount_bycondition('leave_numbers', $condition_leave_taken);
						if($row_count>0){
							$emp_leave_taken = $this->modelcom->get_onerow_allval_bycondition('leave_numbers', $condition_leave_taken);
							$remain=$emp_leave_total->total-$emp_leave_taken->emp_leave_taken;
							echo $remain;
						}
						else{
							echo $emp_leave_total->total;
						}
					?> Days</td>
			</tr>
			<?php } ?>
			</table>
			Leave apply will be here in a few weeks</p>
			<div style='float:right;'><a href="<?php echo site_url('/'); ?>mgt_controller/apply_leave">Apply For Leave</a></div>
			<?php if ($this->session->userdata('user_type')=="1" or $this->session->userdata('user_type')=="2"){ ?> <div style='float:left;'><a href="<?php echo site_url('/'); ?>mgt_controller/user_approval">List for approval</a></div><?php }else {echo '';}  ?><br/>
			<div style='float:left;'><a href="<?php echo site_url('/'); ?>mgt_controller/emp_list_view">Employee List</a></div>
		</div>
    </div><!-- end of news section -->
    
    <div id="section_1_1">
    	<?php 
		if(!$this->session->userdata('user_id')){
			echo "Please login first then try use it. No offence. <a href='".site_url('/')."mgt_controller/index' >Login Here</a>";
		}
		else{
			$this->load->view($page_right); 
		}?>
    </div><!-- end of section 1 -->
    <div class="cleaner_with_height">&nbsp;</div>
</div>
<div id="content_panel_3">

	<div class="quick_contact">
    	<h1>HR Contact</h1>
        <p>
            Mr. Shahriar Rohmotullah<br />
			Tel: 880-1730-781-310<br />
            Email: <a href="#">shahriar.rohmotullah@siriusbd.com</a>
        </p>
    </div><!-- end of news section 3-->    
<div class="cleaner_with_height">&nbsp;</div>
</div><!-- end of content panel 3 -->

<div id="footer_panel">
    Copyright © 2013 <a href="#">SIRIUS Marketing and Social Research Ltd.</a></div>
</div> <!-- end of container -->
<div align=center>Designed, developed and maintained by Analysis Department </div>
</body>
</html>

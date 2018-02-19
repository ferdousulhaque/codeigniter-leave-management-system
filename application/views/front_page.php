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
                    <li><a href="#" class="current">Home</a></li>
                    <li><a href="#">News</a></li>                 
                </ul> 
            </div> <!-- end of menu -->
        </div>
    </div> <!-- end of menu login section -->
</div> <!-- end of top panel -->
<div id="content_panel_1">

	<div id="news_section">
    	<h1>News Bulletin</h1>
        <div class="news_box">
        	<h3>Started Leave Management System</h3>
            <p>SIRIUS Leave management system is goind to be launched in a few months. Stay Tuned.</p>
      </div>
    </div><!-- end of news section -->
    
    <div id="section_1_1">
    	<?php $this->load->view($page_right);?>
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

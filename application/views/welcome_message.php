<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">`

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		 background-image: url('images/bg2.jpg');
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	.heading_image{
		background-image: url('images/title.png');
	}
	</style>
</head>
<body>

<div class="container">
  <br />
  <span class="heading_image" align="center"></span>
  <br />
  <div class="panel panel-default">
   <div class="panel-heading">ENTER TASK </div>
   <div class="panel-body">
    <form method="post" id="task_form"action="#">
     <div class="form-group">
      <label>Task Name</label>
      <input type="text" name="task_name" class="form-control" value="" required />
      <span class="text-danger"></span>
     </div>
     <div class="form-group">
      <label>Task Date</label>
      <input type="date" name="task_date" class="form-control" value="" required />
      <span class="text-danger"></span>
     </div>
     <div class="form-group">
      <label>Task Description</label>
      <input type="password" name="task_detail" class="form-control" value="" required />
      <span class="text-danger"></span>
     </div>
     <div class="form-group">
      <input type="submit" id="save_task" value="Save" class="btn btn-info" />
     </div>
    </form>
   </div>
  </div>
 </div>

</body>
</html>

<script>
$("#save_task").on('click',function(){
$.ajax({
								url:'<?php echo base_url();?>index.php/homepage/save_task',
								method:"POST",
								data:$("#task_form").serialize(),
								success:function(data){
									data=JSON.parse(data);
									
								}
							})


});



</script>
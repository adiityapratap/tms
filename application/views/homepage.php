<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TMS</title>
  <script type = "text/javascript">
    var base_url = '<?php echo base_url() ?>';
</script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script src="<?php echo base_url('js/main.js'); ?>" type="text/javascript"></script>
	<link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>

<div class="container">
  <br />
  <span class="heading_image" align="center"></span>
  <br />
  <div class="panel panel-default main_form_div" >
  
   <div class="panel-body">
    <form method="post" id="task_form" action="#">
      <div class="inner_form_container">
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
      <textarea cols="22" rows="1" name="task_detail"></textarea>
      <span class="text-danger"></span>
     </div>
    </div>
       <input type="hidden" id="task_id" name="task_id" value="" />
      <input type="button" id="save_task" value="Save" class="btn btn-info" />
    </form>
   </div>
  </div>

  <div id="task_list">
    
  </div>
 </div>

</body>
</html>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>TMS</title>

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
  .task_listing {
    background-color: white;
  }

  .close {
    border-radius: 30px;
    color: white;
    cursor: pointer;
    position: absolute;
    /* top: 57%; */
    right: 0%;
    padding: 8px 12px;
    transform: translate(0%, -50%);
    font-size: 18px;
    background-color: black;
}

.close:hover {background: #bbb;}
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
    <form method="post" id="task_form" action="#">
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
      <textarea cols="20" rows="10" name="task_detail"></textarea>
      <span class="text-danger"></span>
     </div>
     <div class="form-group">
       <input type="hidden" id="task_id" name="task_id" value="" />
      <input type="button" id="save_task" value="Save" class="btn btn-info" />
      <input type="button" onclick="viewtask()" value="View" class="btn btn-info" />
     </div>
    </form>
   </div>
  </div>

  <div id="task_list">
    
  </div>
 </div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
$("#save_task").on('click',function(){
           
          
            if( localStorage["id"]==undefined ){
             var task_id = 1;
            } else{
              var task_id = parseFloat(localStorage.getItem("id")) + parseFloat(1);
            }
            $("#task_id").val(task_id);
            var post_vars = $('#task_form').serialize();
            localStorage.setItem('id',task_id);
            localStorage.setItem(task_id,post_vars);
           

            $.ajax({
                url:'<?php echo base_url();?>index.php/homepage/save_task',
                method:"POST",
                data:$("#task_form").serialize(),
                success:function(data){
                  data=JSON.parse(data);
                  
                }
              })


    $("#task_list").html('');
    $all_tasks = allStorage();
    $.each( $all_tasks, function( key, value ) {
      var input = deserialize(value);
     $("#task_list").append('<div class="task_listing" id="'+input.task_id+'"><b>'+input.task_name+'</b><p>'+input.task_date+'</p><p>'+input.task_detail+'</p> <span class="close" onclick="delete_task('+input.task_id+')">x</span><div>');
   
     });
 

});

function viewtask(){
  $("#task_list").html('');
    $all_tasks = allStorage();
    $.each( $all_tasks, function( key, value ) {
      var input = deserialize(value);
     $("#task_list").append('<div class="task_listing" id="'+input.task_id+'"><b>'+input.task_name+'</b><p>'+input.task_date+'</p><p>'+input.task_detail+'</p> <span class="close" onclick="delete_task('+input.task_id+')">x</span> <div>');
   
     });
}

$(function(){
   viewtask();
});

function allStorage() {

        var values = [],
        keys = Object.keys(localStorage),
        i = keys.length;

    while ( i-- ) {
      if (localStorage.getItem(keys[i]).length > 2) {
        values.push(localStorage.getItem(keys[i]) );
      }
        
    }

    return values;
}

function delete_task(task_id){
  console.log(task_id);
localStorage.removeItem(task_id);
viewtask();
}

function deserialize(txt){
    myjson={}
    tabparams= txt.split('&')
    var i=-1;
    while (tabparams[++i]){
    tabitems=tabparams[i].split('=')
    if( myjson[decodeURIComponent(tabitems[0])] !== undefined ){
        if( myjson[decodeURIComponent(tabitems[0])] instanceof Array ){
            myjson[decodeURIComponent(tabitems[0])].push(decodeURIComponent(tabitems[1]))
        }
    else{
       myjson[decodeURIComponent(tabitems[0])]= [myjson[decodeURIComponent(tabitems[0])],decodeURIComponent(tabitems[1])]
            }
        }
    else{
         myjson[decodeURIComponent(tabitems[0])]=decodeURIComponent(tabitems[1]);
        }
    }
    return myjson;
    }


</script>
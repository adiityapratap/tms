$(document).ready(function(){
$("#save_task").on('click',function(){
           
          console.log("cliked");
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
                url: base_url + 'index.php/homepage/save_task',
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
     $("#task_list").append('<div class="task_listing" id="'+input.task_id+'"><span class="close" onclick="delete_task('+input.task_id+')">x</span><div class="inner_content"><b>'+input.task_name+'</b><p>'+input.task_date+'</p><p>'+input.task_detail+'</p> </div></div>');
   
     });
 

});

})
function viewtask(){
  $("#task_list").html('');
    $all_tasks = allStorage();
    $.each( $all_tasks, function( key, value ) {
      var input = deserialize(value);
     $("#task_list").append('<div class="task_listing" id="'+input.task_id+'"><span class="close" onclick="delete_task('+input.task_id+')">x</span><div class="inner_content"><p>'+input.task_date+'</p><b>'+input.task_name+'</b><p>'+input.task_detail+'</p> </div> </div>');
   
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

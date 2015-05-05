
<script type="text/javascript">

$(document).ready(function(){
      
      //$("form.search_student_form").find("input,select").val(''); 
      $.each($("form.search_student_form").find("input,select"),function(){
          
          if($(this).attr("name")!="ref" && $(this).attr("name")!="ref_id"){
              
              $(this).val('');
          }
      });  
    
});

</script>

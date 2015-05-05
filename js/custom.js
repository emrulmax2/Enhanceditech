$(function() {



//datatable

    $('.dTable').dataTable({

        "bJQueryUI": true,

        "sPaginationType": "full_numbers",

        "sDom": '<""l>t<"F"fp>',

        //"sScrollXInner": "110%",



//          "sScrollX": "100%",

 //         "sScrollXInner": "110%",

 //         "bScrollCollapse": true,

          "fnDrawCallback":function(){

            recallRemove();

          },

          "iDisplayLength": 10,

          "aLengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]          

    });

    

// start tinymce

$('textarea.tinymce').tinymce({

                       // theme : "modern",

                        

                        // Theme options
                    /*
                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",

                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",

                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

                        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",

                        theme_advanced_toolbar_location : "top",

                        theme_advanced_toolbar_align : "left",

                        theme_advanced_statusbar_location : "bottom",

                        theme_advanced_resizing : true,

                          */
//debug developement

 selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]

                        

                });

   





//end of tiny mce editor

    

//datepicker

    $('.date').datepicker({ dateFormat: "dd-mm-yy" });

    $('.time').timepicker({ 'timeFormat': 'h:i:s a' });
    
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();

     $( ".employment-date" ).datepicker({

		 dateFormat:'mm/yy',

		 changeMonth: true,

		 changeYear: true

		}); 

	 $( ".birth-date" ).datepicker({

		 dateFormat:'dd/mm/yy',

		 changeMonth: true,

		 changeYear: true,
         yearRange: "-75:+0"

		});

// Carousel    

	$('.carousel').carousel({ interval: 4000 }); 

	



// mouse wheel work on left hover

$('#emulated').bind('mousewheel', function(event) {

          event.preventDefault();

          var scrollTop = this.scrollTop;

          this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));

          //console.log(event.deltaY, event.deltaFactor, event.originalEvent.deltaMode, event.originalEvent.wheelDelta);

        });

//

//// User form submit

$("#userProfileform").submit(function(e){

    

    var repassword = $(".repassword").val();

    var password = $(".password").val();

    

    if(password != repassword && password!="" ){

        $(".retypepassword").fadeIn(5000); 

        e.preventDefault();

      $(".retypepassword").html("Password missmatch");

      $(".retypepassword").addClass("alert alert-warning");  

      $(".retypepassword").fadeOut(5000);  

    } else {
      $("#update_student_info").modal("toggle"); e.preventDefault();

    }

});
//// User generateDates form submit

$("#generateDates").submit(function(e){

    var inputdate = new Array();    
     $(".date-list").each(function() {
            if($(this).is(":checked"))
            inputdate.push($(this).val());

    });
    
    if(inputdate.length == 0 ) {
        e.preventDefault();
        $('#myErorrStatus').modal('toggle');               
        
    } else { 
        $("#generateDates").submit();
    }
     
});

///////////////---------- search panel collapse and expand

$('form.search_student_form div.panel-heading h4').css("cursor","pointer").css("z-index","998");
$('form.search_student_form div.panel-heading').find('button:submit,button:reset,a').css("z-index","999");

$('form.search_student_form div.panel-heading h4').click(function(){
	$('form.search_student_form div.panel-heading').find("button:submit,button:reset,a").toggle();
	$('form.search_student_form div.panel-body').slideToggle('slow');
	
});


///////////////----------- end of search panel collapse and expand



//// Agent form submit

$("#agentaddform").submit(function(e){

    

    var repassword = $(".repassword").val();

    var password = $(".password").val();

    

    if(password != repassword && password!="" ){

        e.preventDefault();

      $(".retypepassword").fadeIn(1000); 

      $(".retypepassword").html("Password missmatch");

      $(".retypepassword").addClass("alert alert-warning");  

      $(".retypepassword").fadeOut(5000);  

    }

});

///agent to submit



$("input[name=student_address_address_line_1]" ).keypress(function( event ) {

if ( event.key == "Enter" ) {

 $(".address-details").slideDown();

}

});

$("input[name=student_address_address_line_1]" ).blur(function(){

 $(".address-details").slideDown();	

	

});



$('select[name=inbox_action]').change(function(){

   var got =0 ; 

   $(".loading").fadeIn(); 

  // 

    //$('form').find('input')

    

    $.each($('tr').find("input:checkbox"), function() {

        

        if($(this).is(":checked")){

            got = 1;

           $("#inbox_set").submit();

        } 

        

        

    });

    if(got == 0){

    $('#myInbox').modal('toggle');

            $(".loading").fadeOut(); 

    }           

    //window.location.reload();
    

});

$('button[name=delete]').click(function(){

       var got =0 ; 

   $(".loading").fadeIn();

        $.each($('tr').find("input:checkbox"), function() {

        

        if($(this).is(":checked")){

            got = 1;

           $("#inbox_set").submit();

        } 

        

        

    });

    if(got == 0){

    $('#myInbox').modal('toggle');

            $(".loading").fadeOut(); 

    }    

});



$('button[name=changestatusbutton]').click(function(){



    $('#myApplicationStatus').modal('toggle');

       

});



// start form change state update 

$('button[name=changebuttonstate]').click(function(){

    

    var changeState = $("#changestatus").val();
    //alert(changeState); return false;

    var id = $("input[name=ref_id]").val();


    var staffid = $("select[name=student_admission_status_review_staff_id]").val();
    var student_status_admission_hesa_reason_id = $("select[name=student_status_admission_hesa_reason_id]").val();


    var rej_reason = $("select[name=student_admission_status_rejected_reason]").val();

    
    if(changeState=="Offer accepted"){

		
	    var formdata = $('#registerglobalinfo, #registerinfo').serialize();
	    formdata = "action=submitRegisterPersonal&"+formdata;

      // var student_type = $("select[name=student_type]").val();

      // if(student_type == "")
      // {
      //   alert("Please Select Student Type!");
      //   return false;
      // }

      var student_type = $("select[name=student_type]").val();

      if(student_type == "")
      {
        $(".msg").html("<i class='fa fa-warning'></i> Please Select Student Type."); 
        $("#check_student_type").css({
          color: 'red',
          border: '1px solid red'
        }).text("Please Select Student Type.")
        $(".msg").fadeIn();
        if($(".msg").hasClass('alert-success'))

        $(".msg").removeClass("alert alert-success");

        $(".msg").addClass("alert alert-warning"); 
        $(".msg").fadeOut(3000);
        return false;
      }

        url = getURL()+'/index.php/ajaxall/';
         $(".loading").fadeIn();

	    $.ajax({
	      url: url,
	      data : formdata,
	      type : "POST",
	      success: function(result){
            //alert(result);
	      	  $(".loading").fadeOut();
              //alert('ekane 1');
	      	  

	      }
	    });		
		
		
    }else if(changeState=="Accepted"){
		
		
        url = getURL()+'/index.php/ajaxall/';
         $(".loading").fadeIn();

	    $.ajax({
	      url: url,
	      data : {action:"checkAndRemoveFromRegisterIfExist",id: id},
	      type : "POST",
	      success: function(data){
	      	  $(".loading").fadeOut();
              //alert(data);
	      	//$(".msg").html(data);    
             //alert('ekane 2');
	      }
	    });		
		
    }
    


        $(".loading").fadeIn();
        url = getURL()+'/index.php/ajaxall/';


        $.ajax({
          url: url,
          data : {action: 'changestate', change_state: changeState, id: id, staffid: staffid, rej_reason: rej_reason, student_status_admission_hesa_reason_id:student_status_admission_hesa_reason_id },
          type : "POST",
          success: function(data){

              
                    if(data=="") {

                                   

                          $(".msg").html("<i class='fa fa-warning'></i> Status can't change. Please refresh your application."); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                    
                        //alert("eknake 3");
                          

                          // $(".msg").html(data); 

                           $(".msg").html("<i class='fa fa-warning'></i> Status changed. Please click to close");
                           $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ 
                               $(".msg").fadeOut(1000 ,function(){  
                                       location.reload(); 
                              });
                           });

                    }              
              
              
              
          }
        });


    

/*    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';

    $.post(url, {action: 'changestate', change_state: changeState, id: id, staffid: staffid, rej_reason: rej_reason, student_admission_status_hesa_reason_id:student_admission_status_hesa_reason_id },

                function(data){

                    if(data=="") {

					               

                          $(".msg").html("<i class='fa fa-warning'></i> Status can't change. Please refresh your application."); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

					
                        alert("eknake 3");
                          

                          //$(".msg").html(data); 

                           $(".msg").html("<i class='fa fa-warning'></i> Status changed. Please click to close");
                           $(".msg").fadeIn();

                          // if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ 
                               $(".msg").fadeOut(1000 ,function(){  
                           	        location.reload(); 
                              });
                           });

                    }

                } );*/


});



// Billal

/*$(".induction-panel").hide();

$(".common-job-list").on('click', function() {

  $(this).addClass('active');
  if($(".induction-job-list").hasClass('active')) {
    $(".induction-job-list").removeClass('active');
  }

  $(".induction-panel").hide();
  $(".common-panel").fadeIn();
  
});
$(".induction-job-list").on('click', function() {

  $(this).addClass('active');
  if($(".common-job-list").hasClass('active')) {
    $(".common-job-list").removeClass('active');
  }

  $(".common-panel").hide();
  $(".induction-panel").fadeIn();
  
});*/

$('button[name=apply_job]').click(function(){


    var job_id = $("input[name=jobs]:checked").val();
    var issued_date = $("div.job_selected_show input:checked").val();
    var price = parseFloat($("#total_cost").text());
    var files = [];
    $.each($("div.file-list-group a"), function(index, val) {
       files.push($(this).attr("href"));
    });
    
    //alert(files); return false;

    $(".loading").fadeIn();
    
    if(price>0){
     
        $('#user_document').modal("show");   
        
    }else{

            url =getURL()+'/index.php/ajaxall/';

            $.post(url, {action: 'apply_job', job_id: job_id, issued_date: issued_date, price:price, files:files  },

            function(data){

                if(data=="") {
                      $(".loading").fadeOut();
                      $(".msg").html("<p class='alert alert-warning'>Application can't be sent. Try again Later.</p>"); 
                      $(".msg").fadeIn();
                      //$(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(4000);}); 
                } else {
                      $(".loading").fadeOut();
                      //$(".msg").html(data);
                      $(".msg").html("<p class='alert alert-success'>Your application has been sent!.</p>");
                      $(".msg").fadeIn();
                      $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(4000);}); 
                }

            } );
    }


});



$('button[name=awarding_body_ref_submit]').click(function(){

    var student_id = $("input[name=ref_id]").val();
    var awarding_body = $("input[name=awarding_body]").val();

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';

    $.post(url, {action: 'update_awarding_body_ref', student_id: student_id, awarding_body: awarding_body },

    function(data){

        if(data=="") {

              $(".msg").html("<p class='alert alert-warning'>Awarding body ref can't update. Try again.</p>"); 

        } else {

              $(".msg").html("<p class='alert alert-success'>Awarding body ref updated successfully.</p>");

        }

    } );


});

$('button[name=update_student_info]').click(function(){

  

    var student_id = $("input[name=student_id]").val();
    var cnfpassword = $("input[name=cnfpassword]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();
    //alert(password);
    

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';

    $.post(url, {action: 'update_std_info', student_id: student_id, cnfpassword: cnfpassword, email: email, password:password },

                function(data){

                    if(data=="") {

                          

                          $(".msg").html("<i class='fa fa-warning'></i> Profile can't update. Try again."); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                        

                          $(".msg").fadeIn();
                          $(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Profile updated successfully. Please click to close");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});


$('button[name=change_student_status]').click(function(){

    

    var changeState = $("#changestatus").val();

    var id = $("input[name=ref_id]").val();
    var student_status_hesa_reason_id = $("select[name=student_status_hesa_reason_id]").val();
    var status_change_reason = $("input[name=status_change_reason]").val();
    
    

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';

    $.post(url, {action: 'change_student_status', change_state: changeState, id: id, student_status_hesa_reason_id:student_status_hesa_reason_id, status_change_reason:status_change_reason },

                function(data){

                    if(data=="") {

          

                          $(".msg").html("<i class='fa fa-warning'></i> Status can't change. Please refresh your application."); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

          

                          $(".msg").fadeIn();

                          $(".msg").html("<i class='fa fa-warning'></i> Status changed. Please click to close");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});


$('button[name=add_coc]').click(function(e){
    
  e.preventDefault();

  var coc_date_conf     = $('input[name=coc_date_conf]').val();
  var coc_type          = $('select[name=coc_type]').val();
  var coc_reason        = $('textarea[name=coc_reason]').val();
  var actioned          = $('select[name=actioned]').val();
  // var actioned = $('input[name=actioned]').val();
  var register_id       = $('input[name=register_id]').val();
  var student_data_id   = $('input[name=student_data_id]').val();
  var submitted_by      = $('input[name=submitted_by]').val();
  
  //var filelist          = $('input[name=filelist]').val();
  var filelist = [];
  var filenamelist = [];
  $.each($('#add_coc .file-list-group').find('input:hidden'),function(){
  
        
       var val = $(this).val();
       var name = $(this).attr("datafilename");
       filelist.push(val); 
       filenamelist.push(name);
            
      
  });

  if(coc_date_conf == "" || coc_reason =="" || coc_type =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'add_coc', coc_date_conf:coc_date_conf, coc_type:coc_type, register_id:register_id, coc_reason:coc_reason, actioned:actioned, submitted_by:submitted_by, filelist:filelist, filenamelist:filenamelist, student_data_id:student_data_id },

                function(data){
 
                    //alert(data); 

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> COC details can't add. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> COC details successfully added.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }


                } );


});

$('button[name=coc_update]').click(function(e){
  
  var ref = $(this);  
  e.preventDefault();

  var id                = $(this).parents("form").find('input[name=coc_id]').val();
  var coc_date_conf     = $(this).parents("form").find('input[name=coc_date_conf]').val();
  var coc_type          = $(this).parents("form").find('select[name=coc_type]').val();
  var coc_reason        = $(this).parents("form").find('textarea[name=coc_reason]').val();
  var actioned          = $(this).parents("form").find('select[name=actioned]').val();
  // var actioned = $('input[name=actioned]').val();
  var register_id       = $('input[name=register_id]').val();
  var student_data_id   = $('input[name=student_data_id]').val();
  var submitted_by      = $('input[name=submitted_by]').val();
  
  var filelist = [];
  var filenamelist = [];
  $.each($(ref).closest('.modal').find('.file-list-group .uploadRowNew input:hidden'),function(){
  
        
       var val = $(this).val();
       var name = $(this).attr("datafilename");
       filelist.push(val); 
       filenamelist.push(name);
            
      
  });  
  
  //alert(filelist);
 
  if(coc_date_conf == "" || coc_reason =="" || coc_type =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'coc_update', id:id, coc_date_conf:coc_date_conf, coc_type:coc_type, register_id:register_id, coc_reason:coc_reason, actioned:actioned, submitted_by:submitted_by, filelist:filelist, filenamelist:filenamelist, student_data_id:student_data_id },

                function(data){

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> COC details can't update. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> COC details successfully updated.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );
         

});

$('button[name=add_attendance]').click(function(e){

    
  e.preventDefault();

  var attendance_date_of_conf = $('input[name=attendance_date_of_conf]').val();
  var attendance_year         = $('select[name=attendance_year]').val();
  var attendance_term         = $('select[name=attendance_term]').val();
  var attendance_code         = $('select[name=attendance_code]').val();
  var attendance_note         = $('textarea[name=attendance_note]').val();
  var register_id             = $('input[name=register_id]').val();
  var submitted_by            = $('input[name=submitted_by]').val();
  //alert(date_of_conf);

  if(attendance_date_of_conf == "" || attendance_year =="" || attendance_note =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'add_attendance', attendance_date_of_conf:attendance_date_of_conf, attendance_year:attendance_year, register_id:register_id, attendance_term:attendance_term, attendance_code:attendance_code, attendance_note:attendance_note, submitted_by:submitted_by },

                function(data){
                  

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance details can't add. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance details successfully added.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});

$('button[name=attendance_update]').click(function(e){

    
  e.preventDefault();

  var id                      = $(this).parents("form").find('input[name=attendance_id]').val();
  var attendance_date_of_conf = $(this).parents("form").find('input[name=attendance_date_of_conf]').val();
  var attendance_year         = $(this).parents("form").find('select[name=attendance_year]').val();
  var attendance_term         = $(this).parents("form").find('select[name=attendance_term]').val();
  var attendance_code         = $(this).parents("form").find('select[name=attendance_code]').val();
  var attendance_note         = $(this).parents("form").find('textarea[name=attendance_note]').val();
  var register_id             = $('input[name=register_id]').val();
  var submitted_by            = $('input[name=submitted_by]').val();
  //alert(id);

  if(attendance_date_of_conf == "" || attendance_year =="" || attendance_note =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'attendance_update', id:id, attendance_date_of_conf:attendance_date_of_conf, attendance_year:attendance_year, register_id:register_id, attendance_term:attendance_term, attendance_code:attendance_code, attendance_note:attendance_note, submitted_by:submitted_by },

                function(data){
                  

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance details can't update. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance details successfully updated.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});


$('button[name=add_registration]').click(function(e){

    
  e.preventDefault();

  var ssn_number          = $('input[name=ssn_number]').val();
  var date_of_conf        = $('input[name=date_of_conf]').val();
  var register_id         = $('input[name=register_id]').val();
  var submitted_by        = $('input[name=submitted_by]').val();
  var registration_status = $('select[name=registration_status]').val();
  var ac_year             = $('select[name=ac_year]').val();
  var reg_year            = $('select[name=reg_year]').val();
  var reg_note            = $('textarea[name=reg_note]').val();

  if(ssn_number == "" || date_of_conf =="" || reg_note =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'add_registration', ssn_number:ssn_number, date_of_conf:date_of_conf, register_id:register_id, registration_status:registration_status, ac_year:ac_year, reg_year:reg_year, reg_note:reg_note, submitted_by:submitted_by },

                function(data){
                  

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Registration details can't add. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Registration details successfully added.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});


$('button[name=registration_update]').click(function(e){

    
  e.preventDefault();

  var ssn_number          = $(this).parents("form").find('input[name=ssn_number]').val();
  var id                  = $(this).parents("form").find('input[name=reg_id]').val();
  var date_of_conf        = $(this).parents("form").find('input[name=date_of_conf]').val();
  var register_id         = $('input[name=register_id]').val();
  var submitted_by        = $('input[name=submitted_by]').val();
  var registration_status = $(this).parents("form").find('select[name=registration_status]').val();
  var ac_year             = $(this).parents("form").find('select[name=ac_year]').val();
  var reg_year            = $(this).parents("form").find('select[name=reg_year]').val();
  var reg_note            = $(this).parents("form").find('textarea[name=reg_note]').val();


  if(ssn_number == "" || date_of_conf =="" || reg_note =="") {
     $(".msg").html("<i class='fa fa-warning'></i> Please fill all fields."); 

     $(".msg").fadeIn();

     if($(".msg").hasClass('alert-success'))

     $(".msg").removeClass("alert alert-success");

     $(".msg").addClass("alert alert-warning");                

     $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(3000);});
     return false;
  }

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'registration_update', ssn_number:ssn_number, id:id, date_of_conf:date_of_conf, register_id:register_id, registration_status:registration_status, ac_year:ac_year, reg_year:reg_year, reg_note:reg_note, submitted_by:submitted_by },

                function(data){
                  

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Registration details can't update. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Registration details successfully updated.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});



$('button[name=excuse_update]').click(function(e){

    
  e.preventDefault();

  var excuse_id = $(this).parents("form").find('input[name=excuse_id]').val();
  var clean_day_id_class_plan_id = $(this).parents("form").find('input[name=clean_day_id_class_plan_id]').val();
  var register_id = $(this).parents("form").find('input[name=register_id]').val();
  var status = $(this).parents("form").find('select[name=status]').val();
  var remarks = $(this).parents("form").find('textarea[name=remarks]').val();

  //alert(status);

    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'excuse_update', id:excuse_id, status:status, remarks:remarks, clean_day_id_class_plan_id:clean_day_id_class_plan_id, register_id:register_id },

                function(data){
                  

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance excuse can't update. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Attendance excuse successfully updated.");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});



$('button[name=cr_new_module]').click(function(e){

    
  e.preventDefault();

    var module_name = $("input[name=new_module_name]").val();
    if(module_name=='') {
      alert("Module name is empty!");
      return false;
    }
    var module_code = $("input[name=new_module_code]").val();
    // var theory = $("input[name=new_module_th]:checked").val();
    // var practical = $("input[name=new_module_pr]:checked").val();
    // var group = $("input[name=new_module_gd]:checked").val();
    // var theory_sel = $("select[name=new_module_th_select]").val();
    // var practical_sel = $("select[name=new_module_pr_select]").val();
    // var group_sel = $("select[name=new_module_gd_select]").val();
    var course_id = $("input[name=new_module_course]").val();
    var level_id = $("input[name=level_idnew]:checked").val();
    var noofmodule = $("input[name=level_idnew]:checked").parent('.radio').find('input[name=noofmodule]').val();
    //alert(course_id);
    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'cr_new_module', name:module_name, module_code:module_code, c_id:course_id, l_id:level_id, noofmodule:noofmodule },

                function(data){

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Module can't create. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Module successfully created. Please click to close");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});


$('button[name=new_level]').click(function(e){

    
  e.preventDefault();

    var level_name = $("input[name=new_level_name]").val();
    if(level_name=='') {
      alert("Level name is empty!");
      return false;
    }
    var noofmodule = $("input[name=new_level_noofmodule]").val();
    var course_id = $("input[name=ref_id]").val();

   
    $(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';
    
    $.post(url, {action: 'create_new_level', name:level_name, noofmodule:noofmodule, course_id:course_id },

                function(data){

                    if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Module can't create. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Module successfully created. Please click to close");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }

                } );


});

// End of Billal




$('.formstatus').change(function(){

    

    var changeState = $(this).val();

    

    if(changeState == "Review") {

    $(".statuschangeslabel").find(".loading").fadeIn();

    url =getURL()+'/index.php/ajaxall/';

    $.post(url, {action: 'stafflist', },

                function(data){ 

                    if(data=="") {

                          $(".modal-body").find(".msg").html("<i class='fa fa-warning'></i> No staff found."); 

                          $(".modal-body").find(".msg").fadeIn();

                          if($(".modal-body").find(".msg").hasClass('alert-success'))

                          $(".modal-body").find(".msg").removeClass("alert alert-success");

                          $(".modal-body").find(".msg").addClass("alert alert-warning");                

                          $(".modal-body").find(".statuschangeslabel").find(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                          $(".stafflist").fadeIn();

                          $("#staffview").html(data); 

                         $(".statuschangeslabel").find(".loading").fadeOut(1000);

                    }

                } );

    

    }else if(changeState == "Rejected") {

    	

    	

    	 $(".rejected-reason-list").fadeIn();

    	

	}else{

		$(".rejected-reason-list").hide();

		$(".stafflist").hide();	

	}





       

});

//// end of form change state update











// start form note add 

$('button[name=notesbuttonstate]').click(function(){



    var reason                   = $("textarea[name=notes]").val();

    var id                       = $("input[name=ref_id]").val();

    var staff_id                 = $("input[name=staff_id]").val();

    var follow_up_check          = $('.follow-up-open').attr('checked');

    var follow_up_start_date     = "";
    var follow_up_end_date       = "";
    var follow_up_staff_id       = "";
    var follow_up       = "no";

    if (follow_up_check == "checked") {

      follow_up                  = "yes";
      follow_up_start_date       = $("input[name=follow_up_start_date]").val();
      follow_up_end_date         = $("input[name=follow_up_end_date]").val();
      follow_up_staff_id         = $("select[name=follow_up_staff_id]").val();

    } 


    

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'addnotes', reason: reason, staff_id: staff_id, id: id, follow_up_start_date:follow_up_start_date, follow_up_end_date:follow_up_end_date, follow_up_staff_id:follow_up_staff_id, follow_up:follow_up },

                function(data){ 

                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Note Can't be saved. Pleas try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                        

                         $(".msg").fadeIn();

                         // $(".msg").html(data);                        
                        // alert(data)


                          $(".msg").html("<i class='fa fa-warning'></i> Note Successfully saved. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});



//// end of note Add

// start form Registration email send add 

$('button[name=sendemail]').click(function(){



    var description         = $("textarea[name=description]").val();
    var id                  = $("input[name=ref_id]").val();
    var subject             = $("input[name=subject]").val();
    var studentEmail        = $("input[name=student_email]").val();
    var staff_id            = $("input[name=staff_id]").val();



    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'sendemail', staff_id: staff_id, id: id, subject: subject, studentEmail:studentEmail, description: description  },

                function(data){ 
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Mail Can't be Saved. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                        
                         $(".msg").fadeIn();

                         $(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Email Successfully send. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});



//// end of Registration email send add 


// start form Registration SMS send add 

$('button[name=sendsms]').click(function(){



    var description         = $("textarea[name=smsdescription]").val();
    var id                  = $("input[name=ref_id]").val();
    var subject             = $("input[name=smssubject]").val();
    var phone               = $("input[name=student_mobile_phone]").val();
    var staff_id            = $("input[name=staff_id]").val();



    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'sendsms', staff_id: staff_id,subject: subject, id: id, phone: phone, description: description  },

                function(data){ 

                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> SMS Can't be Send. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                        
                         $(".msg").fadeIn();

                         $(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> SMS Successfully send. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});



//// end of Registration SMS send add 


// start form Registration letter send add 

$('button[name=sendletter]').click(function(){



    var issuedDate          = $("input[name=issued_date2]").val();
    var student_email       = $("input[name=student_email]").val();
    var id                  = $("input[name=ref_id]").val();
    var staff_id            = $("input[name=staff_id]").val();
    var letterId            = $("select[name=letter_title]").val();
    var signatoryId         = $("select[name=signatory_title]").val();
    var letter_content      = $("textarea[id=letter_"+letterId+"]").val();
    var send_email          = $("input[name=send_email]:checked").val();

    //alert(send_email); return false;

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'sendletter', staff_id: staff_id, id: id, issuedDate: issuedDate, letterId: letterId, signatoryId: signatoryId, student_email: student_email, letter_content:letter_content, send_email:send_email  },

                function(data){ 
                    
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Can't be Issued. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                        
                         $(".msg").fadeIn();

                         //$(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Successfully Issued. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});

$('button[name=sendletterToSelectedStudent]').click(function(){

    var id = [];
    $.each($('.class-plan-list-body').find('.class-plan-id-student'),function(){
      
      if(this.checked==true) {
        id.push($(this).val());
      }
    });
    // console.log(id);
    // return false;

    var issuedDate          = $("input[name=issued_date2]").val();
    //var student_data_id     = $("input:checked[name=student_data_id]").val();
    var staff_id            = $("input[name=staff_id]").val();
    var letterId            = $("select[name=letter_title]").val();
    var signatoryId         = $("select[name=signatory_title]").val();
    var letter_content      = $("textarea[id=letter_"+letterId+"]").val();
    var send_email          = $("input[name=send_email]:checked").val();
    // alert(send_email); return false;



    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'sendletterToSelectedStudent', staff_id: staff_id, id:id,  issuedDate: issuedDate, letterId: letterId, signatoryId: signatoryId, letter_content:letter_content, send_email:send_email  },

                function(data){ 
                    
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Can't be Issued. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(500,function(){ 
                            $(".msg").fadeOut(500);
                          }); 

                    } else {
                        
                         $(".msg").fadeIn();

                         //$(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Successfully Issued. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(500,function(){ 
                            $(".msg").fadeOut(500 ,function(){ 
                              //location.reload(); 
                            });
                          });

                    }

                });

});

$('button[name=sendEmailToSelectedStudent]').click(function(){

    var id = [];
    $.each($('.class-plan-list-body').find('.class-plan-id-student'),function(){
      
      if(this.checked==true) {
        id.push($(this).val());
      }
    });


    var email_subject            = $("input[name=emailSubject]").val();
    var letter_content      = $("textarea[name=emailDescription]").val();

    // alert(letter_content); return false;

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';
    // alert(id);
    // return false;
   $.post(url, {action: 'sendEmailToSelectedStudent', id:id, letter_content:letter_content, email_subject:email_subject  },

      function(data){ 
          
          if(data=="") {

                $(".msg").html("<i class='fa fa-warning'></i> Email Can't be Sent. Please try again"); 

                $(".msg").fadeIn();

                if($(".msg").hasClass('alert-success'))

                $(".msg").removeClass("alert alert-success");

                $(".msg").addClass("alert alert-warning");                

                $(".loading").fadeOut(500,function(){ $(".msg").fadeOut(500);}); 

          } else {
              
               $(".msg").fadeIn();

               // $(".msg").html(data);

                $(".msg").html("<i class='fa fa-warning'></i> Email Successfully Sent. Please click close.");

                if($(".msg").hasClass('alert-warning'))

                $(".msg").removeClass("alert alert-warning");

                $(".msg").addClass("alert alert-success");  

                $(".loading").fadeOut(500,function(){ 
                  $(".msg").fadeOut(500 ,function(){ 
                    //location.reload();
                    });
                });

          }

      });

});

$('button[name=sendSMSToSelectedStudent]').click(function(){

    var id = [];
    $.each($('.class-plan-list-body').find('.class-plan-id-student'),function(){
      
      if(this.checked==true) {
        id.push($(this).val());
      }
    });
    // alert(id); return false;

    var sms_subject       = $("input[name=smsSubject]").val();
    var sms_content       = $("textarea[name=smsDescription]").val();

    // alert(id); return false;

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'sendSMSToSelectedStudent', id:id, sms_content:sms_content, sms_subject:sms_subject  },

      function(data){ 
          
          if(data=="") {

                $(".msg").html("<i class='fa fa-warning'></i> SMS Can't be Sent. Please try again"); 

                $(".msg").fadeIn();

                if($(".msg").hasClass('alert-success'))

                $(".msg").removeClass("alert alert-success");

                $(".msg").addClass("alert alert-warning");                

                $(".loading").fadeOut(500,function(){ $(".msg").fadeOut(500);}); 

          } else {
              
               $(".msg").fadeIn();

               //$(".msg").html(data);

                $(".msg").html("<i class='fa fa-warning'></i> SMS Successfully Sent. Please click close.");

                if($(".msg").hasClass('alert-warning'))

                $(".msg").removeClass("alert alert-warning");

                $(".msg").addClass("alert alert-success");  

                $(".loading").fadeOut(500,function(){ 
                  $(".msg").fadeOut(500 ,function(){ 
                    //location.reload(); 
                  });
                });

          }

      });

});

//// end of Registration letter send add 


// start form Registration letter date change 
$("button[name=changedate]").click(function(){
    
   //var Id = $(this).closest("tr").attr('id');
   // alert(Id);
    $('input[name=issulid]').val($(this).attr('data-id'));
});
$('button[name=changedatebutton]').click(function(){



    var issuedDate         = $("input[name=issued_date]").val();
    var liid               = $("input[name=issulid]").val();



    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'changedateletter', letterId: liid, issuedDate: issuedDate  },

                function(data){ 
                    $(".msg").fadeIn();

                         $(".msg").html(data);
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Date Can't be Issued. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                        
                         $(".msg").fadeIn();

                         $(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Letter Date Successfully Changed. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});



//// end of Registration letter date change



// start  add communication 

$('button[name=commentbuttonstate]').click(function(){



    var reason              = $("textarea[name=comment]").val();

    var id                  = $("input[name=ref_id]").val();

    var staff_id            = $("input[name=staff_id]").val();

    var comm_form           = "staff";

    var comm_to             = "student";

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'addcomment', comment: reason, comm_form: comm_form, comm_to: comm_to, staff_id: staff_id, id: id },

                function(data){ 
                      //alert(data);
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Note Can't be saved. Please try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                        

                         $(".msg").fadeIn();

                         //$(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Note Successfully saved. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



});



//// end add communication

$('input:radio[name=check_hard_copy_doc]').click(function(){

   var check = $(this).val();

   

   if(check=="yes") { $(".reason").slideUp();} else {  $(".reason").slideDown();}



});



// start student add communication 

$('button[name=uploadstudentstate]').click(function(){



    var reason              = $("textarea[name=comment]").val();

    var id                  = $("input[name=ref_id]").val();

    var staff_id            = $("input[name=staff_id]").val();

    var comm_form           = "student";

    var comm_to             = "staff";

    var orginalfilename     = new Array();

        $(".documentfile").each(function() {

            orginalfilename.push($(this).val());

    });

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'uploadstudentstate', comment: reason, documentfile: orginalfilename, staff_id: staff_id, id: id },

                function(data){ 
                   
                    //$(".msg").html(data);
                    
                    
                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Note Can't be saved. Pleas try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                        

                         $(".msg").fadeIn();

                         //$(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Note Successfully saved. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }
                    
                    

                });



});



//// end add communication



// alert badges


$('select[name=student_funding_type]').change(function(){

    var funding = $(this).val();

  if(funding == "Student Loan" ) {

      $("#fundingoption").fadeIn();

      

      $('#fundingoption3').fadeOut();

      $('input[name=student_funding_type_other]').val("");

  }else if(funding == "Other" ){

      

       $('#fundingoption3').fadeIn();

       $("#fundingoption").fadeOut();

       $("#fundingoption2").fadeOut(); 

       $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no"); 

       $('select[name=student_already_in_receipt_of_funds]').val("no");   

  }else {

      $("#fundingoption").fadeOut();$("#fundingoption2").fadeOut();

      $('#fundingoption3').fadeOut();

      $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no");

      $('input[name=student_funding_type_other]').val("");

  }



});

$('select[name=student_student_loan_applied_for_the_proposed_course]').change(function(){

    var funding = $(this).val();

  if(funding == "yes" ) {

      $("#fundingoption2").fadeIn();

      $('#fundingoption3').hide();

      $('input[name=student_funding_type_other]').val("");

  } else {

      $("#fundingoption2").fadeOut();

      $('select[name=student_already_in_receipt_of_funds]').val("no");

  }



});

// set semester

$('select[name=student_semister]').change(function(){

	var semester_id = $(this).val();

	$(".loading").fadeIn();

	url =getURL()+'/index.php/ajaxall/';

	$.post(url, {action: 'courselists', semester_id: semester_id },

                function(data){ 

                    if(data!="not_found") {

                          $(".course-box").html(data);                 

                          $(".loading").fadeOut(); 

                    } else {

                          $(".msg").fadeIn();

                          $(".msg").html("<i class='fa fa-warning'></i> course list not available");

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut();});

                    }

                } );

});



$('#selectbyall').click(function(event) {  //on click

        if(this.checked) { // check select status

            $('.checkbox1').each(function() { //loop through each checkbox

                this.checked = true;  //select all checkboxes with class "checkbox1"              

            });

        }else{

            $('.checkbox1').each(function() { //loop through each checkbox

                this.checked = false; //deselect all checkboxes with class "checkbox1"                      

            });        

        }

    });



$("input[name=manaul_poscode]").click(function(){

	$('.address-details').toggle('slow');

});




$('.register-personal-info-submit').click(function(e){



      var student_type = $("select.std_type_check").val();

      //alert(student_type);
      if(student_type == "")
      {
        $("#check_student_type").css({
          color: 'red',
          border: '1px solid red'

        }).text("Please select stydent type");
        return false;
      } else {
        $("#check_student_type").css('border', 'none').html("");

      }
	      
	    var formdata = $('#registerglobalinfo, #registerinfo').serialize();
      // alert(formdata);
      //return false;
	    formdata = "action=submitRegisterPersonal&"+formdata;

        url = getURL()+'/index.php/ajaxall/';
         $(".loading").fadeIn();

	    $.ajax({
	      url: url,
	      data : formdata,
	      type : "POST",
	      success: function(data){
	      	  $(".loading").fadeOut();

	      	$(".msg").html(data);    

	      }
	    });	            		
		
		         
}); 

$(".student_formal_education").change(function(){

	if($(this).val() == "yes")

	$('.qualification-details').slideDown();

	else

	$('.qualification-details').slideUp();

	

});

$(".student_others_disabilities_on").change(function(){

	if($(this).val() == "yes")

	$('.disabilities-info').slideDown();

	else

	$('.disabilities-info').slideUp();

	

});

$("select[name=student_others_marketing_info_referred_by]").change(function(){

	if($(this).val() == "student_referred") {

	     $('.reffered-claim').slideDown(); 	

	     $('.agent-claim').slideUp();

         $("select[name=agent_id] option").each(function(){

             if ($(this).text() == "Please select") {

                $(this).attr("selected",true);

            } else {

                $(this).removeAttr("selected");

            }

         });

    

    

	} else if($(this).val() == "agent_referred")  { 

	$('.reffered-claim').slideUp();

	 $('.agent-claim').slideDown(); 

     $("input[name=student_others_marketing_info_referred_name]").val("");

     $("input[name=student_others_marketing_info_referred_phone]").val("");

	} else if($(this).val() == "student_own" || $(this).val() == "n/a")  {

        

      $('.reffered-claim').hide();

      $('.agent-claim').hide();   

      $("select[name=agent_id] option").each(function(){

         if ($(this).text() == "Please select") {

            $(this).attr("selected",true);

        } else {

            $(this).removeAttr("selected");

        }

      });

    

    }

	

});  

$("select[name=student_employment_history_current_employment_status]").change(function(){

	if($(this).val() == "Part Time" || $(this).val() == "Fixed Term" || $(this).val() == "Zero Hour" || $(this).val() == "Seasonal" || $(this).val() == "Agency or Temp" || $(this).val() == "Volunteer")

	$('.employment-info').slideDown();

	else

	$('.employment-info').slideUp();

	

});

 

/////////////// STAFF - STUDENT ADMISSION - START 



$(".search_student_form select[name=semester_id]").change(function(){

	var semester_id = $(this).val();

	//$(".loading").fadeIn();

	if($(this).val()!=""){

	url = getURL()+'/index.php/ajaxall/';

	$.post(url, {action: 'getSemesterRelatedCourses', semester_id: semester_id },

                function(data){ 

                    if(data!="not_found") {

                          $("select[name=course_id]").html(data);                 

                    }

                } );

	  }else{

		$("select[name=course_id]").html("");  

	  }		

});

$(".search_student_form select.course_id_list").change(function(){

  var course_id = $(this).val();

  //$(".loading").fadeIn();

  if($(this).val()!=""){

  url = getURL()+'/index.php/ajaxall/';

  $.post(url, {action: 'getCourseRelatedModule', course_id: course_id },

                function(data){ 

                    if(data!="not_found") {

                          $("select[name=coursemodule_list]").html(data);                 
                          // $(".check_module_list").html(data);
                    }

                } );

    }else{

    $("select[name=coursemodule_list]").html("");  

    }   

});


$(".search_student_form select.coursemodule_id").change(function(){

  var coursemodule_id   = $(this).val();
  var course_id         = $("select.course_id_list").val();
  var semister_id       = $(".search_student_form select[name=semester_id]").val();
  // alert(semister_id);
  // alert(course_id); return false;

  //$(".loading").fadeIn();

  if($(this).val()!=""){

  url = getURL()+'/index.php/ajaxall/';

  $.post(url, {action: 'getGroupByCourseRelatedModule', coursemodule_id: coursemodule_id, course_id: course_id, semister_id:semister_id },

      function(data){ 

          if(data!="not_found") {
                // $(".mes").html(data);
                $("select[name=group]").html(data);                 
                // $(".check_module_list").html(data);
          }

      } );

    }else{

      $("select[name=group]").html("");  

    }   

}); 


$(".search-student-list tbody tr").click(function(){

	

        var id = $(this).attr("id");

        if(id>""){

        //location.href = getURL()+'/index.php/student_admission_management/?action=singleview&do=application&id='+id;
           window.open( getURL()+'/index.php/student_admission_management/?action=singleview&do=application&id='+id, '_blank');
		 }	

});

$(".registration-student-list tbody tr").click(function(){

	

        var id = $(this).attr("id");

        if(id>""){

        //location.href = getURL()+'/index.php/registration/registration_management/?action=singleview&do=application&id='+id;
        window.open( getURL()+'/index.php/registration/registration_management/?action=singleview&do=application&id='+id, '_blank');

		 }	

});	

$(".student-management-list tbody tr").click(function(){

  

        var id = $(this).attr("id");

        if(id>""){
        
        window.open( getURL()+'/index.php/student/student_management/?action=singleview&do=application&id='+id, '_blank');



     }  

}); 





 

 

 

 

/////////////// STAFF - STUDENT ADMISSION - END 

///////////// STAFF - REPORT _START





$('.report-button').click(function(){

	

	var sem_id=$('select[name=semester_id]').val();

    $(".loading").fadeIn(); 

	if(sem_id!=""){

	url = getURL()+'/index.php/ajaxall/';

	$.post(url, {action: 'createReport', semester_id: sem_id },

                function(data){ 

					$('.report-data').hide();

					$('.report-data').html(data).fadeIn('slow');

                    $(".loading").fadeOut();

                } );

                

	  }	

	

});





//////////// STAFF  - REPORT - END 

 

 

 

 

 

 

 

    

//FILE UPLOAD PART START

    

// Change this to the location of your server-side upload handler:

  //  var url = window.location.hostname === 'blueimp.github.io' ?  '//jquery-file-upload.appspot.com/' : 'server/php/';

        // alert(url);   

        

      

   'use strict'; 

      var   url =getURL()+'/uploads/';      



        

        uploadButton = $('<button/>')

            .addClass('btn btn-warning')

            .prop('disabled', true)

            .text('Processing...')

            .on('click', function () {

                var $this = $(this),

                    data = $this.data();

                $this

                    .off('click')

                    .text('Abort')

                    .on('click', function () {

                        $this.remove();

                        data.abort();

                    });

                data.submit().always(function () {

                    $this.remove();

                });

            });

    $('#fileupload').fileupload({

        url: url,

        dataType: 'json',

        autoUpload: false,

        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf|doc|docx|xls|csv)$/i,

        maxFileSize: 10000000, // 10 MB

        // Enable image resizing, except for Android and Opera,

        // which actually support image resizing, but fail to

        // send Blob objects via XHR requests:

        disableImageResize: /Android(?!.*Chrome)|Opera/

            .test(window.navigator.userAgent),

        previewMaxWidth: 200,

        previewMaxHeight: 200,

        previewCrop: true

    }).on('fileuploadadd', function (e, data) {

        data.context = $('<div/>').appendTo('#files');

        $.each(data.files, function (index, file) {

            var node = $('<p/>')

                    .append($('<span/>').text(file.name));

            if (!index) {

                node

                    .append('<br>')

                    .append(uploadButton.clone(true).data(data));

            }

            node.appendTo(data.context);

        });

    }).on('fileuploadprocessalways', function (e, data) {

        var index = data.index,

            file = data.files[index],

            node = $(data.context.children()[index]);

        if (file.preview) {

            node

                .prepend('<br>')

                .prepend(file.preview);

        }

        if (file.error) {

            node

                .append('<br>')

                .append($('<span class="text-danger"/>').text(file.error));

        }

        if (index + 1 === data.files.length) {

            data.context.find('button')

                .text('Upload')

                .prop('disabled', !!data.files.error);

        }

    }).on('fileuploadprogressall', function (e, data) {

        var progress = parseInt(data.loaded / data.total * 100, 10);

        $('#progress .progress-bar').css(

            'width',

            progress + '%'

        );

    }).on('fileuploaddone', function (e, data) {

        $.each(data.result.files, function (index, file) {

            // code will aded here

            

                //$('<p/>').text(file.name).appendTo('#files');

                $("input[name=filename]").val(file.name);

               $('<input type="hidden" class ="documentfile" name="documentfile[]" value="'+file.name+'" />').appendTo('#files');

               /*$(".delete").attr('data-type',file.deleteType);

               $(".delete").attr('data-url',file.deleteUrl);*/

               $('<button class="btn btn-danger delete deleteupload" data-type="'+file.deleteType+'" data-url="'+file.deleteUrl+'"><i class="fa fa-trash"></i> Delete</button>').appendTo('#files');

               

              if(file.name != "") {  

                                  

                $(".msg").html('<div class="alert alert-success "><p><span class="glyphicon glyphicon-ok"></span> File Successfully Added</p>');    

     $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });  

              } else {

                $(".msg").html('<div class="alert alert-warning "><p><span class="glyphicon glyphicon-warning-sign"></span>  File Can not be Uploded. Please, try again.</p>');    

     $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });  

              }        

            

            if (file.url) {

                var link = $('<a>')

                    .attr('target', '_blank')

                    .prop('href', file.url);

                $(data.context.children()[index])

                    .wrap(link);

            } else if (file.error) {

                var error = $('<span class="text-danger"/>').text(file.error);

                $(data.context.children()[index])

                    .append('<br>')

                    .append(error);

            }

        });

    }).on('fileuploadfail', function (e, data) {

        $.each(data.files, function (index) {

            var error = $('<span class="text-danger"/>').text('File upload failed.');

            $(data.context.children()[index])

                .append('<br>')

                .append(error);

        });

    }).prop('disabled', !$.support.fileInput)

        .parent().addClass($.support.fileInput ? undefined : 'disabled');
        
        
        
        
        
        
    $('#fileupload2').fileupload({

        url: url,

        dataType: 'json',

        autoUpload: false,

        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf|doc|docx|xls|csv)$/i,

        maxFileSize: 10000000, // 10 MB

        // Enable image resizing, except for Android and Opera,

        // which actually support image resizing, but fail to

        // send Blob objects via XHR requests:

        disableImageResize: /Android(?!.*Chrome)|Opera/

            .test(window.navigator.userAgent),

        previewMaxWidth: 200,

        previewMaxHeight: 200,

        previewCrop: true

    }).on('fileuploadadd', function (e, data) {

        data.context = $('<div/>').appendTo('#files2');

        $.each(data.files, function (index, file) {

            var node = $('<p/>')

                    .append($('<span/>').text(file.name));

            if (!index) {

                node

                    .append('<br>')

                    .append(uploadButton.clone(true).data(data));

            }

            node.appendTo(data.context);

        });

    }).on('fileuploadprocessalways', function (e, data) {

        var index = data.index,

            file = data.files[index],

            node = $(data.context.children()[index]);

        if (file.preview) {

            node

                .prepend('<br>')

                .prepend(file.preview);

        }

        if (file.error) {

            node

                .append('<br>')

                .append($('<span class="text-danger"/>').text(file.error));

        }

        if (index + 1 === data.files.length) {

            data.context.find('button')

                .text('Upload')

                .prop('disabled', !!data.files.error);

        }

    }).on('fileuploadprogressall', function (e, data) {

        var progress = parseInt(data.loaded / data.total * 100, 10);

        $('#progress2 .progress-bar').css(

            'width',

            progress + '%'

        );

    }).on('fileuploaddone', function (e, data) {

        $.each(data.result.files, function (index, file) {

            // code will aded here

            

                //$('<p/>').text(file.name).appendTo('#files');

                $("input[name=filename2]").val(file.name);

               $('<input type="hidden" class ="documentfile2" name="documentfile2[]" value="'+file.name+'" />').appendTo('#files2');

               /*$(".delete").attr('data-type',file.deleteType);

               $(".delete").attr('data-url',file.deleteUrl);*/

               $('<button class="btn btn-danger delete deleteupload" data-type="'+file.deleteType+'" data-url="'+file.deleteUrl+'"><i class="fa fa-trash"></i> Delete</button>').appendTo('#files2');

               

              if(file.name != "") {  

                                  

                $(".msg").html('<div class="alert alert-success "><p><span class="glyphicon glyphicon-ok"></span> File Successfully Added</p>');    

     $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });  

              } else {

                $(".msg").html('<div class="alert alert-warning "><p><span class="glyphicon glyphicon-warning-sign"></span>  File Can not be Uploded. Please, try again.</p>');    

     $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });  

              }        

            

            if (file.url) {

                var link = $('<a>')

                    .attr('target', '_blank')

                    .prop('href', file.url);

                $(data.context.children()[index])

                    .wrap(link);

            } else if (file.error) {

                var error = $('<span class="text-danger"/>').text(file.error);

                $(data.context.children()[index])

                    .append('<br>')

                    .append(error);

            }

        });

    }).on('fileuploadfail', function (e, data) {

        $.each(data.files, function (index) {

            var error = $('<span class="text-danger"/>').text('File upload failed.');

            $(data.context.children()[index])

                .append('<br>')

                .append(error);

        });

    }).prop('disabled', !$.support.fileInput)

        .parent().addClass($.support.fileInput ? undefined : 'disabled');         
        
              

        

//FILE UPLOAD PART END            


	$('form#registerglobalinfo').find('select[name=student_type]').change(function(){/////// function for registration page - change student type field  
		
		var student_type = $(this).val();
		var student_course = $('select[name=student_course]').val();
		var student_semister = $('input:hidden[name=student_semister]').val();
		
		url = getURL()+'/index.php/ajaxall/';

		$.post(url, {action: 'getCourseStartAndEndDate', student_type: student_type, student_course: student_course, student_semister: student_semister  },

	                function(data){ 

						$('.msg').html(data);

	                } );				
		
	});

///------------------------------------------------------



    

	

});//--------------------------END OF DOCUMENT READY

/****************************************************************************************************************************************

* default native alert made with bootstrap. second perameter just navigate away page if found after finishing alert animation.

*/

(function( $ ){

    $.fn.myalert = function(msg,link){

        $(this).find('.text').text(msg);

        $(this).removeClass('hide').css('opacity',0).animate({ opacity: '1' }, 'slow', function(){ if(link>"") window.location.replace(link); });

    }

})( jQuery );



/****************************************************************************************************************************************

* remove element from datatable list.

*/

function RemoveFromList(id,model){

    var ref="#"+id;

     url = getURL()+'/index.php/ajaxall/';

     var data="";

	  $.post(url, {action: 'RemoveFromList', id: id, model: model  },

        function(msg){ 

            //alert(msg);

            $('#myModal').modal('toggle');

            $('.alert-success').myalert('List item successfully deleted.');  

            $(ref).closest('.gradeA').animate({opacity: 0},'slow',function(){ $(this).remove(); });

        } );        

}// function RemoveFromList(id){
function RemoveFromCampus(id,model){

    var ref="#"+id;

     url = getURL()+'/index.php/ajaxall/';

     var data="";

    $.post(url, {action: 'RemoveFromCampus', id: id, model: model  },

        function(msg){ 

            
            if(msg != "") {
              

              $(".msg").html('<div class="alert alert-success "><p><span class="glyphicon glyphicon-ok"></span> Campus Deleted Successfully.</p>');    

              $(".msg").fadeIn(3000,function(){ 
                $(".msg").fadeOut(2000, function() {
                  $(ref).closest('.single-campus').remove();
                  $('#myModal').modal('hide');

                  var how_much = 1;
                  $.each($(".campus-area").find('.single-campus '),function()
                  {
                    
                    $(this).find(".how-much").html(how_much);
                      how_much++;    
                  });

                }); 
              });

              
              
              
            } else {
              $(".msg").html('<div class="alert alert-warning "><p> Campus can not be deleted.</p>');    

              $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); }); 
            }

             

        } );        

}
function RemoveFromLetterlist(id,model){

    

     url = getURL()+'/index.php/ajaxall/';

     var data="";

    $.post(url, {action: 'RemoveFromLetterList', id: id, model: model  },

        function(msg){ 

            //alert(msg);
            if(msg != "") {
              //$('#myModal').modal('toggle');

              $(".msg").html('<div class="alert alert-success "><p><span class="glyphicon glyphicon-ok"></span> Letter Deleted Successfully.</p>');    

              $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });   
              location.reload();
            } else {
              $(".msg").html('<div class="alert alert-warning "><p> Letter can not be deleted.</p>');    

              $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); }); 
            }

           

        } );        

}

function RemoveFromList2(id,model, duration, course_relation){

    var ref="#"+id;
    
    var course_rel_id = course_relation;
    
    var dur = duration-1; 

     url = getURL()+'/index.php/ajaxall/';

     var data="";

    $.post(url, {action: 'RemoveFromList2', id: id, model: model, duration_value: dur, course_rel:course_rel_id  },

        function(msg){ 
          $('#myModal').modal('toggle');
           location.reload();

        } );        

}// function RemoveFromList(id){


function RemoveModule(id,model){

    var ref="#"+id;

    url = getURL()+'/index.php/ajaxall/';

    var data="";

    $.post(url, {action: 'RemoveModule', id: id, model: model  },

        function(msg){ 

            //alert(msg);

            $('#myModal').modal('toggle');

            $('.alert-success').myalert('List item successfully deleted.');  
            window.location.reload();

        } );    

}// function RemoveModule(id){

function gcd (a, b) {

    return (b == 0) ? a : gcd (b, a%b);

}

function getURL(){

	    pathArray = window.location.href.split( '/' );

	    var blkstr = []; var f =0;

		$.each(pathArray, function(k,v) {                    

			 if(v=='index.php') f = 1; if(f==0) blkstr.push(v);

		});

	    b = blkstr.join("/");

	    

	    

	    return b;

}







//Live dom work on js

$(document).on('dblclick', '.gradeA', function( event ) {

    var close = '<button type="button" class="lebel-close" ><span aria-hidden="true">&times;</span></button>';

    var code = $(this).find('td input:hidden').val();  //alert(code); 

    var codename = $(this).find('td.codename').text();  $(".selecthead").html(codename+' ('+code+')'+close);

    $('input[name="parent_ID"]').val(code);

    event.preventDefault();

});



// Start File upload delete option

$(document).on('click', '.deleteupload', function( event ) {

    event.preventDefault();

    var datatype= $(this).attr("data-type");

    var dataurl= $(this).attr("data-url");

    $.ajax({

    url: dataurl,

    type: datatype,

    success: function(result) {

        $("#files").fadeOut(1000,function(){ 

            $("#files").html(' ');

            var progress =0;

            $('#progress .progress-bar').css('width',progress + '%');

            $("input[name=filename]").val();

            $("#files").fadeIn();

            $(".msg").html('<div class="alert alert-warning "><p><span class="fa fa-warning"></span>  File removed. Please, uplaod a document.</p>');    

     $(".msg").fadeIn(4000,function(){ $(".msg").fadeOut(4000); });

            

        });

       

    }

});

});



$(document).on('click','button[name=uploadDoc]',function(event){

    event.preventDefault();

    var orginalfilename     = new Array();

    var filename            = $("input[name=filename]").val();

    var checkhardcopy       = $("input:radio[name=check_hard_copy_doc]:checked").val();

    var reason              = $("textarea[name=reason]").val();

    var id                  = $("input[name=ref_id]").val();

    var staff_id            = $("input[name=staff_id]").val();

    

    $(".documentfile").each(function() {
      orginalfilename.push($(this).val());
    });

	if(orginalfilename.length > 0) {

    $(".loading").css("display","inline");

    url = getURL()+'/index.php/ajaxall/';

   $.post(url, {action: 'uploadstaffstate', filename: filename, documentfile: orginalfilename, checkhardcopy: checkhardcopy, reason: reason, staff_id: staff_id, id: id },

                function(data){ 

                    if(data=="") {

                          $(".msg").html("<i class='fa fa-warning'></i> Upload Can't be saved. Pleas try again"); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {

                        

                         $(".msg").fadeIn();

                         $(".msg").html(data);

                          $(".msg").html("<i class='fa fa-warning'></i> Upload Successfully saved. Please click close.");

                          if($(".msg").hasClass('alert-warning'))

                          $(".msg").removeClass("alert alert-warning");

                          $(".msg").addClass("alert alert-success");  

                          $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){ location.reload(); });});

                    }

                });



    } else {

	

	                      $(".msg").html("<i class='fa fa-warning'></i> Upload Can't be started. Please upload file first."); 

                          $(".msg").fadeIn();

                          if($(".msg").hasClass('alert-success'))

                          $(".msg").removeClass("alert alert-success");

                          $(".msg").addClass("alert alert-warning");                

                          $(".msg").fadeOut(5000); 

	}

       

});


// End File upload delete option 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('click','button[name=uploadSignatoryDoc]',function(event){

    event.preventDefault();
    var orginalfilename     = new Array();

    

    $(".documentfile").each(function() {

            orginalfilename.push($(this).val());

    });
    

    $('input:hidden[name=sign_url]').val('uploads/files/'+orginalfilename[0]);
    
    
	$('.imgpreview img').attr('src',''+getURL()+'/'+$('input:hidden[name=sign_url]').val());
	$("#myUploadDoc").modal('toggle');    
    

       

});







// Date inpur convertion for Journal Entry

Date.prototype.getMonthName = function(lang) {

    lang = lang && (lang in Date.locale) ? lang : 'en';

    return Date.locale[lang].month_names[this.getMonth()];

};



Date.prototype.getMonthNameShort = function(lang) {

    lang = lang && (lang in Date.locale) ? lang : 'en';

    return Date.locale[lang].month_names_short[this.getMonth()];

};



Date.locale = {

    en: {

       month_names: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

       month_names_short: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

    }

};





function mysqlDateToJsDate(timestamp) {

  //function parses mysql datetime string and returns javascript Date object

  //input has to be in this format: 2007-06-05 15:26:02

  var regex=/^([0-3][0-9])-([0-1][0-9])-([0-9]{2,4})?$/;

  var parts=timestamp.replace(regex,"$1 $2 $3").split(' ');

  return new Date(parts[2],parts[1]-1,parts[0]);

}





function avoidAllNaN(){

    $.each($('form').find('input'), function(){

        if($(this).val()=='NaN') $(this).val('0');   

    });

}   







function print_report(cls,title,style){





    var matchedElements = document.getElementsByClassName(cls);

    var str = '';



    for (var i = 0; i < matchedElements.length; i++) {

        var str = str + matchedElements[i].innerHTML;

    }

    var h = document.getElementsByClassName(cls).offsetHeight;

    var newwin = window.open('', 'printwin', 'left=100,top=100,width=780,height='+h);



    newwin.document.write('<HTML>\n<HEAD>\n');

    newwin.document.write('<STYLE media=\'print\'> body{padding:0px;margin:0px;} '+style+' </STYLE>\n');

    newwin.document.write('<TITLE>'+title+'</TITLE>\n');

    newwin.document.write('<script>\n');

    newwin.document.write('function chkstate(){\n');

    newwin.document.write('if(document.readyState=="complete"){\n');

    newwin.document.write('window.close()\n');

    newwin.document.write('}\n');

    newwin.document.write('else{\n');

    newwin.document.write('setTimeout("chkstate()",2000)\n');

    newwin.document.write('}\n');

    newwin.document.write('}\n');

    newwin.document.write('function print_win(){\n');

    newwin.document.write('window.print();\n');

    newwin.document.write('chkstate();\n');

    newwin.document.write('}\n');

    newwin.document.write('<\/script>\n');

    newwin.document.write('</HEAD>\n');

    newwin.document.write('<BODY onload="print_win()">\n');

    newwin.document.write(str);

    newwin.document.write('</BODY>\n');

    newwin.document.write('</HTML>\n');

    newwin.document.close();





}



function recallRemove(){

    

}



function makeAllStdAdEnable(val,c){



	if(val==true) val = false; else val = true;

	$.each($('.'+c).find('input:checkbox'), function(){

	

		

		 $(this).attr('disabled', val);
         
	});	

	

	

	

}///function makeAllStdAdEnable(){



function submitTwoForms(form,dataObject) {
        url = getURL()+'/index.php/ajaxall/';
	    $.ajax({
	      url: url,
	      data : dataObject,
	      type : "GET",
	      success: function(){
	        $(form).submit();   //assuming id of second form  is form2
	      }
	    });
	    return false;   //to prevent submit
	    
	    
	    
	    
  
}



function initializePanelColapsible(){
    
    $.each($('.panel-colapsible'),function(){

        var head = $(this).html();
        $(this).html('<div class="col-xs-6">'+head+'</div><div class="col-xs-6 text-right"><a href="javascript:void(0);" class="panel-colapsible-toggle"><i class="fa fa-chevron-up"></i></a></div><div class="clearfix"></div>');
                
    });
    
    $('.panel-colapsible-toggle').click(function(){        
        $(this).closest('.panel').find('.panel-body').slideToggle(function(){
            
            if($(this).is(":hidden")==true){
                //alert("yes");
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-down"></i>');
            }else{
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-up"></i>');
            }
        });
        
    });    
    
}


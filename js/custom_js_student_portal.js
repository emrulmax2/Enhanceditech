$(function() {
	$('.dTable').dataTable({

        "bJQueryUI": true,

        "sPaginationType": "full_numbers",

        "sDom": '<""l>t<"F"fp>',


          "fnDrawCallback":function(){

            recallRemove();

          },

          "iDisplayLength": 10,

          "aLengthMenu": [[10, 25, 50,100,-1], [10, 25, 50,100,"All"]]          

    });

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



  function getURL(){

        pathArray = window.location.href.split( '/' );

        var blkstr = []; var f =0;

      $.each(pathArray, function(k,v) {                    

         if(v=='index.php') f = 1; if(f==0) blkstr.push(v);

      });

        b = blkstr.join("/");

        

        

        return b;

  }


});
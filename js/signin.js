$(function() {
    
    $("#frgtID").submit(function(e){
    e.preventDefault();
    $(".loading").fadeIn(); 
    
        var Email = $("input[name=emForg]").val();
    
        pathArray = window.location.href.split( '/' );
                                        
        protocol = pathArray[0];
        host = pathArray[2];
        box = pathArray[3];
        url = protocol + '//' + host+'/'+box+'/index.php/ajaxall/';

        if(Email!=""){
            
              $.post(url, {action: 'forgetpassword', email: Email },
                function(data){ 
                    if(data!="not_found") {
                          $(".msg").html(data);
                          $(".msg").addClass("alert alert-success");  
                          $(".loading").fadeOut(); 
                    } else {
                          $(".msg").html("Email adress not found in this system.");
                          if($(".msg").hasClass('alert-success'))
                          $(".msg").removeClass("alert alert-success");
                          $(".msg").addClass("alert alert-warning");  
                          $(".loading").fadeOut();
                    }
                } );            
        }
        
        
      
 
    
    });

    $("#form-passwordchanged").submit(function(e){
        
        var repassword = $(".repassword").val();
        var password = $(".password").val();
        if(password != repassword){
            e.preventDefault();
          $(".retypepassword").html("Password missmatch");
          $(".retypepassword").addClass("alert alert-warning");  
          $(".retypepassword").fadeOut(5000);  
        }
    });
    
    
   /* $("#userform").submit(function(e){ 
        var repassword = $(".repassword").val();
        var password = $(".password").val();
        if(password != repassword && password ==""){
            e.preventDefault();
          $(".retypepassword").html("Password missmatch");
          $(".retypepassword").addClass("alert alert-warning");  
          $(".retypepassword").fadeOut(5000);  
        }
    });*/

});







function getURL(){
        pathArray = window.location.href.split( '/' );
        var blkstr = []; var f =0;
        $.each(pathArray, function(k,v) {                    
             if(v=='index.php') f = 1; if(f==0) blkstr.push(v);
        });
        b = blkstr.join("/");
        
        
        return b;
}

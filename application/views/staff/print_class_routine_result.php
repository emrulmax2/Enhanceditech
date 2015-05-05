
<script type="text/javascript">

$(document).ready(function(){


function print_form(cls){


    var matchedElements = document.getElementsByClassName(cls);
    var str = '';

    for (var i = 0; i < matchedElements.length; i++) {
        var str = str + matchedElements[i].innerHTML;
    }
    var h = document.getElementsByClassName(cls).offsetHeight;
    var newwin = window.open('', 'printwin', 'left=100,top=100,width=780,height='+h);

    newwin.document.write('<HTML>\n<HEAD>\n');
    newwin.document.write('<STYLE media=\'print\'>\n');
    newwin.document.write('.search-class-list tbody.class-list tr td{ font-size: 90%; padding-top:1%;padding-bottom:1%;}\n');
    newwin.document.write('.search-class-list thead tr#list_thead{ text-align: left; }\n');
    newwin.document.write('.search-class-list tbody.class-list tr td.course_name{ width:13%; }\n');
    newwin.document.write('.search-class-list tbody.class-list tr td.module_name{ font-size: 80%; }\n');
    newwin.document.write('table.search-class-list { border: 1px solid black; border-collapse: collapse;}\n');
    // newwin.document.write('table.search-class-list th { border-right: 1px solid black;border-bottom: 1px solid black; }\n');
    // newwin.document.write('table.search-class-list td { border-right: 1px solid black;border-bottom: 1px solid black; }\n');
    // newwin.document.write('table.search-class-list th:last-child { border-right: none; }\n');
    // newwin.document.write('table.search-class-list td:last-child { border-right: none;}\n');
    // newwin.document.write('table.search-class-list tr:last-child { border-bottom: none;}\n');
    newwin.document.write('.div_print_table{ font-size: 50%; }\n');
    newwin.document.write('.text-large{ font-size: 110%; }\n');
    newwin.document.write('.bold{ font-weight:bold; }\n');
    newwin.document.write('.right{ text-align: right; width:100%; }\n');
    newwin.document.write('.center{ text-align: center; }\n');
    newwin.document.write('.blocked_header{ background-color: \'Gray\'; padding: 8px; font-weight:bold; font-size: 90%; }\n');
    newwin.document.write('.field_header{ font-size: 80%; padding:8px; font-weight:bold; }\n');
    newwin.document.write('.field_text{ font-size: 80%; text-transform: capitalize; padding:8px; }\n');
    newwin.document.write('</STYLE>\n');
    newwin.document.write('<TITLE>Print Application</TITLE>\n');
    newwin.document.write('<script>\n');
    newwin.document.write('function chkstate(){\n');
    newwin.document.write('if(document.readyState=="complete"){\n');
    newwin.document.write('window.close();\n');//window.close()
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
print_form('div_print_table');  
  // window.print();
    
});

</script>

<style media='print'>
.div_print_table{width:100%; font-size: 50%;} .text-mid{ font-size: 150%; } .text-large{ font-size: 200%;} .bold{font-weight:bold;} .right{ text-align: right; width:100%;} .center{text-align: center;} .blocked_header{background-color: #ddd;padding: 8px;font-weight:bold;font-size: 130%;} .clear{clear:both;} .field_header{font-size: 110%;padding:8px;font-weight:bold;} .field_text{font-size: 110%;text-transform: capitalize;padding:8px;} .border-top{border-top: 1px solid #ddd;} .print_table tr td{width:50%;}



</style> 

      
                              

					       <a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/print_class_routine_management/?action=search"><i class="fa fa-arrow-left"></i> Back to Class Routine</a>
                <div class="row div_print_table" style="margin-top:20px;">
                
                <h3 style="text-align:center">Class Routine</h3>
						    <?php echo $result; ?>					
																																																																																																
					     
           
               

            	</div> <!--End of #formbox-->

<?php
  
class Lcc_inbox extends CI_Model {
     
     public $inbox_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->library('session');
        $this->load->helper('functions');


    }
        
    /**
    * update user basic information
    * 'ID'=>$this->user_id,
    * 'username'=>'',
    * 'user_email'=>'',
    * 'password'=>'',
    * 'last_login'=>'',
    * 'active'=>1
    * @param ARRAY $args 
    * @return TRUE if succefully update else return False
    */    
    function update($args=array())
    {
       
     
      $this->db->update($this->fixidb->inbox,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }
    /**
    * update by st
    * 'ID'=>$this->user_id,
    * 'username'=>'',
    * 'user_email'=>'',
    * 'password'=>'',
    * 'last_login'=>'',
    * 'active'=>1
    * @param ARRAY $args 
    * @return TRUE if succefully update else return False
    */
    function updateNotificationstatusByAppID($appid)
    {
       
     $args =array("notification_checked"=>"yes");
      $this->db->order_by("id","DESC");
      $this->db->update($this->fixidb->inbox,$args,array('student_data_id'=>$appid,'notification_type'=>"communication",'notification_checked'=>"no"));

      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }
     
    /**
    * insert user information
    * 
    * @return inserted id else return false
    */
    function add($args=array())
    {
 
     $default=array("communication_id"=>0,"student_data_id"=>0,"staff_id"=>0,"notification_type"=>"communication","notification_from"=>"staff","notification_to"=>"student","notification_to_staff_id"=>0,"notification_checked"=>"no","entry_date"=>date("Y-m-d H:i:s",time()),"dt"=>"","is_trash"=>0,"induction_id"=>0,"job_id"=>0);
     $args = fixi_parse_args($args,$default); 
     //var_dump($args);           
     $this->db->insert($this->fixidb->inbox,$args);
     return $this->db->insert_id();
    }
    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($user_id){
     
        if(isset($user_id)){
            $user_id=(int)$user_id;
            $this->db->delete($this->fixidb->inbox,array('id'=>$user_id));
            return $user_id;
        }else{
          return FALSE;  
        }
        
    }
    /**
    * get all user
    * 
    * 
    * @return user id if data is deleted else return false.
    */
    function get_all(){
     
     /*$data =array();
                $this->db->db_select();
                $this->db->order_by("id", "desc");
         $query=$this->db->get($this->fixidb->inbox);
         $i =0;
         foreach($query->result() as $row):
               $data[$i] = array('id'=>$row->id,'student_data_id'=>$row->student_data_id,'communication_id'=>$row->communication_id,'staff_id'=>$row->staff_id,'notification_type'=>$row->notification_type,'notification_from'=>$row->notification_from,'notification_to'=>$row->notification_to,'notification_checked'=>$row->notification_checked,'dt'=>$row->dt,'entry_date'=>$row->entry_date,'is_trash'=>$row->is_trash);
               
               $i++;
         endforeach;
         
        return $data;*/
        
        ///-------- newly added
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $this->db->order_by("id", "desc");
        $query=$this->db->get($this->fixidb->inbox);
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data;         
          
        
        
    }
                 
     function get_by_ID($ID="") {                  
       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE id='".$ID."' LIMIT 1");
         
        return $query;  
     }    
                  
    function get_by_student_ID($ID="") {                  
       
         /*$query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' ORDER BY id desc");
         $data =array();
         $i =0;
         foreach($query->result() as $row){
             
             $data[$ID][$i] = array('id'=>$row->id,'student_data_id'=>$row->student_data_id,'communication_id'=>$row->communication_id,'staff_id'=>$row->staff_id,'notification_type'=>$row->notification_type,'notification_from'=>$row->notification_from,'notification_to'=>$row->notification_to,'notification_checked'=>$row->notification_checked,'dt'=>$row->dt,'entry_date'=>$row->entry_date,'is_trash'=>$row->is_trash);
             $i++;
         
         }   
         
        return $data;*/ 
        	////---------- newly added
	        $fieldlist = array();
	        $data =array();
	        $this->db->db_select();
	        $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' ORDER BY id desc");
	        $i=0;
	        foreach($query->list_fields() as $field):
	         $fieldlist[$i] = $field;
	         $i++;
	        endforeach;
	        $i=0;
	        foreach($query->result() as $row):
	             for($count=0; $count < count($fieldlist); $count++) {
	                $data[$ID][$i][$fieldlist[$count]] = $row->$fieldlist[$count];
	             }
	         $i++; 
	        endforeach; 
	          
	       return $data;        
         
     }    
       
                   
    function get_trash_by_student_ID($ID="") {                  
       
         /*$query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' AND is_trash =1 ORDER BY id desc");
         $data =array();
         $i =0;
         foreach($query->result() as $row){
             
			 $data[$ID][$i] = array('id'=>$row->id,'student_data_id'=>$row->student_data_id,'communication_id'=>$row->communication_id,'staff_id'=>$row->staff_id,'notification_type'=>$row->notification_type,'notification_from'=>$row->notification_from,'notification_to'=>$row->notification_to,'notification_checked'=>$row->notification_checked,'dt'=>$row->dt,'entry_date'=>$row->entry_date,'is_trash'=>$row->is_trash);
		     $i++;
         
         }   
         
        return $data;*/
        	////---------- newly added
	        $fieldlist = array();
	        $data =array();
	        $this->db->db_select();
	        $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' AND is_trash =1 ORDER BY id desc");
	        $i=0;
	        foreach($query->list_fields() as $field):
	         $fieldlist[$i] = $field;
	         $i++;
	        endforeach;
	        $i=0;
	        foreach($query->result() as $row):
	             for($count=0; $count < count($fieldlist); $count++) {
	                $data[$ID][$i][$fieldlist[$count]] = $row->$fieldlist[$count];
	             }
	         $i++; 
	        endforeach; 
	          
	       return $data;         
          
     }
     
     
     function get_alert_of_student($ID) {
         $alert =0;
         $sql ="SELECT count(*) as totalalert FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' AND notification_checked ='no' AND (notification_type='exam' OR notification_type = 'review' OR notification_type = 'induction' OR notification_type = 'job' OR notification_type = 'followup') AND ( notification_from =\"staff\"  ) ";

          $query=$this->db->query($sql);
          
          foreach($query->result() as $row){
              $alert = $row->totalalert;
          }
         return $alert;
     }         
     function get_communication_alert_of_student($ID) {
         $alert =0;
         $sql ="SELECT count(*) as totalalert FROM ".$this->fixidb->inbox." WHERE student_data_id='".$ID."' AND notification_checked ='no' AND (notification_type='communication') AND (notification_to=\"student\") ";

          $query=$this->db->query($sql);
          
          foreach($query->result() as $row){
              $alert = $row->totalalert;
          }
         return $alert;
     }    
       
 


    function get_by_staff_ID($ID="") {                  
       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE (notification_to_staff_id='".$ID."' OR staff_id='".$ID."') ORDER BY id desc");
         $data =array();
         $i =0;
         foreach($query->result() as $row){
             
             $data[$i] = array( 'id'                        =>  $row->id,
                                'student_data_id'           =>  $row->student_data_id,
                                'communication_id'          =>  $row->communication_id,
                                'staff_id'                  =>  $row->staff_id,
                                'notification_type'         =>  $row->notification_type,
                                'notification_from'         =>  $row->notification_from,
                                'notification_to'           =>  $row->notification_to,
                                'notification_checked'      =>  $row->notification_checked,
                                'notification_to_staff_id'  =>  $row->notification_to_staff_id,
                                'dt'                        =>  $row->dt,
                                'entry_date'                =>  $row->entry_date,
                                'is_trash'                  =>  $row->is_trash,
                                'induction_id'              =>  $row->induction_id,
                                'job_id'              		=>  $row->job_id
                                );
             $i++;
         
         }   
         
        return $data;  
     }
         function get_trash_by_staff_ID($ID="") {                  
       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE (notification_to_staff_id='".$ID."' OR staff_id='".$ID."') AND is_trash =1 ORDER BY id desc");
         $data =array();
         $i =0;
         foreach($query->result() as $row){
             
             $data[$i] = array( 'id'                    => $row->id,
                                'student_data_id'       => $row->student_data_id,
                                'communication_id'      => $row->communication_id,
                                'staff_id'              => $row->staff_id,
                                'notification_type'     => $row->notification_type,
                                'notification_from'     => $row->notification_from,
                                'notification_to'       => $row->notification_to,
                                'notification_checked'  => $row->notification_checked,
                                'dt'                    => $row->dt,
                                'entry_date'            => $row->entry_date,
                                'is_trash'              => $row->is_trash,
                                'induction_id'          => $row->induction_id,
                                'job_id'              		=>  $row->job_id
                                );
             $i++;
         
         }   
         
        return $data;  
     }
     
     function get_alert_of_staff($ID) {
         $alert =0;
         $sql ="SELECT count(*) as totalalert FROM ".$this->fixidb->inbox." WHERE staff_id='".$ID."' AND notification_checked ='no' AND (notification_type != 'communication') AND (notification_from=\"student\" OR  notification_from=\"admin\") ";

          $query=$this->db->query($sql);
          
          foreach($query->result() as $row){
              $alert = $row->totalalert*1;
          }
         $sql2 ="SELECT id FROM ".$this->fixidb->inbox." WHERE notification_to_staff_id='".$ID."' AND notification_checked ='no' AND (notification_type != 'communication') AND notification_from=\"staff\" "; 
         $query=$this->db->query($sql2);
/*           foreach($query->result() as $row){
              $alert += $row->totalalert*1;
          }*/         
         return $query->num_rows();
     }
     
     function get_communication_alert_of_staff($ID) {
         $alert =0;
         $sql ="SELECT count(*) as totalalert FROM ".$this->fixidb->inbox." WHERE staff_id='".$ID."' AND notification_checked ='no' AND (notification_type='communication') AND (notification_from=\"student\" OR  notification_from=\"admin\") ";

          $query=$this->db->query($sql);
          
          foreach($query->result() as $row){
              $alert = $row->totalalert*1;
          }
          $sql2 ="SELECT count(*) as totalalert FROM ".$this->fixidb->inbox." WHERE notification_to_staff_id='".$ID."' AND notification_checked ='no' AND (notification_type='communication') ";   
          $query=$this->db->query($sql2);
          
          foreach($query->result() as $row){
              $alert += $row->totalalert*1;
          }       
         return $alert;
     }    

     function get_last_staffbyID($student_id) {
         $staff_D =0;
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->inbox." WHERE student_data_id='".$student_id."' AND notification_type='communication' ORDER BY id desc LIMIT 1");
         if($query->num_rows>0){
                $staff_D= $query->row()->staff_id;
         }
         return $staff_D;
     }
     
     function getPaginationCustom($sql_query="",$page,$targetpage="",$hasAction="no") {

        if($sql_query=="") {$sql_query="SELECT * FROM ".$this->fixidb->inbox." WHERE 1 ORDER BY id desc"; }
        if($targetpage=="") {$targetpage=base_url()."index.php/masterinbox_management/"; }
        if($hasAction=="yes") $pp = "&"; else $pp = "?";
        
        // How many adjacent pages should be shown on each side?
        $adjacents = 3;
        
        /* 
           First get total number of rows in data table. 
           If you have a WHERE clause in your query, make sure you mirror it here.
        */

        $query=$this->db->query($sql_query);

        $total_pages = $query->num_rows();
        
        /* Setup vars for query. */

        $limit = 20;                                 //how many items to show per page
        //$page = $_GET['page'];
        if($page) 
            $start = ($page - 1) * $limit;             //first item to display on this page
        else
            $start = 0;                                //if no page var is given, set start to 0
        
        /* Get data. */
        $sql=$this->db->query($sql_query." LIMIT $start, $limit");

        
        /* Setup page vars for display. */
        if ($page == 0) $page = 1;                    //if no page var is given, default to 1.
        $prev = $page - 1;                            //previous page is page - 1
        $next = $page + 1;                            //next page is page + 1
        $lastpage = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;                        //last page minus 1
        
        /* 
            Now we apply our rules and draw the pagination object. 
            We're actually saving the code to a variable in case we want to draw it more than once.
        */
        $pagination = "";
        if($lastpage > 1)
        {    
            $pagination .= "<ul class=\"pagination\">";
            //previous button
            if ($page > 1) 
                $pagination.= "<li><a href=\"$targetpage".$pp."page=$prev\">previous</a></li>";
            else
                $pagination.= "<li class=\"disabled\"><a href=\"#\" >previous</a></li>";    
            
            //pages    
            if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
            {    
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";                    
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
            {
                //close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))        
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</span></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";                    
                    }
                    $pagination.= "<li><a href=\"#\">...</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";        
                }
                //in middle; hide some front and some back
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
                    $pagination.= "<li><a href=\"#\">...</a></li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";                    
                    }
                    $pagination.= "<li><a href=\"#\">...</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";        
                }
                //close to end; only hide early pages
                else
                {
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
                    $pagination.= "<li><a href=\"#\">...</a></li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";                    
                    }
                }
            }
            
            //next button
            if ($page < $counter - 1) 
                $pagination.= "<li><a href=\"$targetpage".$pp."page=$next\">next</a></li>";
            else
                $pagination.= "<li class=\"disabled\"><a href=\"#\">next</a></li>";
            $pagination.= "</ul>\n";        
        }

            $output = array();
            if ($sql->num_rows() > 0)
            {
                $i=0; $row_array = array();
                foreach($sql->result() as $row){                  
               $row_array[$i] = array('id'=>$row->id,'student_data_id'=>$row->student_data_id,'communication_id'=>$row->communication_id,'staff_id'=>$row->staff_id,'notification_type'=>$row->notification_type,'notification_from'=>$row->notification_from,'notification_to'=>$row->notification_to,'notification_to_staff_id'=>$row->notification_to_staff_id,'notification_checked'=>$row->notification_checked,'dt'=>$row->dt,'entry_date'=>$row->entry_date,'is_trash'=>$row->is_trash); 
                  $i++;
                  }
                
               $output['row_array'] = $row_array;
               $output['pagination'] = $pagination;
               $output['total_rec'] = $total_pages;
            }else{
               $output['row_array'] = "";
               $output['pagination'] = "";
               $output['total_rec'] = 0;                
            } 
            
            return $output; 


        
    }  
    
    
    function getMasterInboxlistWithPagination($sql_query,$page,$targetpage,$hasAction,$i=1){
        $this->load->model('staff','', TRUE);
        $this->load->model('student_data','', TRUE);
        $this->load->model('lcc_communication','', TRUE);
        
        $communication = $this->lcc_communication->get_all();
    ?>
<?php $output = $this->getPaginationCustom($sql_query,$page,$targetpage,$hasAction); ?>
<?php
        $htmlOutput ='<table class="table table-hover search-student-list">
                                <thead>                                
                                    <tr>
                                        <th colspan="5" class="text-right">Total Message: '.$output['total_rec'].'</th>
                                    </tr>
                                    <tr>
                                        <th>Serial</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Message</th>
                                        <th class="text-right">Received</th>
                                    </tr>
                                </thead>
                                <tbody>';
?>

<?php 
if($output['total_rec']>0){   
 
                foreach($output['row_array'] as $k=>$inbox_row){
                    $htmlOutput .= "<tr id='".$inbox_row['student_data_id']; 
                    if($inbox_row["notification_checked"] == "no"): $htmlOutput .="class='not-reviewd'";  else:  $htmlOutput .="class='reviewd'"; endif;
                     $htmlOutput .= "'>";
                     $htmlOutput .= "<td>".$i++."</td>";
                    $htmlOutput .= "<td>"; 
                    
                    if($inbox_row["notification_from"]=="staff"){

                      $htmlOutput .= $staffname = $this->staff->get_name($inbox_row["staff_id"]);                                           
                        
                    }else if ($inbox_row["notification_from"]=="student") {

                       $htmlOutput .= $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]); 
                       $htmlOutput .= "(".$communication[$inbox_row["communication_id"]]["student_data_id"].")";  
                    }
                    
                    $htmlOutput .= "</td>";
                    $htmlOutput .= "<td>";
                    if($inbox_row["notification_to"]=="staff" && $inbox_row["notification_from"]=="staff"){
                     
                     $htmlOutput .= $this->staff->get_name($inbox_row["notification_to_staff_id"]);     
                    
                
                    }else if($inbox_row["notification_to"]=="staff" && $inbox_row["notification_from"]=="student")
                    {
                        if($inbox_row["staff_id"]!=0) {
                        $htmlOutput .= $this->staff->get_name($inbox_row["staff_id"]);
                        }
                        
                    } else if ($inbox_row["notification_to"]=="student") {
                     
                       $htmlOutput .= $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]);  
                       $htmlOutput .= "(".$communication[$inbox_row["communication_id"]]["student_data_id"].")";                        
                    }
                    $htmlOutput .= "</td>";
                    $htmlOutput .= "<td>";
                    if($inbox_row["notification_type"]== "communication"){
                        
                    $htmlOutput .=  '<a class="inbox" id="" href="'.base_url().'index.php/student_admission_management/?action=singleview&do=communication&id='.$inbox_row['student_data_id'].'">'.substr(htmlspecialchars_decode($communication[$inbox_row["communication_id"]]["text"]),0,50).'...</a>';
                                            
                    }else if($inbox_row["notification_type"]== "exam"){
                        
                        $htmlOutput .=  '<a class="inbox" id="" href="'.base_url().'index.php/student_admission_management/?action=singleview&do=application&id='.$inbox_row['student_data_id'].'">An exam respnse from ref'.$inbox_row['id'].'</a>';
                        
                    }else if($inbox_row["notification_type"]== "review"){
                        $htmlOutput .=  '<a class="inbox" id="" href="'.base_url().'index.php/student_admission_management/?action=singleview&do=application&id='.$inbox_row['student_data_id'].'">A review from '.$staffname.'</a>';
                    }
                    $htmlOutput .= "</td>";

                    $htmlOutput .= "<td>";
                    if($inbox_row["notification_type"]== "communication") {
                        if($communication[$inbox_row["communication_id"]]["entry_date"]!="0000-00-00 00:00:00") 
                            $htmlOutput .= tohrdatetime($communication[$inbox_row["communication_id"]]["entry_date"]); 
                        else 
                            $htmlOutput .= $communication[$inbox_row["communication_id"]]["datetime"];
                    } else {
                    if(isset($inbox_row["entry_date"]) && $inbox_row["entry_date"]!="0000-00-00 00:00:00") 
                    $htmlOutput .= tohrdatetime($inbox_row["entry_date"]); 
                    else 
                    $htmlOutput .= $inbox_row["dt"];
                    }
                    $htmlOutput .= "</td>";
                        
                    $htmlOutput .= "</tr>";
                }
                
                $htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div>";
            }else{
                
                $htmlOutput .= "<tr><td colspan='5'>No records found.</td></tr></tbody></table>";    
            }
?>


<?php 
     return  $htmlOutput;   
    }
    
} //End of class
?>

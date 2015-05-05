<?php



class Fixidb extends CI_Model {


    /**
     * Whether to show SQL/DB errors
     *
     * @since 0.71
     * @access private
     * @public bool
     */
    public $show_errors = false;

    /**
     * Whether to suppress errors during the DB bootstrapping.
     *
     * @access private
     * @since 2.5.0
     * @public bool
     */
    public $suppress_errors = false;

    /**
     * The last error during query.
     *
     * @see get_last_error()
     * @since 2.5.0
     * @access private
     * @public string
     */
    public $last_error = '';

    /**
     * Amount of queries made
     *
     * @since 1.2.0
     * @access private
     * @public int
     */
    public $num_queries = 0;

    /**
     * Count of rows returned by previous query
     *
     * @since 1.2.0
     * @access private
     * @public int
     */
    public $num_rows = 0;

    /**
     * Count of affected rows by previous query
     *
     * @since 0.71
     * @access private
     * @public int
     */
    public $rows_affected = 0;

    /**
     * The ID generated for an AUTO_INCREMENT column by the previous query (usually INSERT).
     *
     * @since 0.71
     * @access public
     * @public int
     */
    public $insert_id = 0;

    /**
     * Saved result of the last query made
     *
     * @since 1.2.0
     * @access private
     * @public array
     */
    public $last_query;

    /**
     * Results of the last query made
     *
     * @since 1.0.0
     * @access private
     * @public array|null
     */
    public $last_result;

    /**
     * Saved info on the table column
     *
     * @since 1.2.0
     * @access private
     * @public array
     */
    public $col_info;

    /**
     * Saved queries that were executed
     *
     * @since 1.5.0
     * @access private
     * @public array
     */
    public $queries;

    
    public $tables = array('');


    /**
     * List of fixi global tables
     *
     * @since 3.0.0
     * @access private
     * @see wpdb::tables()
     * @public array
     */
    public $global_tables = array('agent','archive','communication','course','inbox','interview','notes','semister','staff','staff_upload','student_data','student_upload','settings','awarding_body','course_relation','register','email_issuing','letter_issuing','letter_set','signatory_set','sms_issuing','modules','course_modules_relation','module_relation','currency','countries','zones', 'student_gender', 'student_marital_status', 'student_others_ethnicity', 'student_title', 'student_others_disabilities','semester_plan','time_plan','room_plan','class_plan','courselevel','coursemodule','class_lists', 'status', 'student_information','student_assign_class', 'attendance','examresult','examresult_info','attendance_excuse', 'examresult_archive','slc_coursecode','installment','agreement','attendance_history', 'registration_history', 'coc_history', 'money_receipt', 'job_department', 'jobs', 'job_induction', 'job_induction_process',"job_assign", "attendance_notify", 'job_type', 'job_applied_student', 'hesa_courseaim', 'hesa_qual', 'hesa_regbody','hesa_ttcid','hesa_class','hesa_disall','hesa_exchind','hesa_genderid','hesa_heapespop','hesa_locsdy','hesa_mode','hesa_priprov','hesa_relblf','hesa_rsnend','hesa_sexort','hesa_sselig', 'campus_info', 'hesa_student_information', 'coc_upload', 'hesa_notact','hesa_unitlgth', 'hesa_sbjca', 'hesa_subject_of_course', 'hesa_previnst', 'hesa_qualtype', 'hesa_qualsbj', 'hesa_qualsit', 'hesa_domicile', 'hesa_course_relation_instance','hesa_course_relation_unitlgth','hesa_stuload_student_info','hesa_mstufee','hesa_qualent3','hesa_course_relation_instance_terms', 'exam_result_prev', 'attendancearchive', 'academicsession');

    public $agent;
    public $archive;
    public $communication;
    public $course;
    public $inbox;
    public $interview;
    public $notes;
    public $semister;
    public $staff;
    public $staff_upload;
    public $student_data;
    public $student_upload;
    public $settings;
    public $awarding_body;
    public $course_relation;
    public $register;
    public $email_issuing;
    public $letter_issuing;
    public $letter_set;
    public $signatory_set;
    public $sms_issuing;
    public $modules;
    public $course_modules_relation;
    public $module_relation;
    public $currency;
    public $countries;
    public $zones;
    public $student_gender;
    public $student_marital_status;
    public $student_others_ethnicity;
    public $student_title;
    public $student_others_disabilities;
    public $semester_plan;
    public $time_plan;
    public $room_plan;
    public $class_plan;
    public $courselevel;
    public $class_lists;
    public $status;
    public $student_information;
    public $student_assign_class;
    public $attendance;
    public $examresult;
    public $examresult_info;
    public $attendance_excuse;
    public $examresult_archive;
    public $slc_coursecode;
    public $installment;
    public $agreement;
    public $attendance_history;
    public $registration_history;
    public $coc_history;
    public $money_receipt;
    public $job_department;
    public $jobs;
    public $job_induction;
    public $job_induction_process;
    public $job_assign;
    public $attendance_notify;
    public $job_type;
    public $job_applied_student;
    public $hesa_courseaim;
    public $hesa_qual;
    public $hesa_regbody;
    public $hesa_ttcid;
    public $hesa_class;
    public $hesa_disall;
    public $hesa_exchind;
    public $hesa_genderid;
    public $hesa_heapespop;
    public $hesa_locsdy;
    public $hesa_mode;
    public $hesa_priprov;
    public $hesa_relblf;
    public $hesa_rsnend;
    public $hesa_sexort;
    public $hesa_sselig;
    public $campus_info;
    public $hesa_student_information;
    public $coc_upload;
    public $hesa_notact;
    public $Hesa_unitlgth;
    public $hesa_sbjca;
    public $hesa_subject_of_course;
    public $hesa_previnst;
    public $hesa_qualtype;
    public $hesa_qualsbj;
    public $hesa_qualsit;
    public $hesa_domicile;
    public $hesa_course_relation_instance;
    public $hesa_course_relation_unitlgth;
    public $hesa_stuload_student_info;
    public $hesa_mstufee;
    public $hesa_qualent3;
    public $hesa_course_relation_instance_terms;
    public $exam_result_prev;
    public $attendancearchive;
    public $academicsession;


    function __construct()
    {
       
        
        parent::__construct();
        
        $this->load->database();

        /* Set table name globally using table data */
             
        foreach ($this->global_tables as $tablename) {
            
           $this->$tablename   =   $this->db->dbprefix( $tablename );  
        }
         
    
    }
    
 function __destruct(){
 
     $this->db->close();
 
 }
 
}
?>

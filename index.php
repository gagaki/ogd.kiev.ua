<!DOCTYPE html>
<html lang="en">
<HEAD>
 <meta charset="utf-8">
 <title>OG-Design дизайн полиграфия издательство</title>
 <meta name="viewport" content="width=device-width,initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <link href="/css/style.css" media="screen" rel="stylesheet" type="text/css">
   <link href="/css/jqueryUI" media="screen" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="/js/jquery.min.js"></script>
   <script type="text/javascript" src="/js/jqueryUI"></script>
</HEAD>
<?

 require("config.php");
 include("job.class.php");

 $object = new Job;

?>
<BODY>
<div id="job" class="job" style="width:50%;background:#EEEEEE;padding:10px;">
 <div style="background:#FFFFFF;" id="job_list">
<?

 // Init
 Job::view_list_tpl(2,1);
 Job::view_list(1,1);

?>
 </div>
 <div style="background:#FA91FD;" id="job_view">

 </div>
 <div style="background:#FA91FD;" id="job_edit">

 </div>
</div>

<?

// $object->view(2);
// $object->create(); exit;
// $object->view_tpl(2);
// $object->view_tpl(1);

/*
 $object->part = 2;
 $object->subpart = 1;
 $object->name  = "---La la la---";
 $object->about = "---about---";
 $object->img   = "pic1.jpg";
 $object->insert(); // From form !
*/

// $object->name = "---Aaa - AAA---";
// $object->update(28);

// $object->delete(25);

// Job::view_list_tpl_ajax(2,1);
// Job::view_list_tpl_ajax(2,2);

// $object->edit_tpl(1);

/*
?>
<Script Language="JavaScript">
  $(document).ready(function(){
//  $(job_list).text("11111111111");
  $(job_list).load("subjob.class.php");
  });
</Script>
<?
*/

?>
</BODY>
</HTML>
<?

 echo "111111";

 exit;

 class SubJob extends Job {
  var $aaa = 1;
 }

 $object2 = new SubJob;
 $object2->view(1);
 $object2->view_tpl();
 echo $object2->aaa;

?>
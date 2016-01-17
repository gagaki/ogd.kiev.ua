<?

 require("config.php");
 include("job.class.php");
 $object = new Job;

 echo "pid ".$_GET["pid"];
 $object->view($_GET["pid"]);

?>
<table border=1 bgcolor="red">
<tr><td>id:</td><td><? echo $object->id; ?></td></tr>
<tr><td>name:</td><td><? echo $object->name; ?></td></tr>
<tr><td>about:</td><td><? echo $object->about; ?></td></tr>
</table>
<br>
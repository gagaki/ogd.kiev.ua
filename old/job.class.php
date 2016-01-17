<?

/*

$object->name  = "OGD";
$object->about = "bla bla-la";
$object->img   = "-pic1.jpg";
$object->insert();

$object->name = "---Aaa---";
$object->update(1); //  From form !

$object->name = "---Aaa2---";
$object->insert(); // From form !
*/

class Job {
 var $id;
 var $part;
 var $subpart;
 var $name;
 var $about;
 var $img;

 function create() {
   global $DBH;
   $SQL_psql = "CREATE  SEQUENCE    job_id
        minvalue 1  increment 1  start 1;
   CREATE  TABLE  job (
        id        int8 NOT NULL default nextval('job_id'),
        part      int8,
        subpart   int8,
        name      varchar(64),
        about     text,
        img       varchar(128) , 
        CONSTRAINT job_pkey PRIMARY KEY (id)
   );";
   // $stmt = $DBH->prepare($SQL_psql);
   $SQL_mysql = "CREATE  TABLE  job  (
        id        int NOT NULL PRIMARY KEY AUTO_INCREMENT,
        part      int,
        subpart   int,
        name      varchar(64),
        about     text,
        img       varchar(128) 
   );";
   $stmt = $DBH->prepare($SQL_mysql);
   $stmt->execute();
 }

 function update($p_id) {
   global $DBH;
   $stmt = $DBH->prepare(" UPDATE job SET part=:part,subpart=:subpart,name=:name,about=:about,img=:img WHERE id=:p_id ");
   $stmt->bindParam(':p_id', $p_id);
   $stmt->bindParam(':part', $this->part);
   $stmt->bindParam(':subpart', $this->subpart);
   $stmt->bindParam(':name', $this->name);
   $stmt->bindParam(':about', $this->about);
   $stmt->bindParam(':img', $this->img);
   $stmt->execute();
 }

 function delete($p_id) {
   global $DBH;
   $stmt = $DBH->prepare(" DELETE FROM job WHERE id=:p_id ");
   $stmt->bindParam(':p_id', $p_id);
   $stmt->execute();
 }

 function insert() {
   global $DBH;
   $stmt = $DBH->prepare(" INSERT INTO job (part,subpart,name,about,img) VALUES (:part,:subpart,:name,:about,:img) ");
   $stmt->bindParam(':part', $this->part);
   $stmt->bindParam(':subpart', $this->subpart);
   $stmt->bindParam(':name', $this->name);
   $stmt->bindParam(':about', $this->about);
   $stmt->bindParam(':img', $this->img);
   $stmt->execute();
 }

 function view($p_id) {
   global $DBH;
   $stmt = $DBH->prepare(" SELECT id,part,subpart,name,about,img FROM job WHERE id=:p_id ");
   $stmt->bindParam(':p_id', $p_id);
   $stmt->setFetchMode(PDO::FETCH_INTO,$this);  
   // FETCH_INTO - данные вернуть в обьект this    
   // FETCH_ASSOC  FETCH_OBJ
   $stmt->execute();
   $stmt->fetch();
 }

 // +css div.job _job ?
 function view_tpl($p_id) { 
  $this->view($p_id);
?>
<table border=2>
<tr><td>:</td><td><? echo $this->id; ?></td></tr>
<tr><td>:</td><td><? echo $this->name; ?></td></tr>
<tr><td>:</td><td><? echo $this->about; ?></td></tr>
<tr><td>:</td><td><? echo $this->img; ?></td></tr>
</table>
<?
 }

 function edit_tpl($p_id) {
  $this->view($p_id);
?>
<table border=1>
<input type="hidden" name="id" id="id" value="<? echo $this->id; ?>">
<tr><td>name:</td><td><input type="text" name="name" id="name" value="<? echo $this->name; ?>"></td></tr>
<tr><td>img:</td><td><input type="text" name="img" id="img" value="<? echo $this->img; ?>"></td></tr>
<tr><td>about:</td><td><textarea name="about" id="about"><? echo $this->about; ?></textarea></td></tr>
</table>
<?
 }


 function view_list_tpl_ajax($p_part,$p_subpart) {
   $stmt = Job::view_list($p_part,$p_subpart);
/*
?>
<Script Language="JavaScript">
  $(document).ready(function(){
   $(job_list).html("<?
   while($row = $stmt->fetch()) {
    echo "<div><div>id:".$row->id."</div><div> name:".$row->name."</div></div>";
   } ?>");
  });
</Script>
<?
*/
?>
<Script Language="JavaScript">
  $(document).ready(function(){ 
<?
   while($row = $stmt->fetch()) {
?>
   $(job_list).load("job.tpl.php");
<?
   }
?> 
  });
</Script>
<?
 }

 function view_list($p_part,$p_subpart) {
   global $DBH;
   $stmt = $DBH->prepare(" SELECT id,part,subpart,name,about,img FROM job WHERE part=:p_part AND subpart=:p_subpart ");
   $stmt->bindParam(':p_part',$p_part);
   $stmt->bindParam(':p_subpart',$p_subpart);
   $stmt->setFetchMode(PDO::FETCH_OBJ);  
   $stmt->execute();
   return $stmt;
   // var_dump( $stmt->fetchObject('Job') );
 }

 function view_list_tpl($p_part,$p_subpart) {
   $stmt = Job::view_list($p_part,$p_subpart);
   // == fetchObject('Job')
   while($row = $stmt->fetch()) { 
?>
<table border=1 style="background:#CDCDAE;width:100%">
<tr><td><a href="#" rel="<? echo $row->id; ?>" id="job_view_full">id:</a></td><td width="90%"><? echo $row->id; ?></td></tr>
<tr><td>name:</td><td style="background:#FFFFFF;"><? echo $row->name; ?></td></tr>
</table>
<br>
<?
   }
?>
<SCRIPT LANGUAGE="JavaScript">
$(document).ready(function(){              
    // вешаем на клик по элементу с id = job_view
    $(job_view_full).click(function(){
        // загрузку HTML кода из файла example.html
        // $(this).load('job.tpl.php');       
        // alert( $(this).attr('href') );
        $(job_view).load('job.tpl_full.php?pid='+$(this).attr('rel') );
    })
}); 
</SCRIPT>
<?
 }


}

?>
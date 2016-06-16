<?php
     
    require '../config/database.php';


if($_POST) 
  {
      $kode_dokter = strip_tags($_POST['kode_dokter']);
      
   $q=$pdo->prepare("SELECT kode_dokter FROM tb_dokter WHERE kode_dokter=:kode_dokter");
   $q->execute(array(':kode_dokter'=>$kode_dokter));
   $count=$q->rowCount();
      
   if($count>0)
   {
    echo "<span style='color:brown;'>Sorry username already taken !!!</span>";
   }
   else
   {
    echo "<span style='color:green;'>available</span>";
   }
  }

    ?>
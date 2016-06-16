<?php
    require '../config/database.php';
    $kode_dokter = 0;
     
    if ( !empty($_GET['kode_dokter'])) {
        $kode_dokter = $_REQUEST['kode_dokter'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $kode_dokter = $_POST['kode_dokter'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tb_dokter  WHERE kode_dokter = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($kode_dokter));
        Database::disconnect();
        header("Location: crud.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Dokter</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="kode_dokter" value="<?php echo $kode_dokter;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="crud.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
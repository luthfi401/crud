<?php
    require '../config/database.php';
    $id = null;
    if ( !empty($_GET['kode_dokter'])) {
        $id = $_REQUEST['kode_dokter'];
    }
     
    if ( null==$id ) {
        header("Location: crud.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_dokter where kode_dokter = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
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
                        <h3>Read a Dokter</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Nama Dokter</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['nama_dokter'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Jenis Kelamin</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['jns_kelamin'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Spesialis</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['spesialis'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="crud.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
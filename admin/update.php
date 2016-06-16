<?php
    require '../config/database.php';
 
    $kode_dokter = null;
    if ( !empty($_GET['kode_dokter'])) {
        $kode_dokter = $_REQUEST['kode_dokter'];
    }
     
    if ( null==$kode_dokter ) {
        header("Location: crud.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nama_dokterError = null;
        $jns_kelaminError = null;
        $spesialisError = null;
         
        // keep track post values
        $nama_dokter = $_POST['nama_dokter'];
        $jns_kelamin = $_POST['jns_kelamin'];
        $spesialis = $_POST['spesialis'];
         
        // validate input
        $valid = true;
        if (empty($nama_dokter)) {
            $nama_dokterError = 'Please enter Nama Dokter';
            $valid = false;
        }
         /*
        if (empty($email)) {
            $emailError = 'Please enter Jenis Kelamin';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         */
        if (empty($jns_kelamin)) {
            $jns_kelaminError = 'Please enter Jenis Kelamin';
            $valid = false;
        }

        if (empty($spesialis)) {
            $spesialisError = 'Please enter Spesialis';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tb_dokter  set nama_dokter = ?, jns_kelamin = ?, spesialis =? WHERE kode_dokter = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($nama_dokter,$jns_kelamin,$spesialis,$kode_dokter));
            Database::disconnect();
            header("Location: crud.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_dokter where kode_dokter = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($kode_dokter));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $nama_dokter = $data['nama_dokter'];
        $jns_kelamin = $data['jns_kelamin'];
        $spesialis = $data['spesialis'];
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
                        <h3>Update a Dokter</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?kode_dokter=<?php echo $kode_dokter?>" method="post">
                      <div class="control-group <?php echo !empty($nama_dokterError)?'error':'';?>">
                        <label class="control-label">Nama Dokter</label>
                        <div class="controls">
                            <input name="nama_dokter" type="text"  placeholder="Nama Dokter" value="<?php echo !empty($nama_dokter)?$nama_dokter:'';?>">
                            <?php if (!empty($nama_dokterError)): ?>
                                <span class="help-inline"><?php echo $nama_dokterError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($jns_kelaminError)?'error':'';?>">
                        <label class="control-label">Jenis Kelamin</label>
                        <div class="controls">
                            <input name="jns_kelamin" type="text" placeholder="Jenis Kelamin" value="<?php echo !empty($jns_kelamin)?$jns_kelamin:'';?>">
                            <?php if (!empty($jns_kelaminError)): ?>
                                <span class="help-inline"><?php echo $jns_kelaminError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($spesialisError)?'error':'';?>">
                        <label class="control-label">Spesialis</label>
                        <div class="controls">
                            <input name="spesialis" type="text"  placeholder="Spesialis" value="<?php echo !empty($spesialis)?$spesialis:'';?>">
                            <?php if (!empty($spesilaisError)): ?>
                                <span class="help-inline"><?php echo $spesialisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
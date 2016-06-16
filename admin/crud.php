

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
            <p>
           <a href="create.php" class="btn btn-success">Create</a>

            </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nama Dokter</th>
                      <th>Jenis Kelamin</th>
                      <th>Spesialis</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include '../config/database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM tb_dokter ORDER BY kode_dokter DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['nama_dokter'] . '</td>';
                            echo '<td>'. $row['jns_kelamin'] . '</td>';
                            echo '<td>'. $row['spesialis'] . '</td>';
                             echo '<td width=250>';
                                echo '<a class="btn" href="read.php?kode_dokter='.$row['kode_dokter'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?kode_dokter='.$row['kode_dokter'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?kode_dokter='.$row['kode_dokter'].'">Delete</a>';
                             echo'</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>
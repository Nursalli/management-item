<?php
require_once __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

try {
    if($_COOKIE['X-PZN-SESSION']){
        $jwt = $_COOKIE['X-PZN-SESSION'];
        
        $payload = JWT::decode($jwt, new Key('HALAMADRID', 'HS256'));
        
        if($payload->sub === 'admin' && $payload->role === 'admin super'){
            // return true;
        }else{
            throw new Exception("User is not login");
        }
    } else {
        throw new Exception("User is not login");
    }
} catch (Exception $exception) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Management Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <a href="#" class="btn btn-danger mt-4" id="logout">Logout</a>
        <h1 class="mt-4">Data Barang</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Barang</li>
        </ol>
        <div class="card mb-4">
            <div class="car-title">
                <div class="row">
                    <div class="col-md-4">
                        <!-- alert -->
                    </div>
                </div>
            </div>
            <div class="card-header">
                <a href="#" class="btn btn-success tambahBarang" title="Tambah Barang" data-toggle="modal" data-target="#modalForm">
                    <i class="fas fa-plus"></i> Tambah Barang
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-white bg-dark">
                            <tr>
                                <th>No</th>
                                <th>Foto Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- data -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal Form -->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="data" method="POST" enctype="multipart/form-data">
                        <div class="alert alert-danger" id="error" role="alert" style="display: none;">
                        </div>
                        <div class="form-group">
                            <label for="foto_barang">Foto Barang:</label>
                            <!-- <input id="foto_barang" name="foto_barang" type="file"> -->
                            <div class="custom-file">
                                <input id="foto_barang" name="foto_barang" type="file" class="custom-file-input">
                                <label for="foto_barang" class="custom-file-label text-truncate">Pilih file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang...">
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli:</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Masukkan Harga Beli...">
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual:</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual...">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok:</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Jumlah Stok...">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End The Modal Form -->

    <!-- The Modal Delete -->
    <div class="modal modal-danger fade" id="modalHapus" role="dialog" aria-labelledby="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="judulModal">Hapus Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span data-feather="x"><span>&times;</span></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <form action="#" method="post"> -->
                    <p class="text-center">
                        Apakah Anda Yakin ?
                    <p id="keteranganModal"></p>
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                    <input type="submit" class="btn btn-danger" name="submit" value="Yes">
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
    <!-- End The Modal Delete -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="assets/js/script.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</body>

</html>
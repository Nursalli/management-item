<?php header('Access-Control-Allow-Origin: *'); ?>
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
                <a href="#" class="btn btn-success" title="Tambah Barang">
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

    <!-- The Modal -->
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
    <!-- End The Modal -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    <script src="assets/js/script.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

</body>

</html>
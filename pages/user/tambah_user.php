<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Pengguna</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data</h3>
                    </div>
                    <!-- form start -->
                    <form id="tambahUser" method="post" action="proses/user/proses_tambah_user.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Nama Pengguna</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Masukan nama pengguna...">
                            </div>
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukan email...">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Handphone</label>
                                <input type="tel" name="no_hp" class="form-control" id="no_hp" placeholder="Masukan nomor handphone...">
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukan kata sandi...">
                            </div>
                            <div class="form-group">
                                <label for="retype_password">Ulangi Kata Sandi</label>
                                <input type="password" name="retype_password" class="form-control" id="retype_password" placeholder="Ketik ulang kata sandi...">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content -->

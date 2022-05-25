                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Form Edit Gejala</h1>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Gejala/edit'); ?>">
                                <?php foreach ($data as $d) : ?>
                                    <div class="form-group">
                                        <label for="id_gejala">Id Gejala</label>
                                        <input type="text" class="form-control" name="id_gejala" id="id_gejala" value="<?= $d['id_gejala']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Gejala</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama_gejala']; ?>" required>
                                    </div>
                                <?php endforeach; ?>
                                <Button class="btn btn-primary mb-3">Edit gejala</Button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Form Tambah Gejala</h1>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <?php if ($id['id'] == null) : $a = '0'; ?>
                        <?php else : ?>
                            <!-- <?php $a = str_split($id['id']); ?> -->
                            <?php $a = (int)$id['id']; ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Gejala/tambah'); ?>">
                                <div class="form-group">
                                    <label for="id">Id Gejala</label>
                                    <input type="text" class="form-control" id="id" name="id" value="G<?= $a + 1; ?>" required readonly>
                                    <input type="hidden" class="form-control" id="no" name="no" value="<?= $a + 1; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Gejala</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <Button class="btn btn-primary mb-3">Tambah gejala</Button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
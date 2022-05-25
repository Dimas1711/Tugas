                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Form Tambah Hama</h1>

                    <!-- DataTales Example -->

                    <div class="card shadow mb-4">
                        <?php if ($id['id'] == null) : $a = '0'; ?>
                        <?php else : ?>
                            <!-- <?php $a = str_split($id['id']); ?> -->
                            <?php $a = (int)$id['id']; ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Hama/tambah'); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id">Id Hama</label>
                                    <input type="text" class="form-control" name="id" id="id" value="H<?= $a + 1; ?>" readonly>
                                    <input type="hidden" class="form-control" id="no" name="no" value="<?= $a + 1; ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Hama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="solusi">Solusi</label>
                                    <textarea class="form-control" id="solusi" name="solusi" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Pilih Foto</label><br>
                                    <input type="file" name="foto">
                                </div>
                                <Button class="btn btn-primary mb-3">Tambah hama</Button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>

                <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('solusi');
                    CKEDITOR.config.autoParagraph = false;
                </script>
                <style>
                    #cke_solusi {
                        width: 100% !important;
                    }
                </style>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Penilaian</h1>
                    <p class="mb-4">Silahkan pilih gejala - gejala yang muncul</p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Gejala</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Penilaian/hitung'); ?>">
                                <?php foreach ($data as $d) : ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala[]" id="<?= $d['id_gejala']; ?>" value="<?= $d['id_gejala']; ?>">
                                        <label class="form-check-label" for="<?= $d['id_gejala']; ?>">
                                            <?= $d['id_gejala']; ?> - <?= $d['nama_gejala']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                <Button class="btn btn-primary mt-3">Hitung</Button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>

                <div class="modal fade" id="hapus-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Data Gejala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">Apakah Anda yakin untuk menghapus data?</div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                                <a class="btn btn-danger" id="delete_link" type="button" href="">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    function confirm_modal(delete_url) {
                        console.log(delete_url);
                        document.getElementById('delete_link').setAttribute('href', delete_url);
                        $('#hapus-data').modal('show', {
                            backdrop: 'static'
                        });
                    }
                </script>
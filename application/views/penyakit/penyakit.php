                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Penyakit</h1>
                    <p class="mb-4">Berikut ini adalah daftar penyakit yang menyerang pada tanaman anggek bulan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <a class="btn btn-primary mb-3" href="<?= base_url('Penyakit/tambahpenyakit'); ?>">Tambah penyakit</a>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Penyakit</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Penyakit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d['nama_hama_penyakit']; ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="<?= base_url('Penyakit/detail/' . $d['id_hama_penyakit']); ?>">Detail</a>
                                                    <a class="btn btn-warning" href="<?= base_url('Penyakit/pertanyaan/' . $d['id_hama_penyakit']); ?>">Pertanyaan</a>
                                                    <a class="btn btn-success" href="<?= base_url('Penyakit/edit/' . $d['id_hama_penyakit']); ?>">Edit</a>
                                                    <a class="btn btn-danger" href="" onclick="confirm_modal('<?= base_url('Penyakit/hapus/' . $d['id_hama_penyakit']) ?>')" data-toggle="modal" data-target="#hapus-data">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>

                <div class="modal fade" id="hapus-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Data Penyakit</h4>
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
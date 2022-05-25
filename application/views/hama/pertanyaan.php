                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hama Detail</h1>
                    <p class="mb-4">Berikut ini adalah daftar hama yang menyerang pada tanaman anggek bulan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Hama/tambahpertanyaan'); ?>">
                                <?php foreach ($data as $d) : ?>
                                    <input type="hidden" name="id_hama_penyakit" id="id_hama_penyakit" value="<?= $d['id_hama_penyakit']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama Hama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama_hama_penyakit']; ?>" required readonly>
                                    </div>
                                <?php endforeach; ?>
                                <div class="form-group">
                                    <label for="kondisi_tanaman">Kondisi Tanaman</label>
                                    <select name="kondisi_tanaman" id="kondisi_tanaman" class="form-control" required>
                                        <option value="">Pilih Kondisi Tanaman</option>
                                        <!-- <option value="1">Mati</option> -->
                                        <option value="2">Memburuk</option>
                                        <option value="3">Membaik</option>
                                        <!-- <option value="4">Sembuh</option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pertanyaan">Pertanyaan</label>
                                    <input class="form-control" type="text" name="pertanyaan" id="pertanyaan">
                                </div>
                                <div class="form-group">
                                    <label for="solusi">Solusi</label>
                                    <textarea class="form-control" id="solusi" name="solusi" cols="30" rows="10" required></textarea>
                                </div>
                                <Button class="btn btn-primary mb-3">Tambah pertanyaan</Button>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php foreach ($data as $d) : ?>
                                <h6 class="m-0 font-weight-bold text-primary">List Pertanyaan Dari <?= $d['nama_hama_penyakit']; ?></h6>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Kondisi Tanaman</th>
                                            <th>Solusi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($pertanyaan as $p) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $p['pertanyaan']; ?></td>
                                                <?php if ($p['kondisi_tanaman'] == 2) : ?>
                                                    <td>Memburuk</td>
                                                <?php elseif ($p['kondisi_tanaman'] == 3) : ?>
                                                    <td>Membaik</td>
                                                <?php endif; ?>
                                                <td><?= $p['solusi']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href="" onclick="confirm_modal('<?= base_url('Hama/hapuspertanyaan/' . $p['id_pertanyaan']) ?>')" data-toggle="modal" data-target="#hapus-data">Hapus</a>
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
                                <h4 class="modal-title">Hapus Data Pertanyaan</h4>
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
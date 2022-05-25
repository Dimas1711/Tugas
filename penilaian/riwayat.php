                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Riwayat Perhitungan</h1>
                    <p class="mb-4">Berikut ini adalah hasil riwayat dari perhitungan yang sudah dilakukan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Riwayat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Gejala dipilih</th>
                                            <th>Hasil terkena hama / penyakit</th>
                                            <th>Persentase</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= date('d F Y', strtotime($d['date'])); ?> <?= $d['time']; ?></td>
                                                <td>
                                                    <?php
                                                    $id_riwayat = $d['id_riwayat'];
                                                    $gejala = $this->db->query("SELECT * FROM detail_riwayat, gejala WHERE detail_riwayat.id_gejala = gejala.id_gejala AND id_riwayat = '$id_riwayat'")->result_array();
                                                    ?>
                                                    <?php foreach ($gejala as $g) : ?>
                                                        <table>
                                                            <td>- <?= $g['nama_gejala']; ?></td>
                                                        </table>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $id_riwayat = $d['id_riwayat'];
                                                    $hasil = $this->db->query("SELECT DISTINCT hasil.id_riwayat, hasil.id_hama_penyakit, hama_penyakit.nama_hama_penyakit, hasil.persentase FROM hasil, hama_penyakit WHERE hasil.id_hama_penyakit = hama_penyakit.id_hama_penyakit AND hasil.id_riwayat = '$id_riwayat' ORDER BY persentase DESC")->row();
                                                    ?>
                                                    <?= $hasil->nama_hama_penyakit; ?>
                                                </td>
                                                <td><?= $hasil->persentase; ?> %</td>
                                                <td>
                                                    <a class="btn btn-success" href="<?= base_url('Riwayat/detail/' . $d['id_riwayat']); ?>">Detail</a>
                                                    <a class="btn btn-danger" href="" onclick="confirm_modal('<?= base_url('Riwayat/hapus/' . $d['id_riwayat']) ?>')" data-toggle="modal" data-target="#hapus-data">Hapus</a>
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
                                <h4 class="modal-title">Hapus Data Riwayat</h4>
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
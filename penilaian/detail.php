                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Detail Hasil</h1>
                    <p class="mb-4">Berikut ini adalah detail hasil perhitungan dari gejala - gejala yang dipilih </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <div class="row">
                        <?php foreach ($data as $d) : ?>
                            <div class="col-md-3">
                                <img src="<?= base_url($d['foto']); ?>" alt="">
                            </div>
                            <div class="col-md-6">
                                <p>Nama Hama / Penyakit : <span style="font-weight: bold;"><?= $d['nama_hama_penyakit']; ?></span></p>
                                <p>Gejala :</p>
                                <?php foreach ($gejala as $g) : ?>
                                    <span style="font-weight: bold;"> - <?= $g['nama_gejala']; ?></span><br>
                                <?php endforeach; ?>
                                <p style="margin-top: 8px;">Persentase Perhitungan : <span style="font-weight: bold;"><?= $persen; ?>%</span></p>
                            </div>
                            <div class="col-md-12 ml-2">
                                <?= $d['solusi']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
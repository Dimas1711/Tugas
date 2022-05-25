                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hasil Perhitungan</h1>
                    <p class="mb-4">Berikut ini adalah hasil perhitungan dari gejala - gejala yang dipilih </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Hasil 5 Teratas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Penyakit</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($arrayteratas as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d['nama_hama_penyakit']; ?></td>
                                                <td><?= $d['persentase']; ?> %</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Hasil</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Penyakit</th>
                                            <th>Hasil</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($arraynya as $d) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $d[0]; ?></td>
                                                <td><?= $d[2]; ?> %</td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="detail" data-id="<?= $d[1]; ?>" data-persen="<?= $d[2]; ?>" data-nama="<?= $d[0]; ?>">Detail</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Hasil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <!-- Page Heading -->
                                        <p class="mb-4">Berikut ini adalah detail hasil perhitungan dari gejala - gejala yang dipilih </p>
                                        <div><?php echo $this->session->flashdata('message') ?></div>
                                        <div class="flex-row">
                                            <div class="col-md-12">
                                                <img class="rounded mx-auto d-block" src="" alt="" id="foto">
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <p>Nama Hama / Penyakit : <span style="font-weight: bold;" id="namanya"></span></p>
                                                <p class="mb-1">Gejala :</p>
                                                <div id="gejala" style="font-weight: bold;"></div>
                                                <br>
                                                <p class="mb-1">Gejala yang dipilih:</p>
                                                <?php foreach ($gejalapilih as $ge) : ?>
                                                    <?php $gejalanya = $this->db->query("SELECT * FROM gejala WHERE id_gejala = '$ge'")->result_array(); ?>
                                                    <?php foreach ($gejalanya as $gj) : ?>
                                                        - <span style="font-weight: bold;"><?= $gj['nama_gejala']; ?></span><br>
                                                    <?php endforeach; ?>
                                                <?php endforeach; ?>
                                                <p style="margin-top: 10px;">Persentase Perhitungan : <span style="font-weight: bold;" id="persentase"></span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="solusi"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <script>
                    $(document).on("click", "#detail", function() {
                        var id = $(this).data('id');
                        var persen = $(this).data('persen');
                        var nama = $(this).data('nama');
                        var spannama = document.getElementById('namanya');
                        var spanpersen = document.getElementById('persentase');
                        while (spannama.firstChild) {
                            spannama.removeChild(spannama.firstChild);
                        }
                        spannama.appendChild(document.createTextNode(nama));
                        while (spanpersen.firstChild) {
                            spanpersen.removeChild(spanpersen.firstChild);
                        }
                        spanpersen.appendChild(document.createTextNode(persen + "%"));
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Penilaian/detail'); ?>",
                            data: {
                                'id': id
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var baseUrl = "http://localhost/Skripsi/"
                                $('#foto').attr("src", baseUrl + data[0].foto)
                                $('#solusi').html(data[0].solusi)
                            },
                        });
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Penilaian/detailgejala'); ?>",
                            data: {
                                'id': id
                            },
                            dataType: "json",
                            success: function(data) {
                                var isi = '';
                                for (var i = 0; i < data.length; i++) {
                                    isi +=
                                        '-' + " " + data[i].nama_gejala + '<br>'
                                }
                                $('#gejala').html(isi)
                            },
                        });
                    });
                </script>
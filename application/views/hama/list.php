                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Hama</h1>
                    <p class="mb-4">Berikut ini adalah daftar hama yang menyerang pada tanaman anggek bulan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Hama</h6>
                        </div>
                        <div class="card-body">
                            <div class="row ml-3 mr-3">
                                <?php foreach ($data as $d) : ?>
                                    <div class="card ml-3 mr-3 mt-3" style="width: 18rem;">
                                        <img src="<?= base_url($d['foto']); ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $d['nama_hama_penyakit']; ?></h5>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="detail" data-id="<?= $d['id_hama_penyakit']; ?>" data-nama="<?= $d['nama_hama_penyakit']; ?>">Detail</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Hama</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <!-- Page Heading -->
                                    <p class="mb-4">Berikut ini adalah detail hama beserta gejala dan solusinya </p>
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

                <script>
                    $(document).on("click", "#detail", function() {
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        var spannama = document.getElementById('namanya');
                        while (spannama.firstChild) {
                            spannama.removeChild(spannama.firstChild);
                        }
                        spannama.appendChild(document.createTextNode(nama));
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Hama/detailhama'); ?>",
                            data: {
                                'id': id
                            },
                            dataType: "json",
                            success: function(data) {
                                var baseUrl = "http://localhost/Skripsi/"
                                $('#foto').attr("src", baseUrl + data[0].foto)
                                $('#solusi').html(data[0].solusi)
                            },
                        });
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Hama/detailgejala'); ?>",
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
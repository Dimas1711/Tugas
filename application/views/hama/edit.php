                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Hama</h1>
                    <p class="mb-4">Berikut ini adalah hama yang menyerang pada tanaman anggek bulan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Hama/editnya'); ?>" enctype="multipart/form-data">
                                <?php foreach ($data as $d) : ?>
                                    <input type="hidden" name="id_hama_penyakit" id="id_hama_penyakit" value="<?= $d['id_hama_penyakit']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama Hama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama_hama_penyakit']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="solusi">Solusi</label>
                                        <textarea class="form-control" id="solusi" name="solusi" cols="30" rows="10" required><?= $d['solusi']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto</label><br>
                                        <img src="<?= base_url($d['foto']); ?>" alt="" width="200">
                                        <br>
                                        <br>
                                        <label for="">Pilih Foto Baru</label><br>
                                        <input type="file" name="foto">
                                    </div>
                                <?php endforeach; ?>
                                <Button class="btn btn-primary mb-3">Edit hama</Button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#gejala").select2({
                            data: getData()
                        }).on('change', function(e) {
                            // idKey = $("#supplier").val();
                            // getFilterData2(idKey);
                        });
                    });

                    function getData() {
                        $.ajax({
                            url: "<?php echo base_url() . "Hama/gejala" ?>",
                            dataType: "json",
                            success: function(data) {
                                var html = '<option value="">' + " Pilih Gejala Part " + '</option>';
                                var no = 1;
                                for (var i = 0; i < data.length; i++) {
                                    html += '<option value="' + data[i].id_gejala + '">' + data[i].nama_gejala + '</option>';
                                }
                                $('#gejala').html(html);
                            },
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
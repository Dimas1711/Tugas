                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Hama Detail</h1>
                    <p class="mb-4">Berikut ini adalah daftar hama yang menyerang pada tanaman anggek bulan </p>
                    <div><?php echo $this->session->flashdata('message') ?></div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('Hama/tambahdetail'); ?>">
                                <?php foreach ($data as $d) : ?>
                                    <input type="hidden" name="id_hama_penyakit" id="id_hama_penyakit" value="<?= $d['id_hama_penyakit']; ?>">
                                    <div class="form-group">
                                        <label for="nama">Nama Hama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $d['nama_hama_penyakit']; ?>" required readonly>
                                    </div>
                                <?php endforeach; ?>
                                <div class="form-group">
                                    <label for="gejala">Gejala</label>
                                    <select name="gejala" id="gejala" class="form-control" required>
                                        <option value="">Pilih gejala</option>
                                        <?php foreach ($gejala as $g) : ?>
                                            <option value="<?= $g['id_gejala']; ?>"><?= $g['id_gejala']; ?> - <?= $g['nama_gejala']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <select name="bobot" id="bobot" class="form-control" required>
                                        <option value="">Pilih bobot</option>
                                        <option value="0.1">0.1</option>
                                        <option value="0.2">0.2</option>
                                        <option value="0.3">0.3</option>
                                        <option value="0.4">0.4</option>
                                        <option value="0.5">0.5</option>
                                        <option value="0.6">0.6</option>
                                        <option value="0.7">0.7</option>
                                        <option value="0.8">0.8</option>
                                        <option value="0.9">0.9</option>
                                        <option value="1.0">1.0</option>
                                    </select>
                                </div>
                                <Button class="btn btn-primary mb-3">Tambah gejala hama</Button>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <?php foreach ($data as $d) : ?>
                                <h6 class="m-0 font-weight-bold text-primary">List Gejala Dari <?= $d['nama_hama_penyakit']; ?></h6>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gejala</th>
                                            <th>Bobot</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($datadetail as $dd) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $dd['nama_gejala']; ?></td>
                                                <td><?= $dd['bobot']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" href="" onclick="confirm_modal('<?= base_url('Hama/hapusdetail/' . $dd['id_detail']) ?>')" data-toggle="modal" data-target="#hapus-data">Hapus</a>
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
                                <h4 class="modal-title">Hapus Data Hama</h4>
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

                    function confirm_modal(delete_url) {
                        console.log(delete_url);
                        document.getElementById('delete_link').setAttribute('href', delete_url);
                        $('#hapus-data').modal('show', {
                            backdrop: 'static'
                        });
                    }
                </script>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Detail Riwayat</h1>
    <p class="mb-4">Berikut ini adalah detail riwayat</p>
    <div><?php echo $this->session->flashdata('message') ?></div>
    <div class="card">
        <img src="<?= base_url($hama_penyakit->foto); ?>" class="card-img-top" style="width: 18rem; display: block; margin-left: auto; margin-right: auto; margin-top: 20px" alt="...">
        <div class="card-body">
            <h5 class="card-title">Hama / Penyakit : <?= $hama_penyakit->nama_hama_penyakit; ?></h5>
            <p class="card-text">Persentase : <?= $hama_penyakit->persentase; ?>%</p>
            <p class="card-text">Gejala :</p>
            <?php
            $gejala = $this->db->query("SELECT * FROM gejala, detail WHERE detail.id_gejala = gejala.id_gejala AND detail.id_hama_penyakit = '$hama_penyakit->id_hama_penyakit'")->result_array();
            ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($gejala as $g) : ?>
                    <li class="list-group-item">- <?= $g['nama_gejala']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-body">
            <p class="card-text">Gejala yang dipilih :</p>
            <ul class="list-group list-group-flush">
                <?php foreach ($gejalapilih as $gp) : ?>
                    <li class="list-group-item">- <?= $gp['nama_gejala']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-body">
            <?php
            $hamapenyakit = $this->db->query("SELECT * FROM hama_penyakit WHERE id_hama_penyakit = '$hama_penyakit->id_hama_penyakit'")->row();
            ?>
            <div class="mb-5">
                <?= $hamapenyakit->solusi; ?>
            </div>
            <?php if ($kondisinya) : ?>
                <?php if ($kondisinya->status == 2 || $kondisinya->status == 3) : ?>
                    <h5 class="card-title">Jadwal Penanganan Tanaman</h5>
                    <?php $now = date('d-m-Y'); ?>
                    <p class="card-text">Apa yang terjadi pada tanaman pada hari ini tanggal <?= $now; ?> setelah dilakukan solusi tersebut</p>
                <?php endif; ?>
            <?php else : ?>
                <h5 class="card-title">Jadwal Penanganan Tanaman</h5>
                <?php $now = date('d-m-Y'); ?>
                <p class="card-text">Apa yang terjadi pada tanaman pada hari ini tanggal <?= $now; ?> setelah dilakukan solusi tersebut</p>
            <?php endif; ?>
            <form action="<?= base_url('Riwayat/editpenanganan'); ?>" method="POST">
                <input type="hidden" name="id_hama_penyakit" id="id_hama_penyakit" value="<?= $hama_penyakit->id_hama_penyakit; ?>">
                <input type="hidden" name="id_riwayat" id="id_riwayat" value="<?= $hama_penyakit->id_riwayat; ?>">
                <?php if ($kondisinya) : ?>
                    <?php if ($kondisinya->status == 2 || $kondisinya->status == 3) : ?>
                        <input type="hidden" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>">
                        <select class="custom-select" name="penanganan" id="penanganan" required>
                            <option value="">Pilih hasil</option>
                            <option value="1">Tanaman Mati</option>
                            <option value="2">Tanaman Memburuk</option>
                            <option value="3">Tanaman Membaik</option>
                            <option value="4">Tanaman Sembuh</option>
                        </select>
                        <p class="card-text mt-2" name="pernyataan">Silahkan pilih apa yang terjadi pada tanaman</p>
                        <div id="lanjut"></div>
                        <button type="submit" class="btn btn-primary mb-5 mt-3">Simpan</button>
                    <?php endif; ?>
                <?php else : ?>
                    <input type="hidden" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>">
                    <select class="custom-select" name="penanganan" id="penanganan" required>
                        <option value="">Pilih hasil</option>
                        <option value="1">Tanaman Mati</option>
                        <option value="2">Tanaman Memburuk</option>
                        <option value="3">Tanaman Membaik</option>
                        <option value="4">Tanaman Sembuh</option>
                    </select>
                    <p class="card-text mt-2" name="pernyataan">Silahkan pilih apa yang terjadi pada tanaman</p>
                    <div id="lanjut"></div>
                    <button type="submit" class="btn btn-primary mb-5 mt-3">Simpan</button>
                <?php endif; ?>
            </form>
            <div id='calendar'></div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penanganan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <p class="mb-4">Berikut ini adalah detail penanganan dan solusinya </p>
                    <div class="flex-row">
                        <div class="col-md-12 mt-2">
                            <p>Kondisi tanaman : <span style="font-weight: bold;" id="namanya"></span></p>
                            <p>Pertanyaan dipilih : <span style="font-weight: bold;"></p>
                            <div id="pertanyaanmodal" style="font-weight: bold;"></div>
                            <br>
                            <p class="mb-1">Solusi :</p>
                            <div id="solusimodal" style="font-weight: bold;"></div>
                            <br>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var id_riwayat = document.getElementById('id_riwayat').value;
        $.ajax({
            type: "POST",
            url: "<?= base_url('Riwayat/penanganan'); ?>",
            data: {
                'id': id_riwayat
            },
            dataType: "json",
            success: function(data) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap',
                    events: data,
                    eventClick: function(info) {
                        // spannama.appendChild(document.createTextNode(info.event.title));
                        var title = info.event.title;
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Riwayat/detailpenanganan'); ?>",
                            data: {
                                'id': info.event.id
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var html = '';
                                if (data == 0) {
                                    $('#pertanyaanmodal').html('<p><span style="font-weight: bold;"> - </p>');
                                    $('#namanya').html(title);
                                } else {
                                    for (i = 0; i < data.length; i++) {
                                        var isipertanyaan = data[i].pertanyaan;
                                        var isisolusi = data[i].solusi;
                                        html += '<p><span style="font-weight: bold;">' + "-" + isipertanyaan + '</p>'
                                    }
                                    $('#pertanyaanmodal').html(html);
                                    $('#namanya').html(title);
                                }
                            },
                        });
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Riwayat/detailsolusi'); ?>",
                            data: {
                                'id': info.event.id
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                var html2 = '';
                                if (data == 0) {
                                    $('#solusimodal').html('<p><span style="font-weight: bold;"> - </p>');
                                } else {
                                    for (i = 0; i < data.length; i++) {
                                        var isisolusi = data[i].solusi;
                                        html2 += '<p><span style="font-weight: bold;">' + "-" + isisolusi + '</p>'
                                    }
                                    $('#solusimodal').html(html2);
                                }
                            },
                        });
                        $('#staticBackdrop').modal('show');
                    }
                });
                calendar.render();
            },
        });
    });
    $(document).ready(function() {
        $('p[name="pernyataan"]').hide();
        $('#penanganan').change(function() {
            var id_hama_penyakit = document.getElementById('id_hama_penyakit').value;
            var kondisi = document.getElementById('penanganan').value;
            $.ajax({
                type: "POST",
                url: "<?= base_url('Riwayat/pertanyaan'); ?>",
                data: {
                    'id': id_hama_penyakit,
                    'kondisi': kondisi,
                },
                dataType: "json",
                success: function(data) {
                    var html = '';
                    console.log(data.length)
                    if (data.length == 0) {
                        $('p[name="pernyataan"]').hide();
                    } else {
                        $('p[name="pernyataan"]').show();
                        for (i = 0; i < data.length; i++) {
                            var isip = data[i].pertanyaan;
                            var isiinput = data[i].id_pertanyaan;

                            html += '<input class="form-check-input mt-3 ml-3" type="checkbox" id="' + isiinput + '" name="tanya[]" value="' + isiinput + '">' + '<label class="form-check-label ml-5 mt-2" for="' + isiinput + '">' + isip + '</label>' + '<br>'
                        }
                    }
                    $('#lanjut').html(html);
                }
            })
        })
    })
</script>
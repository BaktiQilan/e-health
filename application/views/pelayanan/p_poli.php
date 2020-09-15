<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/index'); ?>">Pendaftaran Pasien Baru</a>
        </div>
        <div class="col-lg-4">
            <input class="form-control" id="cariPasien" type="text" placeholder="Cari Pasien...">
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 150px;max-width: 150px">No. Kartu Medis</th>
                        <th scope="col">NIK</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">Nama</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">TTL</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 150px;max-width: 150px">Jenis Poli</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 200px">Jadwal Pelaksanaan</th>
                        <th scope="col">Pengaturan</th>
                    </tr>
                </thead>
                <tbody id="tPasien">
                    <?php $i = 1; ?>
                    <?php foreach ($gpoly as $gp) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $gp['pid']; ?></td>
                        <td><?= $gp['nik']; ?></td>
                        <td><?= $gp['name']; ?></td>
                        <td><?= $gp['place'];?>, <?= date('d F Y', strtotime($gp['birth']));?></td>
                        <td><?= $gp['poly_name']; ?></td>
                        <td><?= date('d F Y', strtotime($gp['date'])); ?></td>
                        <td>
                            <a href="" class="badge badge-warning" data-toggle="modal" data-target="#edaftarPasienModal<?= $gp['id']; ?>">Penjadwalan Ulang</a>
                            <a href="<?= base_url('pelayanan/d_poli/'), $gp['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin ingin membatalkan pendaftaran poli atas nama pasien <?= $gp['name']; ?> ?')">Batalkan pendaftaran</a>
                            <a href="" class="badge badge-primary" data-toggle="modal" data-target="#bayarPasienModal<?= $gp['id']; ?>">Lakukan Pembayaran</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Penjadwalan ulang-->
<?php foreach ($gpoly as $egp) : ?>
    <div class="modal fade" id="edaftarPasienModal<?= $egp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="edaftanewPasienModal<?= $egp['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edaftarPasienModal">Daftar Pasien ke Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelayanan/editPoli/'.$egp['id']); ?>" method="post">
                    <div class="modal-body">  

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="pid">No. Kartu Medis</label>
                                <input readonly value="<?= $egp['patient_id']; ?>" class="form-control" id="pid" name="pid">
                            </div>
                                <input hidden readonly value="<?= $egp['id']; ?>" class="form-control" id="id" name="id">
                                <input hidden readonly value="<?= $egp['pid']; ?>" class="form-control" id="patient_id" name="patient_id">
                                <input hidden readonly value="<?= $egp['poly_id']; ?>" class="form-control" id="poly_id" name="poly_id">
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">NIK</label>
                                <input type="text" readonly value="<?= $egp['nik']; ?>" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="col">
                                <label for="name">Nama</label>
                                <input type="text" readonly value="<?= $egp['name']; ?>" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="poly">Poli</label>
                                <input type="text" readonly value="<?= $egp['poly_name']; ?>" class="form-control" id="poly" name="poly">
                            </div>
                            <div class="col">
                                <label for="pdate">Tanggal pelaksanaan</label>
                                <input type="date" value="<?= $egp['date']; ?>" class="form-control" id="pdate" name="pdate">
                                <?= form_error('pdate', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-info">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Lakukan Pembayaran-->
<?php foreach ($gpoly as $egp) : ?>
    <div class="modal fade" id="bayarPasienModal<?= $egp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="bayarnewPasienModal<?= $egp['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bayarPasienModal">Daftar Pasien ke Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelayanan/p_poli'); ?>" method="post">
                    <div class="modal-body">  

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="pid">No. Kartu Medis</label>
                                <input readonly value="<?= $egp['patient_id']; ?>" class="form-control" id="pid" name="pid">
                            </div>
                                <input hidden readonly value="<?= $egp['id']; ?>" class="form-control" id="id" name="id">
                                <input hidden readonly value="<?= $egp['pid']; ?>" class="form-control" id="patient_id" name="patient_id">
                                <input hidden readonly value="<?= $egp['poly_id']; ?>" class="form-control" id="poly_id" name="poly_id">
                            <div class="col">
                                <label for="pay_date">Waktu dan Tanggal</label>
                                <input type="text" readonly value="<?= $d->format('j F Y, g:i a') ?>" class="form-control" id="pay_date" name="pay_date">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">NIK</label>
                                <input type="text" readonly value="<?= $egp['nik']; ?>" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="col">
                                <label for="name">Nama</label>
                                <input type="text" readonly value="<?= $egp['name']; ?>" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="poly">Poli</label>
                                <input type="text" readonly value="<?= $egp['poly_name']; ?>" class="form-control" id="poly" name="poly">
                            </div>
                            <div class="col">
                                <label for="pdate">Tanggal pelaksanaan</label>
                                <input type="date" readonly value="<?= $egp['date']; ?>" class="form-control" id="pdate" name="pdate">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="cost3">Biaya Administrasi</label>
                                <input type="text" readonly value="<?= $egp['poly_cost']; ?>" class="form-control" id="cost3" name="cost3">
                                <?= form_error('cost3', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col">
                                <label for="cost4">Biaya Konsultasi</label>
                                <input type="text" class="form-control" id="cost4" name="cost4">
                                <?= form_error('cost4', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col">
                                <label for="cost5">Biaya Obat</label>
                                <input type="text" class="form-control" id="cost5" name="cost5">
                                <?= form_error('cost5', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-info">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



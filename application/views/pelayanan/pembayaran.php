<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/index'); ?>">Pendaftaran Pasien Baru</a>
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/excelBayar'); ?>" onclick="return confirm('Apakah anda ingin mengexport data pembayaran pasien kedalam file excel ?')">Export Data</a>
        </div>
        <div class="col-lg-4">
            <input class="form-control" id="cariPasien" type="text" placeholder="Cari Pasien...">
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
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
                        <th scope="col" style="word-wrap: break-word;min-width: 150px;max-width: 150px">Jenis Poli</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 200px">Waktu Check-out</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 150px;max-width: 150px">Total</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 150px;max-width: 150px">Status Pembayaran</th>
                        <th scope="col">Pengaturan</th>
                    </tr>
                </thead>
                <tbody id="tPasien">
                    <?php $i = 1; ?>
                    <?php foreach ($gpay as $g) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $g['pid']; ?></td>
                        <td><?= $g['nik']; ?></td>
                        <td><?= $g['name']; ?></td>
                        <td><?= $g['poly_name']; ?></td>
                        <td><?= $g['pay_date']; ?></td>
                        <td>Rp. <?= number_format($g['total'],2,',','.'); ?></td>
                        <td><?= $g['status']; ?></td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#ebayarPasienModal<?= $g['id']; ?>">Bayar</a>
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

<!-- Modal bayar-->
<?php foreach ($gpay as $gp) : ?>
    <div class="modal fade" id="ebayarPasienModal<?= $gp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ebayarnewPasienModal<?= $gp['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ebayarPasienModal">Lakukan Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelayanan/editBayar/'.$gp['id']); ?>" method="post">
                    <div class="modal-body">  

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="pid">No. Kartu Medis</label>
                                <input readonly value="<?= $gp['patient_id']; ?>" class="form-control" id="pid" name="pid">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">NIK</label>
                                <input type="text" readonly value="<?= $gp['nik']; ?>" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="col">
                                <label for="name">Nama</label>
                                <input type="text" readonly value="<?= $gp['name']; ?>" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="poly">Poli</label>
                                <input type="text" readonly value="<?= $gp['poly_name']; ?>" class="form-control" id="poly" name="poly">
                            </div>
                            <div class="col">
                                <label for="poly">Status</label>
                                <input type="text" readonly value="<?= $gp['status']; ?>" class="form-control" id="poly" name="poly">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="pdate">Waktu Check-Out</label>
                                <input type="text" readonly value="<?= $gp['pay_date']; ?>" class="form-control" id="pdate" name="pdate">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-info">Konfirmasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



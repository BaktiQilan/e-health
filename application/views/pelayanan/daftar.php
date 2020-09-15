<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/index'); ?>">Pendaftaran Pasien Baru</a>
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/p_poli'); ?>">Pendataan Pasien Poli</a>
        </div>
        <div class="col-lg-4">
            <input class="form-control" id="cariPasien" type="text" placeholder="Cari Pasien...">
        </div>
    </div>
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <?= validation_errors(); ?>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"style="word-wrap: break-word;min-width: 150px;max-width: 150px">No. Kartu Medis</th>
                        <th scope="col">NIK</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">Nama</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">TTL</th>
                        <th scope="col">Pengaturan</th>
                    </tr>
                </thead>
                <tbody id="tPasien">
                    <?php $i = 1; ?>
                    <?php foreach ($patient as $p) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['id']; ?></td>
                        <td><?= $p['nik']; ?></td>
                        <td><?= $p['name']; ?></td>
                        <td><?= $p['place'];?>, <?= date('d F Y', strtotime($p['birth']));?></td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#daftarPasienModal<?= $p['id']; ?>">daftar</a>
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

<!-- Modal daftar-->
<?php foreach ($patient as $ep) : ?>
    <div class="modal fade" id="daftarPasienModal<?= $ep['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editnewPasienModal<?= $ep['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarPasienModal">Daftar Pasien ke Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelayanan/daftarPatient/'.$ep['id']); ?>" method="post">
                    <div class="modal-body">
                                               
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">No. Kartu Medis</label>
                                <input readonly value="<?= $ep['id']; ?>" class="form-control" id="id" name="id">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">NIK</label>
                                <input type="text" readonly value="<?= $ep['nik']; ?>" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="col">
                                <label for="name">Nama</label>
                                <input type="text" readonly value="<?= $ep['name']; ?>" class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="poly">Poli</label>
                                <select name="poly" id="poly" class="form-control">
                                    <option selected disabled class="text-hide">Klik disini..</option>
                                    <?php foreach ($poly as $po) : ?>
                                    <option value="<?= $po['id']; ?>"><?= $po['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('poly', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="col">
                                <label for="pdate">Tanggal pelaksanaan</label>
                                <input type="date" class="form-control" id="pdate" name="pdate">
                                <?= form_error('pdate', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-info">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



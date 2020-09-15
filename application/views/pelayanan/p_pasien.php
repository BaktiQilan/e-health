<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/index'); ?>">Pendaftaran Pasien Baru</a>
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/daftar'); ?>">Pendaftaran ke Poli</a>
            <a class="btn btn-info  mb-3" href="<?= base_url('pelayanan/excel'); ?>" onclick="return confirm('Apakah anda ingin mengexport data pasien kedalam file excel ?')">Export Data</a>
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
                        <th scope="col"style="word-wrap: break-word;min-width: 150px;max-width: 150px">No. Kartu Medis</th>
                        <th scope="col">NIK</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">Nama</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 200px;max-width: 250px">TTL</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 125px;max-width: 125px">Jenis Kelamin</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 125px;max-width: 125px">Gol. Darah</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 300px;max-width: 600px;">Alamat</th>
                        <th scope="col">Agama</th>
                        <th scope="col" style="word-wrap: break-word;min-width: 175px;max-width: 175px">Status Perkawinan</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Kewarganegaraan</th>
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
                        <td><?= $p['gender']; ?></td>
                        <td><?= $p['blood_type']; ?></td>
                        <td><?= $p['address']; ?></td>
                        <td><?= $p['religion']; ?></td>
                        <td><?= $p['marital_status']; ?></td>
                        <td><?= $p['job']; ?></td>
                        <td><?= $p['nationality']; ?></td>
                        <td>
                            <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editPasienModal<?= $p['id']; ?>">edit</a>
                            <a href="<?= base_url('pelayanan/d_patient/'), $p['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin data pasien <?= $p['name']; ?> ingin dihapus?')">delete</a>
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

<!-- Modal edit-->
<?php foreach ($patient as $ep) : ?>
    <div class="modal fade" id="editPasienModal<?= $ep['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editnewPasienModal<?= $ep['id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasienModal">Ubah Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pelayanan/editPatient/'.$ep['id']); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" readonly value="<?= $ep['id']; ?>" class="form-control" id="id" name="id">
                        <div class="form-row form-group">
                            <div class="col">
                                <label for="nik">NIK</label>
                                <input type="text" value="<?= $ep['nik']; ?>" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="col">
                                <label for="name">Nama</label>
                                <input type="text" value="<?= $ep['name']; ?>" class="form-control" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="place">Tempat Lahir</label>
                                <input type="text" value="<?= $ep['place']; ?>" class="form-control" id="place" name="place">
                            </div>
                            <div class="col">
                                <label for="birth">Tanggal Lahir</label>
                                <input type="text" value="<?= $ep['birth'];?>" class="form-control" id="birth" name="birth">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" id="gender" name=gender>
                                    <option selected  class="text-hide" value="<?= $ep['gender']; ?>"><?= $ep['gender']; ?></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="blood">Golongan Darah</label>
                                <select class="form-control" id="blood" name="blood">
                                    <option selected  class="text-hide" value="<?= $ep['blood_type']; ?>"><?= $ep['blood_type']; ?></option>
                                    <option value ="A+">A+</option>
                                    <option value ="A-">A-</option>
                                    <option value ="B+">B+</option>
                                    <option value ="B-">B-</option>
                                    <option value ="AB+">AB+</option>
                                    <option value ="AB-">AB-</option>
                                    <option value ="O+">O+</option>
                                    <option value ="O-">O-</option>
                                    <option value ="-(tidak tahu)">-(tidak tahu)</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="address">Alamat</label>
                                <input type="text" value="<?= $ep['address']; ?>" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="religion">Agama</label>
                                <select class="form-control" id="religion" name="religion">
                                    <option selected  class="text-hide" value="<?= $ep['religion']; ?>"><?= $ep['religion']; ?></option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Konghucu">konghucu</option>
                                    <option value="Kristen">Kristen</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="marital">Status Perkawinan</label>
                                <select class="form-control" id="marital" name="marital">
                                    <option selected  class="text-hide" value="<?= $ep['marital_status']; ?>"><?= $ep['marital_status']; ?></option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="col">
                                <label for="job">Pekerjaan</label>
                                <input type="text" value="<?= $ep['job']; ?>" class="form-control" id="job" name="job">
                            </div>
                            <div class="col">
                                <label for="nationality">Kewarganegaraan</label>
                                <input type="text" value="<?= $ep['nationality']; ?>" class="form-control" id="nationality" name="nationality">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                         <button type="submit" class="btn btn-info">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>



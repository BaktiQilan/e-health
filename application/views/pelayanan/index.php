<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('pelayanan/index'); ?>" method="post">
                <div class="form-row form-group">
                    <div class="col">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik">
                        <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="col">
                        <label for="place">Tempat Lahir</label>
                        <input type="text" class="form-control" id="place" name="place">
                        <?= form_error('place', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="birth">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="birth" name="birth">
                        <?= form_error('birth', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                
                <div class="form-row form-group">
                    <div class="col">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control" id="gender" name=gender>
                            <option selected disabled class="text-hide">Klik disini..</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="blood">Golongan Darah</label>
                        <select class="form-control" id="blood" name="blood">
                            <option selected disabled class="text-hide">Klik disini..</option>
                            <option value ="A+">A+</option>
                            <option value ="A-">A-</option>
                            <option value ="B+">B+</option>
                            <option value ="B-">B-</option>
                            <option value ="AB+">AB+</option>
                            <option value ="AB-">AB-</option>
                            <option value ="O+">O+</option>
                            <option value ="O-">O-</option>
                            <option value ="- (tidak tahu)">- (tidak tahu)</option>
                        </select>
                        <?= form_error('blood', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col">
                        <label for="address">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address">
                        <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col">
                        <label for="religion">Agama</label>
                        <select class="form-control" id="religion" name="religion">
                            <option selected disabled class="text-hide">Klik disini..</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Konghucu">konghucu</option>
                            <option value="Kristen">Kristen</option>
                        </select>
                        <?= form_error('religion', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="marital">Status Perkawinan</label>
                        <select class="form-control" id="marital" name="marital">
                            <option selected disabled class="text-hide">Klik disini..</option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                        <?= form_error('marital', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-row form-group">
                    <div class="col">
                        <label for="job">Pekerjaan</label>
                        <input type="text" class="form-control" id="job" name="job">
                        <?= form_error('job', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col">
                        <label for="nationality">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="nationality" name="nationality">
                        <?= form_error('nationality', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" name="add" value="add" class="btn btn-info">Masukan data</button>
                </div>
            </form>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content --> 
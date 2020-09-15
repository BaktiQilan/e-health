<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-10">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger mx-auto" role="alert">
                    <?= validation_errors() ?>
                </div>
            <?php endif; ?>

            <?= form_error('admin/poli', '<div class="alert alert-danger mx-auto" role="alert">', '</div>') ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#newPoliModal">Tambah data poli baru</a>

            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis poli</th>
                        <th scope="col">Biaya Administrasi</th>
                        <th scope="col">Pengaturan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($poli as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>                          
                            <td><?= $p['name']; ?></td>
                            <td><?= $p['cost']; ?></td>
                            <td>
                                <a href="" class="badge badge-primary" data-toggle="modal" data-target="#editpoliModal<?= $p['id']; ?>">edit</a>
                                <a href="<?= base_url('admin/hapusP/'), $p['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin, data <?= $p['name']; ?> ingin dihapus?')">delete</a>
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

<!-- Modal Tambah -->

<div class="modal fade" id="newPoliModal" tabindex="-1" role="dialog" aria-labelledby="newPoliModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPoliModal">Tambah Data poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action=" <?= base_url('admin/poli'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Jenis poli">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="Biaya Administrasi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<?php $i = 0;
foreach ($poli as $p) : $i++; ?>
    <div class="modal fade" id="editpoliModal<?= $p['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editpoliModal<?= $p['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpoliModal">Edit role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=" <?= base_url('admin/editP'); ?> " method="post">
                    <div class="modal-body">
                        <input hidden type="text" value="<?= $p['id']; ?>" class="form-control" id="id" name="id" readonly>
                        <div class="form-group">
                            <input type="text" value="<?= $p['name']; ?>" class="form-control" id="name" name="name" placeholder="Jenis poli">
                        </div>
                        <div class="form-group">
                            <input type="text" value="<?= $p['cost']; ?>" class="form-control" id="cost2" name="cost2" placeholder="Biaya Administrasi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
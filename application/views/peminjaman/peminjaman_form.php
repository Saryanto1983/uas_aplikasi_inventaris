<section class="content-header">
    <h1>
    SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Peminjaman</a></li>
        <li class="active"><?php echo $button ?> Peminjaman</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <!-- Form input dan edit Peminjaman-->
            <legend><?php echo $button ?> Peminjaman</legend>
            <form role="form" class="form-horizontal" action="<?php echo $action; ?>" method="post"
                  enctype="multipart/form-data">
                
                <div class="form-group">
                    <label class="col-sm-2" for="int">No</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="no" id="no" placeholder="No"
                               value="<?php echo $no; ?>"/>
                        <?php echo form_error('no'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Nama Peminjam</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="namapeminjam" id="namapeminjam"
                               placeholder="Nama Peminjam" value="<?php echo $namapeminjam; ?>"/>
                        <?php echo form_error('namapeminjam') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Id Peminjam</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="idpeminjam" id="idpeminjam"
                               placeholder="Id Peminjam" value="<?php echo $idpeminjam; ?>"/>
                        <?php echo form_error('idpeminjam') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="int">Kode Barang </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kodebarang" id="kodebarang"
                                placeholder="Kode Barang" value="<?php echo $kodebarang; ?>"/>
                        <?php echo form_error('kodebarang') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="int">Tanggal Peminjaman </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="tanggalpeminjaman" id="tanggalpeminjaman" 
                        placeholder="Tanggal Peminjaman" value="<?php echo $tanggalpeminjaman; ?>"/>
                        <?php echo form_error('tanggalpeminjaman') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Kondisi Sebelum </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kondisisebelum" id="kondisisebelum" 
                        placeholder="Kondisi Sebelum" value="<?php echo $kondisisebelum; ?>"/>
                        <?php echo form_error('kondisisebelum') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Kondisi Sesudah </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kondisisesudah" id="kondisisesudah" 
                        placeholder="Kondisi Sesudah" value="<?php echo $kondisisesudah; ?>"/>
                        <?php echo form_error('kondisisesudah') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Keterangan </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="keterangan" id="keterangan"
                               placeholder="Keterangan" value="<?php echo $keterangan; ?>"/>
                        <?php echo form_error('keterangan') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('peminjaman') ?>" class="btn btn-default">Cancel</a>
            </form>
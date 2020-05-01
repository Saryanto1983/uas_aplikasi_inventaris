<section class="content-header">
    <h1>
        SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Barang</a></li>
        <li class="active"><?php echo $button ?> Barang</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <!-- Form input dan edit Barang-->
            <legend><?php echo $button ?> Barang</legend>
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
                    <label class="col-sm-2" for="varchar">Kode Barang</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kodebarang" id="kodebarang"
                               placeholder="Kode Barang" value="<?php echo $kodebarang; ?>"/>
                        <?php echo form_error('kodebarang') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Nama Barang </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="namabarang" id="namabarang"
                               placeholder="Nama Barang" value="<?php echo $namabarang; ?>"/>
                        <?php echo form_error('namabarang') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="int">Kode Merk </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kodemerk" id="kodemerk"
                                placeholder="Kode Merk" value="<?php echo $kodemerk; ?>"/>
                        <?php echo form_error('kodemerk') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="int">Kode Jenis </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kodejenis" id="kodejenis" placeholder="Kode Jenis"
                               value="<?php echo $kodejenis; ?>"/>
                        <?php echo form_error('kodejenis') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Jumlah </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah"
                               value="<?php echo $jumlah; ?>"/>
                        <?php echo form_error('jumlah') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Harga </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="harga" id="harga"
                               placeholder="Harga" value="<?php echo $harga; ?>"/>
                        <?php echo form_error('harga') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="varchar">Kondisi </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="kondisi" id="kondisi"
                               placeholder="Kondisi" value="<?php echo $kondisi; ?>"/>
                        <?php echo form_error('kondisi') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
            </form>
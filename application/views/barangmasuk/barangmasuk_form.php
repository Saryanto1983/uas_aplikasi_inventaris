<section class="content-header">
    <h1>
    SMA Negeri 1 Bandung
        <small>SMANSA BERSATU "BERiman, Santun, Agamis, Tekun Unggul" </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $back ?>">Barang Masuk</a></li>
        <li class="active"><?php echo $button ?> Barang Masuk</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">

            <!-- Form input dan edit barang masuk-->
            <legend><?php echo $button ?> Barang Masuk</legend>
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
                    <label class="col-sm-2" for="varchar">Jumlah </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah"
                               value="<?php echo $jumlah; ?>"/>
                        <?php echo form_error('jumlah') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2" for="date">Tanggal Masuk </label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="tanggalmasuk"
                               value="<?php echo isset($tanggalmasuk) ? set_value('tanggalmasuk', date('Y-m-d', strtotime($tanggalmasuk))) : set_value('tanggalmasuk'); ?>">
                        <?php echo form_error('tanggalmasuk') ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                <a href="<?php echo site_url('barangmasuk') ?>" class="btn btn-default">Cancel</a>
            </form>
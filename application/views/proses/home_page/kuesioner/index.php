<div class="content-wrapper">
  <section class="content-header">
    <h1>Home Page<small>Kuesioner</small></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Daftar Kuesioner</li>
    </ol>
  </section>
  <section class="content">
    <?php if ($this->session->flashdata('info')): ?>
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
        <?php echo $this->session->flashdata('info'); ?>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Daftar Kuesioner</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm tbl_add"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
                <table id="tabel_data" class="table table-bordered tabel_data">
                    <thead>
                        <tr>
                        <th style="width: 5%">No.</th>
                        <th style="width: 25%">Tema Kuesioner</th>
                        <th style="width: 10%">Kriteria</th>
                        <th style="width: 10%">Masa Aktif</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Display</th>
                        <th style="width: 10%">Responden</th>
                        <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $nom=1; 
                        $arr_disp = array("1"=>"Umum", "2"=>"Mahasiswa", "3"=>"Dosen", "4"=>"Pegawai");
                        foreach ($list as $dt): ?>
                        <?php $jml_responden = count($this->Model_kuesioner->get_jumlah_responden($dt['id'])); ?>
                        <tr>
                            <td><?php echo $nom;?></td>
                            <td><?php echo $dt['tema_kue'];?></td>
                            <td>
                                <?php
                                if($dt['kat_kue']==1) {
                                    echo "Skala Likert";
                                } elseif($dt['kat_kue']==2) {
                                    echo "Skala Gutman";
                                } else {
                                    echo "";
                                }
                                ?>
                            </td>
                            <td><?php echo convert_tanggal($dt['tgl_start'])." s/d ".convert_tanggal($dt['tgl_end']);?></td>
                            <td>
                                <?php if ($dt['status']==1): ?>
                                    Aktif
                                <?php elseif($dt['status']==3): ?>
                                    Belum Aktif
                                <?php else: ?>
                                    Tidak Aktif
                                <?php endif ?>
                            </td>
                            <td>
                                <?php
                                $i=0;
                                $jml_data=0;
                                $arr_dt_disp = explode(",", $dt['display']);
                                $jml_data = count($arr_dt_disp)-1;
                                //echo $jml_data;
                                foreach ($arr_disp as $key => $value) 
                                {
                                    for($i=0; $i<=(int)$jml_data; $i++)
                                    {
                                        if($arr_dt_disp[$i]==$key)
                                        {
                                            if($i==0)
                                            {
                                                $temp_disp = $value;
                                            }
                                            else {
                                                $temp_disp = $temp_disp.",".$value;
                                            }
                                        }
                                    }
                                }
                                echo $temp_disp; 
                                ?>
                            </td>
                            <td><?php echo $jml_responden;?> orang</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm m-1 tbl_edit" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="icon-note icons"></i> Edit</button>
                                <button type="button" class="btn btn-danger btn-sm m-1 tbl_hapus" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="icon-close icons"></i> Hapus</button>
                                <button type="button" class="btn btn-info btn-sm m-1 tbl_print" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="icon-printer icons"></i> Print</button><br>
                                <button type="button" class="btn btn-warning btn-sm m-1 tbl_list" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="icon-list icons"></i> List Pertanyaan</button>
                                <button type="button" class="btn btn-white btn-sm m-1 tbl_hasil" id="<?php echo encrypt_decrypt('encrypt', $dt['id']);?>"><i class="icon-chart icons"></i> Hasil</button>

                            </td>
                        </tr>
                        <?php $nom++; endforeach ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
        $('#tabel_data').DataTable();
        $(".tbl_add").on("click", function()
        {
            var id_data = this.id;
            window.location.assign("<?php echo base_url();?>kuesioner/baru");
        });
        $(".tabel_data").on("click", ".tbl_list", function()
        {
            var id_data = this.id;
            window.location.assign("<?php echo base_url();?>kuesioner/pertanyaan/"+id_data);
        });
        $(".tabel_data").on("click", ".tbl_edit", function()
        {
            var id_data = this.id;
            window.location.assign("<?php echo base_url();?>kuesioner/edit_kuesioner_head/"+id_data);
        });

        $(".tabel_data").on("click", ".tbl_hasil", function()
        {
            var id_data = this.id;
            window.location.assign("<?php echo base_url();?>kuesioner/hasil_kuesioner/"+id_data);
        });
        $(".tabel_data").on("click", ".tbl_hapus", function()
        {
            var id_data = this.id;
            var msg = confirm("Yakin akan menghapus kuesioner ?");
            if (msg==true) 
            {
                $.ajax (
                {
                    url : "<?php echo site_url();?>kuesioner/hapus_kuesioner",
                    type : "post",
                    data : {id_data:id_data},
                    success : function(d)
                    {
                        alert(d);
                        window.location.assign("<?php echo base_url();?>kuesioner");
                    }
                 });
            }
            else
            {
                return false;
            }
        });
    });
</script>


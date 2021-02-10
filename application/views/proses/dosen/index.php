<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Resources</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dosen</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
        <?php if ($this->session->flashdata('konfirm')): ?>
            <div class="alert alert-info alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
              <?php echo $this->session->flashdata('konfirm'); ?>
            </div>
          <?php endif; ?> 
        <?php $nom=1; foreach ($dsn_all as $list): ?>
        <div class="col-md-4">
            <!-- Advanced Active Theme Color Widget Alternative -->
            <div class="widget">
                <div class="widget-advanced widget-advanced-alt">
                    <!-- Widget Header -->
                    <div class="widget-header text-center themed-background-dark">
                        <a href="#">
                            <?php if(empty($list['link_image'])) { ?>
                            <img src="<?php echo base_url();?>assets/dist/img/avatar1.jpg" alt="" class="widget-image img-circle">
                            <?php } else { ?>
                            <img src="<?php echo $list['link_image'];?>" alt="" class="widget-image img-circle" style="width: 128px; height: 128px" />
                            </a>
                            <?php }?>
                        </a>
                        <h4 class="widget-content-light">
                            <a class="btn btn-primary tbl_edit" data-toggle="modal" data-target="#modal-edit" title="Edit Data" id="<?php echo $list['id_dosen'];?>"><?php echo $list['nama_dosen'];?></a><br>
                            <small>NIDN : <?php echo $list['nidn'];?></small>
                        </h4>
                    </div>
                    <!-- END Widget Header -->
                    <!-- Widget Main -->
                    <div class="widget-main">
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <td style="width: 30%;"><strong>Pendidikan Terakhir</strong></td>
                                    <td><a href="javascript:void(0)"><?php echo $list['jenjang'];?></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><strong>Jabatan Fungsional</strong></td>
                                    <td><a href="javascript:void(0)"><?php echo $list['nama_jabfung'];?></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><strong>Jabatan Akademik</strong></td>
                                    <td><a href="javascript:void(0)"><?php echo $list['nama_jabatan'];?></a></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;"><strong>Status</strong></td>
                                    <td><a href="javascript:void(0)"><?php echo $list['status_dosen'];?></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END Widget Main -->
                </div>
            </div>
            <!-- END Advanced Active Theme Color Widget Alternative -->
        </div>
        <?php $nom++; endforeach ?>
    </div>
  </section>
</div>
<!-- Modal Edit -->
<div class="modal modal-primary fade" id="modal-edit" data-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Data</h4>
      </div>
      <div id="frm_modal"></div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function()
    {
      window.setTimeout(function() { $(".alert").alert('close'); }, 2000);
        $(".tbl_edit").on("click", function()
        {
          var id_data = this.id;
          $("#frm_modal").load("<?php echo base_url();?>dosen/edit_data/"+id_data);
        });
    });
</script>
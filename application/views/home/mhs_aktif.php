<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dasboard User</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">AKUN MAHASISWA</h3>
          </div>
          <?php if ($this->session->flashdata('konfirm')): ?>
            <div class="alert alert-info alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
              <?php echo $this->session->flashdata('konfirm'); ?>
            </div>
          <?php endif; ?>
          <div class="box-body table-responsive">
            <div class="search">
              <div class="space"></div>
                <form action="" method="get">

                  <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                      <div class="input-group">

                        <span class="input-group-addon" >CARI AKUN MAHASISWA</span>
                        <input autocomplete="off" id="search"  type="text" class="form-control input-lg" placeholder="Masukkan NIM yang anda cari" >

                      </div>
                    </div>
                  </div>   
                  <div class="space"></div>
                </form>
              </div>  
              <!-- search box container ends  -->
              <div id="txtHint" style="padding-top:50px; text-align:center;" ><b>Hasil pencarian akan tampil dibawah ...</b></div>
     
            <!--
            <table class="table tabel_list" width="100%">
              <thead>
                  <th>No.</th>
                  <th></th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Tgl. Reg</th>
                  <th>Tgl. Aktif</th>
                  <th>Status</th>
                  <th>
                    
                  </th>
              </thead>
              <tbody>
                <?php $nom=1; foreach ($mhs_all as $dt_mhs): ?>
                  <tr>
                    <td><?php echo $nom;?></td>
                    <td>
                      <?php if(empty($dt_mhs['img_profil'])) { ?>
                      <img class="direct-chat-img" src="<?php echo base_url();?>assets/dist/img/no_image.jpg" alt="" style="width: 60px; height: 60px; border-radius: 50%" />
                      <?php } else { ?>
                      <a href="https://mahasiswa.feb.unismuh.ac.id/assets/upload/profil/mhs/<?php echo $dt_mhs['img_profil'];?>" data-fancybox data-caption="Photo">
                      <img class="direct-chat-img" src="https://mahasiswa.feb.unismuh.ac.id/assets/upload/profil/mhs/<?php echo $dt_mhs['img_profil'];?>" alt="" style="width: 60px; height: 60px; border-radius: 50%" /></a>
                      <?php }?>
                    </td>
                    <td><?php echo $dt_mhs['nim'];?></td>
                    <td><?php echo $dt_mhs['nama_mahasiswa'];?></td>
                    <td><?php echo $dt_mhs['tgl_act'];?></td>
                    <td><?php echo $dt_mhs['tgl_aktif'];?></td>
                    <td>
                      <?php if ($dt_mhs['status']==1): ?>
                        <label class="label label-success">Aktif</label>
                      <?php else: ?>
                        <label class="label label-danger">Belum Aktif</label>
                      <?php endif ?>
                    </td>
                    <td>
                      <?php if ($dt_mhs['status']==0): ?>
                        <button type="button" class="btn btn-danger tbl_edit" data-toggle="modal" data-target="#modal-edit" title="Edit Akun" id="<?php echo $dt_mhs['id'];?>"><i class="fa fa-edit"></i> Edit Akun</button> 
                      <?php else : ?>
                        <button type="button" class="btn btn-danger tbl_reset" data-toggle="modal" data-target="#modal-reset" title="Reset Akun" id="<?php echo $dt_mhs['id'];?>"><i class="fa fa-lock"></i> Reset Akun</button>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php $nom++; endforeach ?>
              </tbody>
            </table>
            -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function() 
  {
    window.setTimeout(function () { $("#success-alert").alert('close'); }, 2000);
    $("#search").keyup(function(){
       var str=  $("#search").val();
       if(str == "") {
               $( "#txtHint" ).html("<b>Hasil pencarian akan tampil dibawah ...</b>"); 
       }else {
               $.get( "<?php echo base_url();?>home/hasil_pencarian_akun?id="+str, function( data ){
                   $( "#txtHint" ).html( data );  
            });
       }
   });  
  });
  
</script>

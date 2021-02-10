<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-desktop"></i> Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dasboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <?php if($this->session->userdata("user_kat")==1 || $this->session->userdata("user_kat")==2) { ?>
  <section class="content" style="min-height: 0">
    <div class="row">
      <!-- ./col -->
      <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box" style="background-color: #dc3545">
          <div class="inner">
            <h3><?php echo count($pegawai_aktif);?><sup style="font-size: 20px"> Aktif</sup></h3>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo base_url();?>home/akun_pegawai" class="small-box-footer">Total Akun Pegawai <strong><?php echo count($pegawai_aktif);?></strong> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box" style="background-color: #dc3545">
          <div class="inner">
            <h3><?php echo count($dsn_aktif);?><sup style="font-size: 20px"> Akun Aktif</sup></h3>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo base_url();?>home/akun_dosen" class="small-box-footer">Total Dosen <strong><?php echo count($all_dosen);?></strong> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-12">
        <!-- small box -->
        <div class="small-box" style="background-color: #dc3545">
          <div class="inner">
            <h3><?php echo count($mhs_aktif);?><sup style="font-size: 20px"> Aktif</sup></h3>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo base_url();?>home/akun_mahasiswa" class="small-box-footer">Total Akun Mahasiswa <strong><?php echo count($mhs_aktif);?></strong> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>
  <?php
  if(count($res_head_ka)>0) 
  {
    $nom=1;
    foreach ($res_head_ka as $head) {
      if($head['semester']==1) { $sms = "Ganjil"; } else { $sms = "Genap"; } ?>
      <input type="hidden" name="id_head[]" id="id_head-<?php echo $nom;?>" value="<?php echo $head['id'];?>">
      <section class="content-header">
        <h1><i class="fa fa-calendar"></i> Kalender Akademik Semester (<?php echo $sms;?>)</h1>
      </section>
      <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar-<?php echo $nom;?>"></div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      <?php
      $nom++;
    }
  } ?>
  <input type="hidden" name="jml_head" id="jml_head" value="<?php echo count($res_head_ka);?>">
</div>
<script>
  $(function () {

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    //alert(new Date(y, m, d - 5));
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    //var containerEl = document.getElementById('external-events');
    var jml_rows = document.getElementById('jml_head').value;
    //alert(jml_rows);
    var result = "";
    var checkbox = document.getElementById('drop-remove');
    for(var i=1; i <= jml_rows; i++)
    {
      var id_head = $("#id_head-"+i).val();
      
      //console.log(result);
      var calendarE = document.getElementById('calendar-'+i);
      var calendar = new Calendar(calendarE, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        header    : {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth'
        },

        //Random default events
        //events    : JSON.parse(obj),
        events : "<?php echo base_url()?>home/get_detail_kegiatan/"+id_head,
        
        editable  : false,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        },
        displayEventTime : false
      });
      calendar.render(); 
    }
  });
  
</script>
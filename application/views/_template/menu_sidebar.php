<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/logo_app/logo-mini.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book text-red"></i>
            <span>AKADEMIK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>kalender_akademik"><i class="fa fa-calendar"></i> Kalender Akademik</a></li>
            <!--<li><a href="<?php echo base_url();?>jadwal_perkuliahan"><i class="fa fa-calendar"></i>Jadwal Perkuliahan</a></li>-->
            <li><a href="<?php echo base_url();?>akademik/matakuliah"><i class="fa fa-book"></i>Matakuliah</a></li>
            <li><a href="<?php echo base_url();?>akademik/mahasiswa"><i class="fa fa-user"></i> Mahasiswa</a></li>
            <li><a href="<?php echo base_url();?>dosen"><i class="fa fa-user"></i> Dosen</a></li>
            <li><a href="<?php echo base_url();?>permohonan_kkp"><i class="fa fa-book"></i>Permohonan KKP</a></li>
            <!--
            <li><a href="<?php echo base_url();?>mahasiswa"><i class="fa fa-user"></i> Mahasiswa</a></li>
            <li><a href="<?php echo base_url();?>tendik"><i class="fa fa-user"></i> Tenaga Kependidikan</a></li>
            -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book text-red"></i>
            <span>RPS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>OPSI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>opsi/aspek_sikap"><i class="fa fa-circle-o"></i> Aspek Sikap</a></li>
                <li><a href="<?php echo base_url();?>opsi/aspek_pengetahuan"><i class="fa fa-circle-o"></i> Aspek Pengetahuan</a></li>
                <li><a href="<?php echo base_url();?>opsi/keterampilan_umum"><i class="fa fa-circle-o"></i> Aspek Keterampilan Umum</a></li>
                <li><a href="<?php echo base_url();?>opsi/keterampilan_khusus"><i class="fa fa-circle-o"></i> Aspek Keterampilan Khusus</a></li>
              </ul>
            </li>
            <li class="active"><a href="<?php echo base_url();?>rps/guidelines"><i class="fa fa-book"></i> Guidelines</a></li>
            <li><a href="<?php echo base_url();?>rps/team_teaching"><i class="fa fa-lock"></i> Team Teaching RPS</a></li>
            <li><a href="<?php echo base_url();?>rps"><i class="fa fa-edit"></i> Penyusunan RPS</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe text-red"></i>
            <span>HOME PAGE <br>(feb.unismuh.ac.id)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>OPSI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>opsi/kategori_berita"><i class="fa fa-edit"></i> Kategori Berita</a></li>
                <li><a href="<?php echo base_url();?>opsi/kategori_faq"><i class="fa fa-edit"></i> Kategori FAQ</a></li>
                <li><a href="<?php echo base_url();?>opsi/kategori_id"><i class="fa fa-edit"></i> Kategori ID Resources</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url();?>slide"><i class="fa fa-circle-o"></i> Slide</a></li>
            <li><a href="<?php echo base_url();?>berita"><i class="fa fa-circle-o"></i> Berita</a></li>
            <li><a href="<?php echo base_url();?>mitra"><i class="fa fa-circle-o"></i> Mitra</a></li>
            <li><a href="<?php echo base_url();?>faq"><i class="fa fa-circle-o"></i> FAQ</a></li>
            <li><a href="<?php echo base_url();?>kuesioner"><i class="fa fa-circle-o"></i> Kuesioner</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe text-red"></i>
            <span>CAREER CENTER <br>(career.feb.unismuh.ac.id)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i>
                <span>OPSI</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>opsi/kategori_loker"><i class="fa fa-circle-o"></i> Kategori Loker</a></li>
                <li><a href="<?php echo base_url();?>opsi/kategori_kegiatan"><i class="fa fa-circle-o"></i> Kategori Kegiatan</a></li>
                <li><a href="<?php echo base_url();?>opsi/kategori_informasi_career"><i class="fa fa-circle-o"></i> Kategori Informasi</a></li>
                <li><a href="<?php echo base_url();?>opsi/provinsi"><i class="fa fa-circle-o"></i> Provinsi</a></li>
                <li><a href="<?php echo base_url();?>opsi/kabupaten"><i class="fa fa-circle-o"></i> Kabupaten/Kota</a></li>
                <li><a href="<?php echo base_url();?>opsi/kecamatan"><i class="fa fa-circle-o"></i> Kecamatan</a></li>
                <li><a href="<?php echo base_url();?>opsi/kelurahan"><i class="fa fa-circle-o"></i> Kelurahan</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url();?>career/lowongan_kerja"><i class="fa fa-circle-o"></i> Info Lowongan Kerja</a></li>
            <li><a href="<?php echo base_url();?>career/info_kegiatan"><i class="fa fa-circle-o"></i> Info Kegiatan</a></li>
          </ul>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-globe text-red"></i>
            <span>COMPUTER BASED TEST <br>(cbt.feb.unismuh.ac.id)</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>cbt/buat_soal"><i class="fa fa-circle-o"></i> Pembuatan Soal</a></li>
            <li><a href="<?php echo base_url();?>cbt/bank_soal"><i class="fa fa-circle-o"></i> Bank Soal</a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Jadwal Ujian</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>cbt/buat_jadwal_baru"><i class="fa fa-circle-o"></i> Buat Jadwal Baru</a></li>
                <li><a href="<?php echo base_url();?>cbt/jadwal_ujian"><i class="fa fa-circle-o"></i> Daftar Jadwal</a></li>

              </ul>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
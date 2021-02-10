<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>RPS | Guidelines</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Petunjuk</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-6 table-responsive">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4><strong>Aspek Sikap (S)</strong></h4></div>
          <?php if (count($sikap)>0): ?>
            <table id="tabel_data" class="table table-bordered tabel_data table-striped">
              <thead>
                  <tr>
                  <th style="width: 5%">Kode</th>
                  <th style="width: 95%">Aspek Sikap</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($sikap as $dt) {?>
                  <tr>
                      <td>S<?php echo $dt['no_urut'];?></td>
                      <td><?php echo $dt['aspek_sikap'];?></td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
          <?php endif ?>
        </div>
      </div>
      <div class="col-lg-6 table-responsive">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4><strong>Aspek Pengetahuan (P)</strong></h4></div>
          <?php if (count($pengetahuan)>0): ?>
          <table id="tabel_data" class="table table-bordered tabel_data table-striped">
            <thead>
                <tr>
                <th style="width: 5%">Kode</th>
                <th style="width: 95%">Aspek Pengetahuan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengetahuan as $dt) {?>
                <tr>
                    <td>P<?php echo $dt['no_urut'];?></td>
                    <td><?php echo $dt['aspek_pengetahuan'];?></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 table-responsive">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4><strong>Aspek Keterampilan Umum (KU)</strong></h4></div>
          <?php if (count($ku)>0): ?>
          <table id="tabel_data" class="table table-bordered tabel_data table-striped">
            <thead>
                <tr>
                <th style="width: 5%">Kode</th>
                <th style="width: 95%">Aspek Keterampilan Umum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ku as $dt) {?>
                <tr>
                    <td>KU<?php echo $dt['no_urut'];?></td>
                    <td><?php echo $dt['keterampilan_umum'];?></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
          <?php endif ?>
        </div>
      </div>
      <div class="col-lg-6 table-responsive">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4><strong>Aspek Keterampilan Khusus (KK)</strong></h4></div>
          <?php if (count($kk)>0): ?>
          <table id="tabel_data" class="table table-bordered tabel_data table-striped">
            <thead>
                <tr>
                <th style="width: 5%">Kode</th>
                <th style="width: 95%">Aspek Keterampilan Khusus</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kk as $dt) {?>
                <tr>
                    <td>KK<?php echo $dt['no_urut'];?></td>
                    <td><?php echo $dt['keterampilan_khusus'];?></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4>Taxonomi Tujuan Instruksional<br><strong>RANAH KOGNITIF (
Pengetahuan ) ––(Bloom, Anderson & Krathwohl, 2001)</strong></h4>
          </div>
          <table class="table table-borderless table-striped table-vcenter table-bordered">
            <tbody>
              <tr>
                <td align="center"><a href="javascript:void(0)"><strong>REMEMBERING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>UNDERSTANDING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>APPLYING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>ANALYZING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>EVALUATING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>CREATING</strong></a></td>
              </tr>
              <tr>
                <td align="center"><strong><h3>C1</h3></strong></td>
                <td align="center"><strong><h3>C2</h3></strong></td>
                <td align="center"><strong><h3>C3</h3></strong></td>
                <td align="center"><strong><h3>C4</h3></strong></td>
                <td align="center"><strong><h3>C5</h3></strong></td>
                <td align="center"><strong><h3>C6</h3></strong></td>
              </tr>
              <tr>
                <td>
                  Mengidentifikasi, Menyebutkan, Menunjukkan, Memberi nama pada, Menyusun Daftar, Menggarisbawahi, Menjodohkan, Memilih, Memberikan Defenisi, Menyatakan..
                </td>
                <td>
                  Menjelaskan, Menguraikan, Merumuskan, Merangkum, Mengubah, Memberikan Contoh Tentang, Menyadur, Meramalkan, Menyimpulkan, Memperkirakan, Menerangkan, Menggantikan, Menarik Kesimpulan, Meringkas, Mengembangkan, Membuktikan,..
                </td>
                <td>
                  Mendemonstrasikan, Menghitung, Menghubungkan, Memperhitungkan, Membuktikan, Menghasilkan, Menunjukkan, Melengkapi, Menyediakan, Menyesuaikan, Menemukan,..
                </td>
                <td>
                  Memisahkan, Menerima, Menyisihkan, Menghubungkan, Memilih, Membandingkan, Mempertentangkan, Membagi, Membuat Diagram/Skema, Menunjukkan Hubungan Antara, Membagi,..
                </td>
                <td>
                  Memperbandingkan, Menyimpilkan, Mengkritik, Mengevaluir, Memberikan Argumentasi, Menafsirkan, Membahas, Menyimpulkan, Memilih Antara, Menguraikan, Membedakan, Melukiskan, Mendukung, Menyokong, Menolak,..
                </td>
                <td>
                  Merancang, Menyusun, Menciptakan, Mendesain, Mengkombinasikan, Mengatur, Merencanakan,..
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4>Taxonomi Tujuan Instruksional<br><strong>RANAH AFEKTIF (SIKAP)
--(Krathwohl, Bloom & Masia ,1964)</strong></h4>
          </div>
          <table class="table table-borderless table-striped table-vcenter table-bordered">
            <tbody>
              <tr>
                <td align="center"><a href="javascript:void(0)"><strong>RECEIVING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>RESPONDING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>VALUING</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>ORGANIZATION</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>CHARACTERIZATION</strong></a></td>
              </tr>
              <tr>
                <td align="center"><strong><h3>A1</h3></strong></td>
                <td align="center"><strong><h3>A2</h3></strong></td>
                <td align="center"><strong><h3>A3</h3></strong></td>
                <td align="center"><strong><h3>A4</h3></strong></td>
                <td align="center"><strong><h3>A5</h3></strong></td>
              </tr>
              <tr>
                <td>
                 Menanyakan, Memilih, Mengikuti, Menjawab, Melanjutkan, Memberi, Menyatakan, Menempatkan,..
                </td>
                <td>
                  Melaksanakan, Membantu, Menawarkan diri, Menyambut, Menolong, Mendatangi, Melaporkan, Menyumbangkan, Menyesuaikan diri, Berlatih, Menampilkan, Membawakan, Mendiskusikan, Menyelesaikan, Menyatakan persetujuan, Mempraktekkan,..
                </td>
                <td>
                  Menunjukkan, Melaksanakan, Menyatakan pendapat, Mengikuti, Mengambil prakarsa, Memilih, Ikut serta, Menggabungkan diri, Mengundang, Mengusulkan, Membela, Menuntun, Membenarkan, Menolak, Mengajak,..
                </td>
                <td>
                  Merumuskan, Berpegang pada, Mengintegrasikan, Menghubungkan, Mengaitkan, Menyusun, Mengubah, Melengkapi, Menyempurnakan, Menyesuaikan, Menyamakan, Mengatur, Memperbandingkan, Mempertahankan, Memodifikasi,..
                </td>
                <td>
                  Bertindak, Menyatakan, Memperlihatkan, Mempraktekkan, Melayani, Mengundurkan diri, Membuktikan diri, Membuktikan, Menunjukkan, Bertahan, Mempertimbangkan, Mempersoalkan,..
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <!-- Latest Orders Block -->
        <div class="block table-responsive">
          <!-- Latest Orders Title -->
          <div class="block-title"><h4>Taxonomi Tujuan Instruksional<br><strong>RANAH PSIKOMOTORIK (
Keterampilan ) ––(Dave, 1967)</strong></h4>
          </div>
          <table class="table table-borderless table-striped table-vcenter table-bordered">
            <tbody>
              <tr>
                <td align="center"><a href="javascript:void(0)"><strong>IMITATION</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>MANIPULATION</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>PRESICION</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>ARTICULATION</strong></a></td>
                <td align="center"><a href="javascript:void(0)"><strong>NATURALITATION</strong></a></td>
              </tr>
              <tr>
                <td align="center"><strong><h3>P1</h3></strong></td>
                <td align="center"><strong><h3>P2</h3></strong></td>
                <td align="center"><strong><h3>P3</h3></strong></td>
                <td align="center"><strong><h3>P4</h3></strong></td>
                <td align="center"><strong><h3>P5</h3></strong></td>
              </tr>
              <tr>
                <td>
                  Mengikuti, Menirukan, Menjiplak, Mereplikasi, Mencetak dengan pola, Merakit, Mempraktekkan, Membuat,..
                </td>
                <td>
                  Mengoperasikan, Membangun, Memasang, Membongkar, Memperbaiki, Menyusun, Merakit, Merangkai, Memainkan, Mendemonstrasikan,..
                </td>
                <td>
                  Melakukan gerak dengan benar, Melakukan gerak dengan teliti, Melakukan gerak dengan terukur,..
                </td>
                <td>
                  Membuat variasi, Mengkombinasi gerak, Mengadaptasikan berbagai gerak, Mengatur,..
                </td>
                <td>
                  Mengorganisasi gerak, Melakukan gerak dengan wajar, Melakukan gerak spontan, Melakukan gerak dengan cepat..
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
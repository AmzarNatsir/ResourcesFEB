<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_rps extends CI_Model 
{
	//master
	function get_master_prodi()
	{
		$sql_str = $this->db->query("select a.*, b.jenjang as nm_jenjang from 1_2_identitas_ps a, jenis_1_jenjang b where a.jenjang=b.id order by id_ps");
		return $sql_str->result_array();
	}
	function get_all_dosen()
	{
		return $this->db->get("4_1_biodata_dosen")->result_array();
	}
	function get_all_rps_aspek_sikap()
	{
		$this->db->order_by("no_urut", "asc");
		return $this->db->get("opsi_rps_aspek_sikap")->result_array();
	}
	function get_all_rps_aspek_pengetahuan()
	{
		$this->db->order_by("no_urut", "asc");
		return $this->db->get("opsi_rps_aspek_pengetahuan")->result_array();
	}
	function get_all_rps_aspek_ku()
	{
		$this->db->order_by("no_urut", "asc");
		return $this->db->get("opsi_rps_aspek_ku")->result_array();
	}
	function get_all_rps_aspek_kk()
	{
		$this->db->order_by("no_urut", "asc");
		return $this->db->get("opsi_rps_aspek_kk")->result_array();
	}
	function get_all_matakuliah_perprodi($key)
	{
		$this->db->where("program_studi", $key);
		return $this->db->get("5_akademik_matakuliah")->result_array();
	}
	function get_profil_matakuliah($key)
	{
		$this->db->where("id_matakuliah", $key);
		$exec = $this->db->get("5_akademik_matakuliah")->result();
		$row = $exec[0];
		return $row;
	}
	//proses rps
	function insert_rps_identitas_desk($data)
	{
		$this->db->trans_start();
		$this->db->insert("rps_identitas_desk", $data);
		$last_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $last_id;
	}
	function delete_head_rps($key)
	{
		$this->db->where('id_rps', $key);
		$this->db->delete('rps_identitas_desk');
	}
	public function get_all_rps()
	{
		$this->db->trans_start();
		$this->db->select("a.tahun, a.id_rps, a.id_matkul, a.prasyarat_matkul, a.perangkat_lunak, a.perangkat_keras, a.id_dosen, a.pokok_bahasan, a.pil_referensi, a.pil_pustaka_pendukung, a.catatan, b.nama_ps, c.jenjang as nm_jenjang, d.nama_matakuliah, d.sks, d.kode_matakuliah, d.semester, e.jenis_matakuliah, a.tgl_post, a.status_rps, a.ketua_team");
		$this->db->from("rps_identitas_desk a");
		$this->db->from("1_2_identitas_ps b");
		$this->db->from("jenis_1_jenjang c");
		$this->db->from("5_akademik_matakuliah d");
		$this->db->from("jenis_5_matakuliah e");
		$this->db->where("a.id_prodi = b.id_ps");
		$this->db->where("b.jenjang = c.id");
		$this->db->where("a.id_matkul = d.id_matakuliah");
		$this->db->where("d.jenis_mk = e.id_jenis_mk");
		$this->db->order_by("a.tgl_post", "desc");
		$rows = $this->db->get()->result_array();
		$this->db->trans_complete();
		return $rows;
	}
	function get_data_head_rps($key)
	{
		$this->db->trans_start();
		$this->db->select("a.tahun, a.id_rps, a.id_prodi, a.id_matkul, a.id_dosen, a.prasyarat_matkul, a.deskripsi_matkul, a.perangkat_lunak, a.perangkat_keras, a.pokok_bahasan, a.catatan,,b.nama_ps, c.jenjang as nm_jenjang, d.nama_matakuliah, d.sks, d.kode_matakuliah, d.semester, a.pil_aspek_sikap, a.pil_aspek_pengetahuan, a.pil_aspek_ku, a.pil_aspek_kk, a.capaian_pembelajaran_mk, a.pil_referensi, a.pil_pustaka_pendukung, e.jenis_matakuliah, a.tgl_post, a.status_rps, a.ketua_team");
		$this->db->from("rps_identitas_desk a");
		$this->db->from("1_2_identitas_ps b");
		$this->db->from("jenis_1_jenjang c");
		$this->db->from("5_akademik_matakuliah d");
		$this->db->from("jenis_5_matakuliah e");
		$this->db->where("a.id_prodi = b.id_ps");
		$this->db->where("b.jenjang = c.id");
		$this->db->where("a.id_matkul = d.id_matakuliah");
		$this->db->where("d.jenis_mk = e.id_jenis_mk");
		$this->db->where("a.id_rps", $key);
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
		
	}
	function get_data_detail_rps($key)
	{
		$this->db->trans_start();
		$this->db->select("a.tahun, a.id_rps, a.id_matkul, a.prasyarat_matkul, a.id_dosen, a.deskripsi_matkul, a.perangkat_lunak, a.perangkat_keras, a.pil_aspek_sikap, a.pil_aspek_pengetahuan, a.pil_aspek_ku, a.pil_aspek_kk, a.capaian_pembelajaran_mk, a.pil_referensi, a.pil_pustaka_pendukung, a.pokok_bahasan, a.catatan, b.nama_ps, c.jenjang as nm_jenjang, d.nama_matakuliah, d.sks, d.kode_matakuliah, d.semester, e.jenis_matakuliah, a.tgl_post, a.status_rps, a.ketua_team");
		$this->db->from("rps_identitas_desk a");
		$this->db->from("1_2_identitas_ps b");
		$this->db->from("jenis_1_jenjang c");
		$this->db->from("5_akademik_matakuliah d");
		$this->db->from("jenis_5_matakuliah e");
		$this->db->where("a.id_prodi = b.id_ps");
		$this->db->where("b.jenjang = c.id");
		$this->db->where("a.id_matkul = d.id_matakuliah");
		$this->db->where("d.jenis_mk = e.id_jenis_mk");
		$this->db->where("a.id_rps", $key);
		$exec = $this->db->get()->row();
		//$row = $exec[0];
		$this->db->trans_complete();
		return $exec;
		
	}
	function update_rps_head($key, $data)
	{
		$this->db->trans_start();
		$this->db->where("id_rps", $key);
		$this->db->update("rps_identitas_desk", $data);
		$this->db->trans_complete();
	}
	function get_profil_dosen($key)
	{
		$this->db->trans_start();
		$this->db->where("id_dosen", $key);
		$this->db->from("4_1_biodata_dosen");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_profil_aspek_sikap($key)
	{
		$this->db->trans_start();
		$this->db->where("id_sikap", $key);
		$this->db->from("opsi_rps_aspek_sikap");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_profil_aspek_pengetahuan($key)
	{
		$this->db->trans_start();
		$this->db->where("id_pengetahuan", $key);
		$this->db->from("opsi_rps_aspek_pengetahuan");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_profil_aspek_ku($key)
	{
		$this->db->trans_start();
		$this->db->where("id_ku", $key);
		$this->db->from("opsi_rps_aspek_ku");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_profil_aspek_kk($key)
	{
		$this->db->trans_start();
		$this->db->where("id_kk", $key);
		$this->db->from("opsi_rps_aspek_kk");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_profil_referensi($key)
	{
		$this->db->trans_start();
		$this->db->where("id_rps_referensi", $key);
		$this->db->from("rps_referensi");
		$exec = $this->db->get()->result();
		$row = $exec[0];
		$this->db->trans_complete();
		return $row;
	}
	function get_no_urut_cp_mk($key)
	{
		$result = $this->db->get_where("rps_cpmk", ["id_rps"=>$key])->num_rows();
		if($result>0)
		{
			$this->db->select("no_urut");
			$this->db->from("rps_cpmk");
			$this->db->where("id_rps", $key);
			$this->db->order_by("no_urut", "desc");
			$this->db->limit(1);
			$exec = $this->db->get()->result();
			$row = $exec[0];
			$hasil = $row->no_urut+1;
		} else {
			$hasil = 1;
		}
		return $hasil;
	}
	function insert_cpmk($data)
	{
		$this->db->insert("rps_cpmk", $data);
	}
	function update_cpmk($key, $data)
	{
		$this->db->where('id_cpmk', $key);
		$this->db->update('rps_cpmk', $data);
	}
	function delete_cpmk_rps($key)
	{
		$this->db->where('id_rps', $key);
		$this->db->delete('rps_cpmk');
	}
	function update_no_urut_cpmk($id_cpmk, $id_rps, $data)
	{
		$this->db->where('id_cpmk', $id_cpmk);
		$this->db->where('id_rps', $id_rps);
		$this->db->update('rps_cpmk', $data);
	}
	function delete_cpmk($key)
	{
		$this->db->where('id_cpmk', $key);
		$this->db->delete('rps_cpmk');
	}
	function get_all_rps_cpmk($key)
	{
		return $this->db->get_where("rps_cpmk", ["id_rps"=>$key])->result_array();
	}
	function get_profil_rps_cpmk($key)
	{
		return $this->db->get_where("rps_cpmk", ['id_cpmk' => $key])->row();
	}
	//Matriks Rencana Pembelajaran
	function get_pertemuan_ke($key)
	{
		$this->db->trans_start();
		$this->db->select("pertemuan_ke");
		$this->db->from("rps_matrik_rencana_pembelajaran");
		$this->db->where("id_rps", $key);
		$result = $this->db->get()->num_rows();
		if($result>0)
		{
			$this->db->select("pertemuan_ke");
			$this->db->from("rps_matrik_rencana_pembelajaran");
			$this->db->where("id_rps", $key);
			$this->db->order_by("pertemuan_ke", "desc");
			$this->db->limit(1);
			$exec = $this->db->get()->result();
			$row = $exec[0];
			$hasil = $row->pertemuan_ke+1;
		} else {
			$hasil = 1;
		}
		$this->db->trans_complete();
		return $hasil;
	}
	function insert_rps_matriks_rencana_pembelajaran($data)
	{
		$this->db->trans_start();
		$this->db->insert("rps_matrik_rencana_pembelajaran", $data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE) { $sts_err = 1; /*sukses*/ } else { $sts_err = 2; /*gagal*/	}
		return $sts_err;
	}
	function delete_rps_matriks($key)
	{
		$this->db->where('id_rps', $key);
		$this->db->delete('rps_matrik_rencana_pembelajaran');
	}
	function delete_rps_row_matriks($id_rps, $id_matriks)
	{
		$this->db->trans_start();
		$this->db->where("id_rps_matriks", $id_matriks);
		$this->db->where("id_rps", $id_rps);
		$this->db->delete("rps_matrik_rencana_pembelajaran");
		$this->db->trans_complete();
	}
	function update_rps_matriks_rencana_pembelajaran($id_matriks, $id_rps, $data)
	{
		$this->db->trans_start();
		$this->db->where("id_rps_matriks", $id_matriks);
		$this->db->where("id_rps", $id_rps);
		$this->db->update("rps_matrik_rencana_pembelajaran", $data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE) { $sts_err = 1; /*sukses*/ } else { $sts_err = 2; /*gagal*/	}
		return $sts_err;
	}
	function get_data_rps_matriks($key)
	{
		$this->db->trans_start();
		$this->db->where("id_rps", $key);
		$this->db->order_by("pertemuan_ke", "asc");
		$result = $this->db->get("rps_matrik_rencana_pembelajaran")->result_array();
		$this->db->trans_complete();
		return $result;
	}
	function get_data_rps_matriks_per_baris($key)
	{
		$this->db->trans_start();
		$this->db->where("id_rps_matriks", $key);
		$hasil = $this->db->get("rps_matrik_rencana_pembelajaran")->result();
		$this->db->trans_complete();
		$row = $hasil[0];
		return $row;
	}
	//bobot penilaian
	function insert_rps_bobot_penilaian($data)
	{
		$this->db->trans_start();
		$this->db->insert("rps_penilaian", $data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE) { $sts_err = 1; /*sukses*/ } else { $sts_err = 2; /*gagal*/	}
		return $sts_err;
	}
	function update_rps_bobot_penilaian($key, $data)
	{
		$this->db->trans_start();
		$this->db->where('id_rps_nilai', $key);
		$this->db->update("rps_penilaian", $data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE) { $sts_err = 1; /*sukses*/ } else { $sts_err = 2; /*gagal*/	}
		return $sts_err;
	}
	function delete_rps_bobot_penilaian($key)
	{
		$this->db->trans_start();
		$this->db->where('id_rps_nilai', $key);
		$this->db->delete("rps_penilaian");
		$this->db->trans_complete();
	}
	function get_data_bobot_penilaian($key)
	{
		$this->db->trans_start();
		$this->db->where("id_rps", $key);
		$this->db->order_by("id_rps_nilai", "asc");
		$result = $this->db->get("rps_penilaian")->result_array();
		$this->db->trans_complete();
		return $result;
	}
	function get_profil_bobot_penilaian($key)
	{
		$this->db->trans_start();
		$this->db->where("id_rps_nilai", $key);
		$hasil = $this->db->get("rps_penilaian")->result();
		$this->db->trans_complete();
		$row = $hasil[0];
		return $row;
	}
	//Referensi
	function get_opt_referensi_kategori()
	{
		return $this->db->get("opt_rps_referensi_kategori")->result_array();
	}
	function insert_rps_referensi($data)
	{
		$this->db->trans_start();
		$this->db->insert("rps_referensi", $data);
		$this->db->trans_complete();
		if($this->db->trans_status()==TRUE) { $sts_err = 1; /*sukses*/ } else { $sts_err = 2; /*gagal*/	}
		return $sts_err;
	}
	function get_all_referensi()
	{
		return $this->db->get("rps_referensi")->result_array();
	}
	//team teaching
	public function cek_matakuliah_rps($tahun, $prodi, $matkul)
	{
		return $this->db->get_where("rps_identitas_desk", ['tahun'=>$tahun, 'id_prodi'=>$prodi, 'id_matkul'=>$matkul])->result_array();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kaos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')!=TRUE) {
			redirect('admin/login','refresh');
		}
		$this->load->model('m_kaos','kaos');
	}

	public function index()
	{
		$data['tampil_kaos']=$this->kaos->tampil();
		$data['kategori']=$this->kaos->data_kategori();
		$data['konten']="v_kaos";
		$data['judul']="Daftar Kaos";
		$this->load->view('template', $data);
	}
	public function toko()
	{
		$data['tampil_kaos']=$this->kaos->tampil();
		$data['kategori']=$this->kaos->data_kategori();
		$data['konten']="toko";
		$data['judul']="Toko ArumPikachu";
		$this->load->view('template', $data);
	}
	public function event()
	{
		$data['tampil_kaos']=$this->kaos->tampil();
		$data['kategori']=$this->kaos->data_kategori();
		$data['konten']="v_event";
		$data['judul']="Toko ArumPikachu";
		$this->load->view('template', $data);
	}
	public function profil()
	{
		$data['tampil_kaos']=$this->kaos->tampil();
		$data['kategori']=$this->kaos->data_kategori();
		$data['konten']="v_profil";
		$data['judul']="Toko ArumPikachu";
		$this->load->view('template', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama_kaos', 'nama_kaos', 'trim|required');
		$this->form_validation->set_rules('edisi', 'edisi', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		if ($this->form_validation->run()==TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';
			if ($_FILES['gambar_kaos']['name']!="") {
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('gambar_kaos')) {
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}else {
					if ($this->kaos->simpan_kaos($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Sukses menambah ');
					}else{
						$this->session->set_flashdata('pesan', 'Gagal menambah');
					}
					redirect('kaos','refresh');
				}
			}else{
				if ($this->kaos->simpan_kaos('')) {
					$this->session->set_flashdata('pesan', 'Sukses menambah');
				}else{
					$this->session->set_flashdata('pesan', 'Gagal menambah');
				}
				redirect('kaos','refresh');
			}

		}else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('kaos','refresh');
		}
	}
	public function edit_kaos($id)
	{
		$data=$this->kaos->detail($id);
		echo json_encode($data);
	}
	public function kaos_update()
	{
		if($this->input->post('edit')){
			if($_FILES['gambar_kaos']['name']==""){
				if($this->kaos->edit_kaos()){
					$this->session->set_flashdata('pesan', 'Sukses update');
					redirect('kaos');
				} else {
					$this->session->set_flashdata('pesan', 'Gagal update');
					redirect('kaos');
				}
			} else {
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '20000';
				$config['max_width']  = '5024';
				$config['max_height']  = '5768';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('gambar_kaos')){
					$this->session->set_flashdata('pesan', 'Gagal Upload');
					redirect('kaos');
				}
				else{
					if($this->kaos->edit_kaos_dengan_foto($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'Sukses update');
						redirect('kaos');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal update');
						redirect('kaos');
					}
				}
			}

		}

	}
	public function hapus($id_kaos='')
	{
		if ($this->kaos->hapus_kaos($id_kaos)) {
			$this->session->set_flashdata('pesan', 'Sukses Hapus kaos');
			redirect('kaos','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Gagal Hapus kaos');
			redirect('kaos','refresh');
		}
	}

}

/* End of file Kaos.php */
/* Location: ./application/controllers/Kaos.php */

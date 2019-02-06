<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kaos extends CI_Model {
    public function tampil()
    {
        $tm_kaos=$this->db
                      ->join('kategori','kategori.id_kategori=kaos.id_kategori')
                      ->get('kaos')
                      ->result();
        return $tm_kaos;
    }
    public function data_kategori()
    {
        return $this->db->get('kategori')
                        ->result();
    }
    public function simpan_kaos($file_gambar)
    {
        if ($file_gambar=="") {
             $object = array(
                'id_kaos' => $this->input->post('id_kaos'),
                'nama_kaos' => $this->input->post('nama_kaos'),
                'edisi' => $this->input->post('edisi'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok')
             );
        }else{
            $object = array(
                'id_kaos' => $this->input->post('id_kaos'),
                'nama_kaos' => $this->input->post('nama_kaos'),
                'edisi' => $this->input->post('edisi'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'gambar_kaos' => $file_gambar
             );
        }
        return $this->db->insert('kaos', $object);
    }
    public function detail($a)
    {
        $tm_kaos=$this->db
                      ->join('kategori', 'kategori.id_kategori=kaos.id_kategori')
                      ->where('id_kaos', $a)
                      ->get('kaos')
                      ->row();
        return $tm_kaos;
    }
    public function edit_kaos()
    {
        $data = array(
                'id_kaos' => $this->input->post('id_kaos'),
                'nama_kaos' => $this->input->post('nama_kaos'),
                'edisi' => $this->input->post('edisi'),
                'id_kategori' => $this->input->post('id_kategori'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),

            );

        return $this->db->where('id_kaos', $this->input->post('id_kaos_lama'))
                        ->update('kaos', $data);
    }
    public function edit_kaos_dengan_foto($file_gambar)
    {
        $data = array(
                'id_kaos' => $this->input->post('id_kaos'),
                'nama_kaos' => $this->input->post('nama_kaos'),
                'edisi' => $this->input->post('edisi'),
                'id_kategori' => $this->input->post('id_kategori'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
                'penerbit' => $this->input->post('penerbit'),
                'penulis' => $this->input->post('penulis'),
                'gambar_kaos' => $file_gambar

            );

        return $this->db->where('id_kaos', $this->input->post('id_kaos_lama'))
                        ->update('kaos', $data);
    }
    public function hapus_kaos($id_kaos='')
    {
        return $this->db->where('id_kaos', $id_kaos)
                    ->delete('kaos');
    }


}

/* End of file M_kaos.php */
/* Location: ./application/models/M_kaos.php */

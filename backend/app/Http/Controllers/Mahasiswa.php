<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mmahasiswa;
use Illuminate\Support\Facedes\Mail;


class Mahasiswa extends Controller
{
    //buat variabel
    protected $model;

    //buat fungsi global
    function __construct()
    {
        //inisialisasi variabel "model" dari model "Mmahasiswa"
        $this->model = new Mmahasiswa();
    }

    function getController()
    {
        //isi nilai dari variabel "result" dari fungsi "getData" dari model "Mmahasiswa"
        $result = $this->model->getData();

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa" => $result], http_response_code());
    }

    //Digunakan Untuk pencarian data
    function searchController($keyword)
    {
        //isi nilai dari variabel "result" dari fungsi "searchData" dari model "Mmahasiswa" sesuai dengan isi parameter
        $result = $this->model->searchData($keyword);

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa" => $result], http_response_code());
    }

    //buat fungsi detail data
    function detailController($id)
    {
        //isi nilai dari variabel "result" dari fungsi "detailData" dari model "Mmahasiswa" sesuai dengan isi parameter "id"
        $result = $this->model->detailData($id);

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa" => $result], http_response_code());

    }

    //buat fungsi untuk menghapus data
    function deleteController($id)
    {
        //cek npm tersedia atau tidak 
        //jika data tersedia
        if (count($this->model->detailData($id)) == 1) {
            //Lakukan Penghapusan Data 
            $this->model->deleteData($id);

            //Buat Status Pesan
            $status = 1;
            $messege = "Data Berhasil Dihapus";
        }
        //jika data tidak tersedia
        else {
            //Buat Status Pesan
            $status = 0;
            $messege = "NPM Tidak Ditemukan!!!";
        }

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["status" => $status, "message" => $messege], http_response_code());
    }

    // Buat Fungsi Untuk Simpan Data

    // "NPM" = Variable Array Yang Menampung Nilai Dari $req

    // "$req -> NPM" = Variable Yang Dikirim Dari Front End
    function saveController(Request $req)
    {
        $data =
            [
                "NPM" => $req->NPM,
                "NAMA" => $req->NAMA,
                "TELEPON" => $req->TELEPON,
                "JURUSAN" => $req->JURUSAN,
            ];
        $id = base64_encode(md5($req->NPM));

        // Lakukan Pengecekan Apakah Data " NPM " Yang Diisi Sudah Pernah Tersimpan/Belum Di Database

        // Jika Data Tersedia 
        if (count($this->model->detailData($id)) == 1)
        //Lakukan Penyimpanan Data 
        {
            
            //Buat Status Pesan
            $status = 0;
            $messege = "NPM Tidak Ditemukan !!!";
        }
        //jika data tidak tersedia
        else {
            //Buat Status Pesan
            $status = 1;
            $messege = "Data Berhasil Di Simpan ";
        }
        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["status" => $status, "message" => $messege], http_response_code());


    }
    // Buat Fungsi Untuk Ubah Data
    function updateController(Request $req, $id)
    {
        //Ambil Data Input
        $data =
            [
                "NPM" => $req->NPM,
                "NAMA" => $req->NAMA,
                "TELEPON" => $req->TELEPON,
                "JURUSAN" => $req->JURUSAN,
            ];
        //SET Nilai ID


        //cek npm tersedia atau tidak 
        //jika data tersedia
        if (count($this->model->checkUpdateData($data["NPM"], $id)) == 0) {
            //Lakukan Perubahan Data  
            //Buat Status Pesan
            $this->model->updateData($data["NPM"], $data["NAMA"], $data["TELEPON"], $data["JURUSAN"],$id );
            $status = 1;
            $messege = "Data Berhasil Di Ubah";
        }
        //jika data tersedia
        else {
            //Buat Status Pesan
            $status = 0;
            $messege = "Data Tidak Di Ubah!!!";
        }
        return response(["status" => $status, "message" => $messege], http_response_code());
    }
}

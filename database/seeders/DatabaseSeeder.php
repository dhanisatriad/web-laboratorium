<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\barang;
use App\Models\fakultas;
use App\Models\jurusan;
use App\Models\laboratorium;
use App\Models\lokasi_penyimpanan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        barang::factory(100)->create();


        laboratorium::create([
            'nama_laboratorium'=>'Laboratorium Komputer',
            'kode_laboratorium'=>'LKom',
            'slug'=>'laboratorium-komputer'
        ]);

        laboratorium::create([
            'nama_laboratorium'=>'Laboratorium Telekomunikasi',
            'kode_laboratorium'=>'LTel',
            'slug'=>'laboratorium-telekomunikasi'
        ]);

        laboratorium::create([
            'nama_laboratorium'=>'Laboratorium Fisika',
            'kode_laboratorium'=>'LFis',
            'slug'=>'laboratorium-fisika'
        ]);

        laboratorium::create([
            'nama_laboratorium'=>'Laboratorium Instrumentasi',
            'kode_laboratorium'=>'LIns',
            'slug'=>'laboratorium-instrumentasi',
        ]);

        lokasi_penyimpanan::create([
            'nama_lokasi'=>'Laboratorium Komputer',
            'kode_lokasi'=>'LKom',
            'slug'=>'laboratorium-komputer',
            'deskripsi'=>'nsakdnaskldnaslkjdhasdhasdasda'
        ]);

        lokasi_penyimpanan::create([
            'nama_lokasi'=>'Laboratorium Telekomunikasi',
            'kode_lokasi'=>'LTel',
            'slug'=>'laboratorium-telekomunikasi',
            'deskripsi'=>'nsakdnaskldnaslkjdhasdhasdasda'
        ]);

        lokasi_penyimpanan::create([
            'nama_lokasi'=>'Laboratorium Fisika',
            'kode_lokasi'=>'LFis',
            'slug'=>'laboratorium-fisika',
            'deskripsi'=>'nsakdnaskldnaslkjdhasdhasdasda'
        ]);

        lokasi_penyimpanan::create([
            'nama_lokasi'=>'Laboratorium Instrumentasi',
            'kode_lokasi'=>'LIns',
            'slug'=>'laboratorium-instrumentasi',
            'deskripsi'=>'nsakdnaskldnaslkjdhasdhasdasda'
        ]);




        fakultas::create([
            'nama_fakultas'=>'SAINS DAN TEKNOLOGI',
        ]);
        fakultas::create([
            'nama_fakultas'=>'TARBIYAH DAN KEGURUAN',
        ]);
        fakultas::create([
            'nama_fakultas'=>'SYARI’AH DAN HUKUM',
        ]);
        fakultas::create([
            'nama_fakultas'=>'USHULUDDIN',
        ]);
        fakultas::create([
            'nama_fakultas'=>'DAKWAH &  KOMUNIKASI',
        ]);
        fakultas::create([
            'nama_fakultas'=>'PSIKOLOGI',
        ]);
        fakultas::create([
            'nama_fakultas'=>'EKONOMI DAN ILMU SOSIAL',
        ]);
        fakultas::create([
            'nama_fakultas'=>'PERTANIAN DAN PETERNAKAN',
        ]);



        jurusan::create([
            'fakultas_id' => '1',
            'nama_jurusan'=>'Teknik Elektro',
        ]);
        jurusan::create([
            'fakultas_id' => '1',
            'nama_jurusan'=>'Teknik Industri',
        ]);
        jurusan::create([
            'fakultas_id' => '1',
            'nama_jurusan'=>'Sistem Informasi',
        ]);
        jurusan::create([
            'fakultas_id' => '1',
            'nama_jurusan'=>'Matematika',
        ]);
        jurusan::create([
            'fakultas_id' => '1',
            'nama_jurusan'=>'Teknik Informatika',
        ]);

        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Agama Islam',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Bahasa Arab',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Manajemen Pendidikan Islam',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Bahasa Inggris',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Matematika',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Ekonomi',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Kimia',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Guru Madrasah Ibtidaiyah – S1',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Islam Anak Usia Dini',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Tadris Ilmu Pengetahuan Alam',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Guru Madrasah Ibtidaiyah – S2',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Bahasa Indonesia',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Pendidikan Geografi',
        ]);
        jurusan::create([
            'fakultas_id' => '2',
            'nama_jurusan'=>'Tadris Ilmu Pengetahuan Sosial',
        ]);


        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Hukum Keluarga Islam (Ahwal Syakhshiyyah)',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Hukum Ekonomi Syari’ah (Mua’malah)',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Perbandingan Mazhab',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Hukum Tata Negara (Siyasah)',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Ekonomi Syariah',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Perbankan Syari’ah',
        ]);
        jurusan::create([
            'fakultas_id' => '3',
            'nama_jurusan'=>'Ilmu Hukum',
        ]);

        jurusan::create([
            'fakultas_id' => '4',
            'nama_jurusan'=>'Aqidah dan Filsafat Islam',
        ]);
        jurusan::create([
            'fakultas_id' => '4',
            'nama_jurusan'=>'Ilmu Al Qur’an Dan Tafsir',
        ]);
        jurusan::create([
            'fakultas_id' => '4',
            'nama_jurusan'=>'Studi Agama Agama',
        ]);
        jurusan::create([
            'fakultas_id' => '4',
            'nama_jurusan'=>'Ilmu Hadis',
        ]);


        jurusan::create([
            'fakultas_id' => '5',
            'nama_jurusan'=>'Pengembangan Masyarakat Islam',
        ]);
        jurusan::create([
            'fakultas_id' => '5',
            'nama_jurusan'=>'Bimbingan dan Konseling Islam',
        ]);
        jurusan::create([
            'fakultas_id' => '5',
            'nama_jurusan'=>'Ilmu Komunikasi',
        ]);
        jurusan::create([
            'fakultas_id' => '5',
            'nama_jurusan'=>'Manajemen Dakwah',
        ]);



        jurusan::create([
            'fakultas_id' => '6',
            'nama_jurusan'=>'Psikologi',
        ]);
        jurusan::create([
            'fakultas_id' => '6',
            'nama_jurusan'=>'Psikologi – S2',
        ]);


        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Manajemen',
        ]);
        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Manajemen Perusahaan',
        ]);
        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Akuntansi',
        ]);
        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Akuntansi D3',
        ]);
        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Ilmu Administrasi Negara',
        ]);
        jurusan::create([
            'fakultas_id' => '7',
            'nama_jurusan'=>'Administrasi Perpajakan',
        ]);


        jurusan::create([
            'fakultas_id' => '8',
            'nama_jurusan'=>'Peternakan',
        ]);
        jurusan::create([
            'fakultas_id' => '8',
            'nama_jurusan'=>'Agroteknologi',
        ]);
        jurusan::create([
            'fakultas_id' => '8',
            'nama_jurusan'=>'Gizi',
        ]);

    }
}

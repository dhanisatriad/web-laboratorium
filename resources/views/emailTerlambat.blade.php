<h3>Laboratorium Tekni Elektro</h3>
 <p><b>PEMBERITAHUAN</b></p>
 <p>hai {{ $nama }}!, masa peminjaman barang berikut telah melebihi jadwal peminjaman </p>
 @foreach ($barangs as $barang)
 <p>{{ $barang }}</p>
 @endforeach
 <p>Harap segera melakukan pengembalian barang ke laboratorium teknik elektro</p>
{{--
<h3>Halo, {{ $nama }} !</h3>
<p>Status: {{ $level }} </p>
<p>Atas Nama: {{ $nama }}</p>
<p>NIP/NIK/NIM: {{ $nim }}</p> --}}

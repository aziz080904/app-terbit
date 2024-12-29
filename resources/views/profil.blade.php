<x-layout>
<!-- Cara 2 - Kirimnya/Desainya Melalui View(untuk BlankPage & Card_Title): -->
<x-slot name="title">Halaman Profil</x-slot> 
<x-slot name="card_title">Profil Pengguna</x-slot> 


<div class="card-body">
    <div class="container">
        <div class="row justify-content-center mt-3"> <!-- Mengurangi margin atas -->
            <div class="col-md-6">
                <div class="card" style="max-height: 400px;"> <!-- Menambahkan max-height -->
                    <div class="card-body p-3"> <!-- Mengurangi padding -->
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class="card-title">Informasi Mahasiswa</h5>
                                <div class="text-center">
                                    <img src="{{ asset('assets/img/foto formal 2.jpg') }}" class="img-fluid" alt="Profile Image">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nama :</strong> Aziz Maulana Hakim</li>
                                    <li class="list-group-item"><strong>NIM :</strong> 0110223208 </li>
                                    <li class="list-group-item"><strong>Program Studi :</strong> TI</li>
                                    <li class="list-group-item"><strong>Dosen Pembimbing :</strong> John Doe</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</x-layout>
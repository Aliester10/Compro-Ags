@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Detail Member</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $member->name }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $member->gender == 'male' ? 'Laki-laki' : ($member->gender == 'female' ? 'Perempuan' : '-') }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>{{ $member->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $member->email }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $member->date_of_birth ? date('d-m-Y', strtotime($member->date_of_birth)) : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Perusahaan</th>
                            <td>{{ $member->nama_perusahaan }}</td>
                        </tr>
                        <tr>
                            <th>Sektor Perusahaan</th>
                            <td>{{ $member->bidangPerusahaan->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $member->alamat }}</td>
                        </tr>
                        @if(isset($password))
                            <tr>
                                <th>Password</th>
                                <td>
                                    {{ $password }}
                                    <p class="text-danger">PEMBERITAHUAN : MOHON AGAR PASSWORD DICATAT KARENA PASSWORD TIDAK ADA DITAMPILKAN KEMBALI.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if(isset($password))
                    <div class="mb-3">
                        <p><strong>Password:</strong> {{ $password }}</p>
                        <p class="text-danger">PEMBERITAHUAN : MOHON AGAR PASSWORD DICATAT KARENA PASSWORD TIDAK ADA DITAMPILKAN KEMBALI.</p>
                    </div>
                @endif

                <div class="mb-3">
                    <div class="card p-4 shadow">
                        <div class="card-header">
                    <h4>Pemilik Produk</h4>
                </div>
                <div class="card-body">
                    @if($member->userProduk->isEmpty())
                        <p>Member ini tidak memiliki produk.</p>
                    @else
                        <div class="row">
                            @foreach($member->userProduk as $userProduk)
                                @php
                                    $firstImage = $userProduk->produk->images->first();
                                    $imageSrc = $firstImage ? $firstImage->gambar : 'assets/img/default.jpg';
                                @endphp
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset($imageSrc) }}" class="card-img-top" alt="{{ $userProduk->produk->nama }}" style="height: 100; object-fit: cover; width:100%;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $userProduk->produk->nama }}</h5>
                                            <p class="card-text"><strong>Tanggal Pembelian :</strong> {{ $userProduk->pembelian ? $userProduk->pembelian : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                </div>
                </div>


                <style>
                    .card {
                        height: 100%;
                        display: flex;
                        flex-direction: column;
                    }

                    .card-img-top {
                        height: 200px; /* Fixed height for the images */
                        object-fit: cover; /* Ensures the image covers the area */
                    }

                    .card-body {
                        flex-grow: 1; /* Makes sure card body grows to take remaining space */
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-end; /* Ensures consistent vertical alignment */
                    }

                    .card-title {
                        font-size: 1rem; /* Ensures the title text is consistent */
                        margin-bottom: 0.5rem;
                    }
                </style>

                <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali ke Daftar Member</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@extends('layouts.Admin.master')

@section('content')
    <h1>Guest Messages</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Perusahaan</th>
                <th>Nomor WhatsApp</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->nama }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->perusahaan }}</td>
                    <td>{{ $message->no_wa }}</td>
                    <td>{{ $message->pesan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

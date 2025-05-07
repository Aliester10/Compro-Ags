<div class="form-group">
    <label for="nama_perusahaan">Nama Perusahaan</label>
    <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $companyParameter->nama_perusahaan ?? '') }}" required>
</div>

<div class="form-group">
    <label for="sejarah_singkat">Sejarah Singkat</label>
    <textarea name="sejarah_singkat" class="form-control">{{ old('sejarah_singkat', $companyParameter->sejarah_singkat ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $companyParameter->email ?? '') }}" required>
</div>

<div class="form-group">
    <label for="no_telepon">Nomor Telepon</label>
    <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $companyParameter->no_telepon ?? '') }}" required>
</div>

<div class="form-group">
    <label for="no_wa">WhatsApp</label>
    <input type="text" name="no_wa" class="form-control" value="{{ old('no_wa', $companyParameter->no_wa ?? '') }}" required>
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" class="form-control" required>{{ old('alamat', $companyParameter->alamat ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="maps">URL Lokasi</label>
    <input type="text" name="maps" class="form-control" value="{{ old('maps', $companyParameter->maps ?? '') }}">
</div>

<div class="form-group">
    <label for="visi">Visi</label>
    <textarea name="visi" class="form-control">{{ old('visi', $companyParameter->visi ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="misi">Misi</label>
    <textarea name="misi" class="form-control">{{ old('misi', $companyParameter->misi ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="about_gambar">Gambar Tentang Kami</label>
    <input type="file" name="about_gambar" class="form-control">
    @if(isset($companyParameter->about_gambar))
        <img src="{{ asset('storage/' . $companyParameter->about_gambar) }}" alt="About Image" width="100">
    @endif
</div>

<div class="form-group">
    <label for="instagram">Instagram</label>
    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $companyParameter->instagram ?? '') }}">
</div>

<div class="form-group">
    <label for="linkedin">LinkedIn</label>
    <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $companyParameter->linkedin ?? '') }}">
</div>

<div class="form-group">
    <label for="ekatalog">Link E-Katalog</label>
    <input type="text" name="ekatalog" class="form-control" value="{{ old('ekatalog', $companyParameter->ekatalog ?? '') }}">
</div>

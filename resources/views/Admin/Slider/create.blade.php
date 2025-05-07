@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="h4">Buat Slider Baru</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" id="sliderForm">
                @csrf
                
                <!-- CATATAN PENTING: HAPUS HIDDEN INPUTS -->
                
                <div class="row">
                    <!-- Kolom Kiri - Form Input -->
                    <div class="col-md-7">
                        <!-- 1. Input Dasar -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Input Dasar</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image_url">Gambar <span class="text-danger">*</span></label>
                                    <input type="file" name="image_url" id="image_url" class="form-control" required>
                                    @error('image_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Judul <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text color-input-wrapper p-1">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="color-preview" id="title-color-preview" style="background-color: {{ old('title_color', '#000000') }}"></div>
                                                    <small class="mt-1">Warna</small>
                                                </div>
                                                <input type="color" id="title_color" name="title_color" 
                                                    value="{{ old('title_color', '#000000') }}" 
                                                    class="color-picker-hidden">
                                            </span>
                                        </div>
                                    </div>
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Deskripsi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
                                        <div class="input-group-append">
                                            <span class="input-group-text color-input-wrapper p-1">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="color-preview" id="description-color-preview" style="background-color: {{ old('description_color', '#000000') }}"></div>
                                                    <small class="mt-1">Warna</small>
                                                </div>
                                                <input type="color" id="description_color" name="description_color" 
                                                    value="{{ old('description_color', '#000000') }}" 
                                                    class="color-picker-hidden">
                                            </span>
                                        </div>
                                    </div>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 2. Spesifikasi (Opsional) -->
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="show_specification" name="show_specification" value="1" 
                                        {{ old('show_specification') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_specification">
                                        <h5 class="mb-0">Tampilkan Spesifikasi</h5>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body specification-section" style="{{ old('show_specification') ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="specification_text">Teks Spesifikasi</label>
                                    <textarea name="specification_text" id="specification_text" class="form-control" rows="3">{{ old('specification_text') }}</textarea>
                                    @error('specification_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="line_color">Warna Garis</label>
                                    <div class="d-flex align-items-center">
                                        <input type="color" name="line_color" id="line_color" class="form-control" style="width: 60px; height: 40px;" value="{{ old('line_color', '#dddddd') }}">
                                        <span class="ml-2" id="line_color_code">{{ old('line_color', '#dddddd') }}</span>
                                    </div>
                                    @error('line_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="specification_color">Warna Teks Spesifikasi</label>
                                    <div class="d-flex align-items-center">
                                        <input type="color" name="specification_color" id="specification_color" class="form-control" style="width: 60px; height: 40px;" value="{{ old('specification_color', '#000000') }}">
                                        <span class="ml-2" id="specification_color_code">{{ old('specification_color', '#000000') }}</span>
                                    </div>
                                    @error('specification_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- 3. Tombol Button (Opsional) -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="show_button" name="show_button" value="1" 
                                        {{ old('show_button') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_button">
                                        <h5 class="mb-0">Tampilkan Button</h5>
                                    </label>
                                </div>
                            </div>
                            <div class="card-body button-section" style="{{ old('show_button') ? '' : 'display:none;' }}">
                                <div class="form-group">
                                    <label for="button_text">Label Tombol</label>
                                    <div class="input-group">
                                        <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text', 'Read More') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text color-input-wrapper p-1">
                                                <div class="d-flex flex-column align-items-center">
                                                    <div class="color-preview" id="button-text-color-preview" style="background-color: {{ old('button_text_color', '#FFFFFF') }}"></div>
                                                    <small class="mt-1">Warna Teks</small>
                                                </div>
                                                <input type="color" id="button_text_color" name="button_text_color" 
                                                    value="{{ old('button_text_color', '#FFFFFF') }}" 
                                                    class="color-picker-hidden">
                                            </span>
                                        </div>
                                    </div>
                                    @error('button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="button_url">URL Tombol</label>
                                    <select name="button_url" id="button_url" class="form-control">
                                        <option value="">Pilih rute/aktivitas</option>

                                        <!-- Predefined Routes -->
                                        @foreach ($routes as $name => $url)
                                            <option value="{{ $url }}" {{ old('button_url') == $url ? 'selected' : '' }}>
                                                {{ ucfirst($name) }} (Predefined)
                                            </option>
                                        @endforeach

                                        <!-- Dynamic Activities -->
                                        @foreach ($activities as $activity)
                                            <option value="{{ route('activity.show', $activity->id) }}"
                                                {{ old('button_url') == route('activity.show', $activity->id) ? 'selected' : '' }}>
                                                {{ $activity->title }} (Activity)
                                            </option>
                                        @endforeach

                                        <!-- Meta -->
                                        @foreach ($metas as $meta)
                                            <option value="{{ route('member.meta.show', $meta->slug) }}"
                                                {{ old('button_url') == route('member.meta.show', $meta->slug) ? 'selected' : '' }}>
                                                {{ $meta->title }} (Meta)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('button_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan - Preview -->
                    <div class="col-md-5">
                        <div class="card sticky-top" style="top: 20px;">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Preview</h5>
                            </div>
                            <div class="card-body">
                                <div class="slider-preview">
                                    <div class="preview-image-container mb-3">
                                        <img id="preview-image" src="{{ asset('images/placeholder.jpg') }}" alt="Preview Image" class="img-fluid w-100" style="max-height: 200px; object-fit: cover;">
                                    </div>

                                    <div class="preview-content p-3 border">
                                        <h3 id="preview-title" style="color: {{ old('title_color', '#000000') }}">{{ old('title') ?: 'Judul Slider' }}</h3>
                                        
                                        <p id="preview-description" style="color: {{ old('description_color', '#000000') }}">{{ old('description') ?: 'Deskripsi slider akan muncul di sini. Ini adalah contoh teks.' }}</p>
                                        
                                        <div id="preview-specification-container" class="{{ old('show_specification') ? '' : 'd-none' }}">
                                            <hr id="preview-line" style="border-color: {{ old('line_color', '#dddddd') }};">
                                            <p id="preview-specification" style="color: {{ old('specification_color', '#000000') }}">{{ old('specification_text') ?: 'Teks spesifikasi akan muncul di sini.' }}</p>
                                        </div>
                                        
                                        <div id="preview-button-container" class="{{ old('show_button') ? '' : 'd-none' }} text-center mt-3">
                                            <button type="button" id="preview-button" class="btn btn-primary">
                                                <span id="preview-button-text" style="color: {{ old('button_text_color', '#FFFFFF') }}">
                                                    {{ old('button_text', 'Read More') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success">Simpan Slider</button>
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .color-input-wrapper {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        width: auto;
        cursor: pointer;
    }
    
    .color-preview {
        width: 30px;
        height: 30px;
        border: 2px solid #ced4da;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: relative;
    }
    
    .color-picker-hidden {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }
    
    .color-preview:hover {
        border-color: #6c757d;
        transform: scale(1.05);
        transition: all 0.2s;
    }
    
    .color-input-wrapper:hover {
        background-color: #e9ecef;
    }
    
    /* Tambahan untuk preview */
    .preview-content {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
        .sticky-top {
            position: relative;
            top: 0 !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pengaturan Toggle Section
    const showSpecificationCheckbox = document.getElementById('show_specification');
    const specificationSection = document.querySelector('.specification-section');
    const previewSpecificationContainer = document.getElementById('preview-specification-container');
    
    const showButtonCheckbox = document.getElementById('show_button');
    const buttonSection = document.querySelector('.button-section');
    const previewButtonContainer = document.getElementById('preview-button-container');
    
    // Toggle Spesifikasi
    showSpecificationCheckbox.addEventListener('change', function() {
        specificationSection.style.display = this.checked ? 'block' : 'none';
        previewSpecificationContainer.classList.toggle('d-none', !this.checked);
    });
    
    // Toggle Button
    showButtonCheckbox.addEventListener('change', function() {
        buttonSection.style.display = this.checked ? 'block' : 'none';
        previewButtonContainer.classList.toggle('d-none', !this.checked);
    });
    
    // Image Preview
    document.getElementById('image_url').addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
    
    // Title Preview
    const titleInput = document.getElementById('title');
    const titleColorInput = document.getElementById('title_color');
    const titleColorPreview = document.getElementById('title-color-preview');
    const previewTitle = document.getElementById('preview-title');
    
    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Judul Slider';
    });
    
    titleColorInput.addEventListener('input', function() {
        previewTitle.style.color = this.value;
        titleColorPreview.style.backgroundColor = this.value;
    });
    
    titleColorPreview.addEventListener('click', function() {
        titleColorInput.click();
    });
    
    // Description Preview
    const descriptionInput = document.getElementById('description');
    const descriptionColorInput = document.getElementById('description_color');
    const descriptionColorPreview = document.getElementById('description-color-preview');
    const previewDescription = document.getElementById('preview-description');
    
    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value || 'Deskripsi slider akan muncul di sini. Ini adalah contoh teks.';
    });
    
    descriptionColorInput.addEventListener('input', function() {
        previewDescription.style.color = this.value;
        descriptionColorPreview.style.backgroundColor = this.value;
    });
    
    descriptionColorPreview.addEventListener('click', function() {
        descriptionColorInput.click();
    });
    
    // Specification Preview
    const specificationTextInput = document.getElementById('specification_text');
    const specificationColorInput = document.getElementById('specification_color');
    const lineColorInput = document.getElementById('line_color');
    const previewSpecification = document.getElementById('preview-specification');
    const previewLine = document.getElementById('preview-line');
    const specColorCode = document.getElementById('specification_color_code');
    const lineColorCode = document.getElementById('line_color_code');
    
    if (specificationTextInput) {
        specificationTextInput.addEventListener('input', function() {
            previewSpecification.textContent = this.value || 'Teks spesifikasi akan muncul di sini.';
        });
    }
    
    if (specificationColorInput) {
        specificationColorInput.addEventListener('input', function() {
            previewSpecification.style.color = this.value;
            specColorCode.textContent = this.value;
        });
    }
    
    if (lineColorInput) {
        lineColorInput.addEventListener('input', function() {
            previewLine.style.borderColor = this.value;
            lineColorCode.textContent = this.value;
        });
    }
    
    // Button Preview
    const buttonTextInput = document.getElementById('button_text');
    const buttonTextColorInput = document.getElementById('button_text_color');
    const buttonTextColorPreview = document.getElementById('button-text-color-preview');
    const previewButtonText = document.getElementById('preview-button-text');
    
    if (buttonTextInput) {
        buttonTextInput.addEventListener('input', function() {
            previewButtonText.textContent = this.value || 'Read More';
        });
    }
    
    if (buttonTextColorInput) {
        buttonTextColorInput.addEventListener('input', function() {
            previewButtonText.style.color = this.value;
            buttonTextColorPreview.style.backgroundColor = this.value;
        });
    }
    
    if (buttonTextColorPreview) {
        buttonTextColorPreview.addEventListener('click', function() {
            buttonTextColorInput.click();
        });
    }
});
</script>
@endsection
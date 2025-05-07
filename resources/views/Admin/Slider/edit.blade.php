@extends('layouts.Admin.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header">
                <h1 class="h4">Edit Slider</h1>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="image_url">Gambar</label>
                        <input type="file" name="image_url" class="form-control">
                        <img src="{{ asset($slider->image_url) }}" alt="slider image" class="img-thumbnail mt-3" style="max-width: 150px; height: auto;">
                        @error('image_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}">
                        <small class="form-text text-muted">Pilih warna untuk judul</small>
                        <input type="color" name="title_color" class="form-control w-25 mt-25" value="{{ old('title_color', '#000000') }}">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
                        <small class="form-text text-muted">Pilih warna untuk deskripsi</small>
                        <input type="color" name="description_color" class="form-control mt-10 w-25" value="{{ old('description_color', '#000000') }}">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button_text">Teks Tombol</label>
                        <input type="text" name="button_text" class="form-control" value="{{ $slider->button_text }}">
                        @error('button_text')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="button_url">URL Tombol</label>
                        <select name="button_url" class="form-control">
                            <option value="">Select a predefined route or activity</option>

                            <!-- Predefined Routes -->
                            @foreach ($routes as $name => $url)
                                <option value="{{ $url }}" {{ $slider->button_url == $url ? 'selected' : '' }}>
                                    {{ ucfirst($name) }} (Predefined)
                                </option>
                            @endforeach

                            <!-- Dynamic Activities -->
                            @foreach ($activities as $activity)
                                <option value="{{ route('activity.show', $activity->id) }}"
                                    {{ $slider->button_url == route('activity.show', $activity->id) ? 'selected' : '' }}>
                                    {{ $activity->title }} (Activity)
                                </option>
                            @endforeach

                            <!-- Meta -->
                            @foreach ($metas as $meta)
                                <option value="{{ route('member.meta.show', $meta->slug) }}"
                                    {{ $slider->button_url == route('member.meta.show', $meta->slug) ? 'selected' : '' }}>
                                    {{ $meta->title }} (Meta)
                                </option>
                            @endforeach
                        </select>
                        @error('button_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Perbaharui Slider</button>
                </form>
            </div>
        </div>
    </div>
@endsection

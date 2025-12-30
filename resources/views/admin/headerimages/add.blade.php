@extends('admin.layouts.admin')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <h1 class="h3 mb-0">Header Image qo'shish</h1>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('headerimages.index') }}" class="btn btn-primary">
                    Header Image lar
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Qo'shish</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('headerimages.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <div class="col-12">
                            <div class="form-group floating-label">
                                <select name="page_id"
                                    class="form-control @error('page_id') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected hidden></option>
                                    @foreach($pages as $page)
                                    <option value="{{ $page->id }}"
                                        {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                        {{ $page->page_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label class="form-label">Sahifa</label>
                                @error('page_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="col-12">
                            <div class="form-group floating-label">
                                <input type="file"
                                    name="header_image"
                                    class="form-control @error('header_image') is-invalid @enderror"
                                    placeholder=" "
                                    required>
                                <!-- <label class="form-label">Header Image</label> -->
                                @error('header_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- Saqlash tugmasi --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                Saqlash
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.layouts.admin')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <h1 class="h3 mb-0">Header Image ni tahrirlash</h1>
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
                <h5 class="card-title mb-0">Tahrirlash</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('headerimages.update', $headerimage->id) }}"
                    method="POST"
                    class="needs-validation"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        {{-- Page select --}}
                        <div class="col-12">
                            <div class="form-group floating-label">
                                <select name="page_id"
                                    class="form-control @error('page_id') is-invalid @enderror"
                                    required>
                                    <option value="" disabled hidden></option>
                                    @foreach($pages as $page)
                                    <option value="{{ $page->id }}"
                                        {{ old('page_id', $headerimage->page_id) == $page->id ? 'selected' : '' }}>
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

                        {{-- Header Image file --}}
                        <div class="col-12">
                            <div class="form-group floating-label">
                                <input type="file"
                                    name="header_image"
                                    class="form-control @error('header_image') is-invalid @enderror"
                                    placeholder=" ">
                                @error('header_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                {{-- Old image preview --}}
                                @if($headerimage->header_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$headerimage->header_image) }}"
                                        alt="Header Image"
                                        style="max-height: 120px;">
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Submit --}}
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
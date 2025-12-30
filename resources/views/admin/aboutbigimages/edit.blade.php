@extends('admin.layouts.admin')
@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center m-4">
            <div>
                <h1 class="h3 mb-0">Sahifani tahrirlash</h1>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('pages.index') }}" class="btn btn-primary">
                    Sahifalar
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
                <form
                    action="{{ route('pages.update', $page->id) }}"
                    method="POST"
                    class="needs-validation"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-12">
                            <div class="form-group floating-label">
                                <input type="text"
                                    name="page_name"
                                    class="form-control @error('page_name') is-invalid @enderror"
                                    value="{{ old('page_name', $page->page_name) }}"
                                    placeholder=" "
                                    required>
                                <label class="form-label">Sahifa Nomi</label>
                                @error('page_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- Tugma --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Yangilash
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
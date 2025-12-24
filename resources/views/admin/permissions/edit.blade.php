@extends('admin.layouts.admin')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h1 class="h3 mb-0">Ruxsatlarni tahrirlash</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary">
                        Ruxsatlar
                    </a>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{--                        <i class="bi bi-plus me-2 text-primary"></i>--}}
                        Tahrirlash
                    </h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('permissions.store') }}"
                        method="POST"
                        class="needs-validation"
                        novalidate>
                        @csrf

                        <div class="row g-3">
                            {{-- Ruxsat nomi --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $permission->name ?? '') }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Ruxsat nomi</label>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Sarlavha --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="text"
                                           name="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title', $permission->title ?? '') }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Sarlavha</label>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tugma --}}
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

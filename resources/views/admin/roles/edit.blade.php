@extends('admin.layouts.admin')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h1 class="h3 mb-0">Rolni tahrirlash</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                        Rollar
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
                        action="{{ route('roles.update', $role->id) }}"
                        method="POST"
                        class="needs-validation"
                        novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Rol nomi --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $role->name) }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Rol nomi</label>
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
                                           value="{{ old('title', $role->title) }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Sarlavha</label>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Ruxsatlar (Dual Listbox) --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="permissions">Ruxsatlarni tanlang</label>
                                    <select multiple name="permissions[]" class="form-control dual-listbox duallistbox">
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                {{ (collect(old('permissions', $role->permissions->pluck('id')->toArray()))->contains($permission->id)) ? 'selected' : '' }}>
                                                {{ $permission->title ?? $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Tugma --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
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

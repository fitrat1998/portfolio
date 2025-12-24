@extends('admin.layouts.admin')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h1 class="h3 mb-0">Foydalanuvchi qo'shish</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        Foydalanuvchilar
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
                    <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            {{-- F.I.Sh --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">F.I.Sh</label>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Login --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="text"
                                           name="login"
                                           class="form-control @error('login') is-invalid @enderror"
                                           value="{{ old('login') }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Login</label>
                                    @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-12">
                                <div class="form-group floating-label">
                                    <input type="email"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder=" "
                                           required>
                                    <label class="form-label">Email</label>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Parol --}}
                            <div class="col-12">
                                <div class="form-group floating-label position-relative">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder=" "
                                           required
                                           oninput="checkPasswordMatch()">
                                    <label class="form-label">Parol</label>
                                    <span class="toggle-password" onclick="togglePassword('password', this)"
                                          style="position:absolute; top:50%; right:12px; transform:translateY(-50%); cursor:pointer;">
                                        👁️
                                    </span>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Parolni tasdiqlash --}}
                            <div class="col-12">
                                <div class="form-group floating-label position-relative">
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           placeholder=" "
                                           required
                                           oninput="checkPasswordMatch()">
                                    <label class="form-label">Parolni tasdiqlang</label>
                                    <span class="toggle-password"
                                          onclick="togglePassword('password_confirmation', this)"
                                          style="position:absolute; top:50%; right:12px; transform:translateY(-50%); cursor:pointer;">
                                        👁️
                                    </span>
                                    <div id="password-match-success" class="valid-feedback" style="display:none;">
                                        ✅ Tasdiqlandi
                                    </div>
                                    <div id="password-match-error" class="invalid-feedback" style="display:none;">
                                        ❌ Parollar mos emas
                                    </div>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Rollar --}}
                            <div class="col-12">
                                <label class="form-label mb-2">Rollar</label>
                                <select name="roles[]"
                                        class="form-control select2 @error('roles') is-invalid @enderror"
                                        multiple required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('roles.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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

<form action="{{ $isEdit ? route('permissions.update', $permission->id) : route('permissions.store') }}"
      method="POST"
      class="needs-validation"
      novalidate>
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

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
                <i class="bi {{ $isEdit ? 'bi-pencil-square' : 'bi-send' }} me-2"></i>
                {{ $isEdit ? 'Yangilash' : 'Saqlash' }}
            </button>
        </div>
    </div>
</form>

@extends('layouts.app')

@section('title', 'Kullanıcı Düzenle')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 d-flex align-items-center gap-2">
                        <i data-lucide="edit-3" style="width:20px;height:20px;color:var(--brand-700)"></i>
                        Kullanıcı Düzenle: {{ $user->name }}
                    </h5>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Geri Dön</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Ad Soyad</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta Adresi</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label">Kullanıcı Rolü</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="" disabled>Rol Seçiniz</option>
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ old('role', $user->roles->first()?->name) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i data-lucide="save" style="width:18px;height:18px"></i> Güncelle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

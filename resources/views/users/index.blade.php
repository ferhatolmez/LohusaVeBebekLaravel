@extends('layouts.app')

@section('title', 'Kullanıcı Yönetimi')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
        <h1 class="h3 mb-0 d-flex align-items-center gap-2">
            <i data-lucide="users" style="color:var(--brand-700)"></i>
            Kullanıcı Yönetimi
        </h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="plus" style="width:18px;height:18px"></i> Yeni Kullanıcı
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="glass-panel p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-responsive-stack table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Ad Soyad</th>
                        <th>E-posta</th>
                        <th>Rol</th>
                        <th>Kayıt Tarihi</th>
                        <th class="text-end pe-4">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td data-label="Ad Soyad" class="ps-4 fw-medium">{{ $user->name }}</td>
                            <td data-label="E-posta" class="text-secondary">{{ $user->email }}</td>
                            <td data-label="Rol">
                                @foreach($user->roles as $role)
                                    @php
                                        $enumRole = \App\Enums\Role::tryFrom($role->name);
                                    @endphp
                                    <span class="badge" style="{{ $enumRole?->badgeStyle() ?? 'background-color:#6c757d;color:#fff' }}">
                                        {{ $enumRole?->label() ?? $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td data-label="Kayıt Tarihi" class="text-secondary">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                            <td data-label="İşlemler" class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Düzenle">
                                        <i data-lucide="edit-2" style="width:16px;height:16px"></i>
                                    </a>
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Sil">
                                                <i data-lucide="trash-2" style="width:16px;height:16px"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-secondary">Sistemde kullanıcı bulunmuyor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection

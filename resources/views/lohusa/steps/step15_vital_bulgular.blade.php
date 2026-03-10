@php
    $defaults = $clinicalDefaults['bebek'];
@endphp
<div class="form-section card shadow-sm mb-4">
    <div class="card-header">Vital bulgular</div>
    <div class="card-body">
        <p class="text-secondary small mb-3">Bebek ölçüleri tipik yenidoğan ortalamalarıyla açılır; mevcut ölçüme göre güncelleyin.</p>
        <div class="row g-3">
            <div class="col-md-2"><label class="form-label">Ateş</label><input type="number" step="0.1" min="34" max="42" name="ates" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates', $defaults['ates']) }}"></div>
            <div class="col-md-2"><label class="form-label">Nabız</label><input type="number" min="60" max="220" name="nabiz" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz', $defaults['nabiz']) }}"></div>
            <div class="col-md-2"><label class="form-label">Solunum</label><input type="number" min="10" max="120" name="solunum" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum', $defaults['solunum']) }}"></div>
            <div class="col-md-2"><label class="form-label">Kilo</label><input type="number" step="0.01" min="0.5" max="10" name="kilo" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo', $defaults['kilo']) }}"></div>
            <div class="col-md-2"><label class="form-label">Boy</label><input type="number" step="0.01" min="20" max="100" name="boy" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy', $defaults['boy']) }}"></div>
            <div class="col-md-2"><label class="form-label">Baş çevresi</label><input type="number" step="0.01" min="10" max="80" name="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi', $defaults['bas_cevresi']) }}"></div>
            <div class="col-md-2"><label class="form-label">Göğüs çevresi</label><input type="number" step="0.01" min="10" max="80" name="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi', $defaults['gogus_cevresi']) }}"></div>
        </div>
    </div>
</div>


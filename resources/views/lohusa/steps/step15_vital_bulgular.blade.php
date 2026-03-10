@php
    $defaults = $clinicalDefaults['bebek'];
@endphp
<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">Vital Bulgular</div>
    <div class="card-body">
        <p class="text-muted small mb-3">Bebek olculeri tipik yenidogan ortalamalariyla acilir; mevcut olcume gore guncelleyin.</p>
        <div class="row">
            <div class="col-md-2"><label>Ateş</label><input type="number" step="0.1" name="ates" class="form-control" value="{{ old('ates', $defaults['ates']) }}"></div>
            <div class="col-md-2"><label>Nabız</label><input type="number" name="nabiz" class="form-control" value="{{ old('nabiz', $defaults['nabiz']) }}"></div>
            <div class="col-md-2"><label>Solunum</label><input type="number" name="solunum" class="form-control" value="{{ old('solunum', $defaults['solunum']) }}"></div>
            <div class="col-md-2"><label>Kilo</label><input type="number" step="0.01" name="kilo" class="form-control" value="{{ old('kilo', $defaults['kilo']) }}"></div>
            <div class="col-md-2"><label>Boy</label><input type="number" step="0.01" name="boy" class="form-control" value="{{ old('boy', $defaults['boy']) }}"></div>
            <div class="col-md-2"><label>Baş Çevresi</label><input type="number" step="0.01" name="bas_cevresi" class="form-control" value="{{ old('bas_cevresi', $defaults['bas_cevresi']) }}"></div>
            <div class="col-md-2 mt-2"><label>Göğüs Çevresi</label><input type="number" step="0.01" name="gogus_cevresi" class="form-control" value="{{ old('gogus_cevresi', $defaults['gogus_cevresi']) }}"></div>
        </div>
    </div>
</div>

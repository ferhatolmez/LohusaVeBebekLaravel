@php
    $defaults = $clinicalDefaults['bebek'];
@endphp
<div class="form-section card shadow-sm mb-4">
    <div class="card-header">Vital bulgular</div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-2">
                <label for="ates_bebek" class="form-label">Ateş</label>
                <input type="number" step="0.1" min="34" max="42" name="ates" id="ates_bebek" class="form-control @error('ates') is-invalid @enderror" value="{{ old('ates') }}">
                @error('ates')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="nabiz_bebek" class="form-label">Nabız</label>
                <input type="number" step="1" min="60" max="220" name="nabiz" id="nabiz_bebek" class="form-control @error('nabiz') is-invalid @enderror" value="{{ old('nabiz') }}">
                @error('nabiz')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="solunum_bebek" class="form-label">Solunum</label>
                <input type="number" step="1" min="10" max="120" name="solunum" id="solunum_bebek" class="form-control @error('solunum') is-invalid @enderror" value="{{ old('solunum') }}">
                @error('solunum')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="kilo_bebek" class="form-label">Kilo</label>
                <input type="number" step="0.01" min="0.5" max="10" name="kilo" id="kilo_bebek" class="form-control @error('kilo') is-invalid @enderror" value="{{ old('kilo') }}">
                @error('kilo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="boy_bebek" class="form-label">Boy</label>
                <input type="number" step="0.1" min="20" max="100" name="boy" id="boy_bebek" class="form-control @error('boy') is-invalid @enderror" value="{{ old('boy') }}">
                @error('boy')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="bas_cevresi" class="form-label">Baş çevresi</label>
                <input type="number" step="0.1" min="10" max="60" name="bas_cevresi" id="bas_cevresi" class="form-control @error('bas_cevresi') is-invalid @enderror" value="{{ old('bas_cevresi') }}">
                @error('bas_cevresi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-2">
                <label for="gogus_cevresi" class="form-label">Göğüs çevresi</label>
                <input type="number" step="0.1" min="10" max="60" name="gogus_cevresi" id="gogus_cevresi" class="form-control @error('gogus_cevresi') is-invalid @enderror" value="{{ old('gogus_cevresi') }}">
                @error('gogus_cevresi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>



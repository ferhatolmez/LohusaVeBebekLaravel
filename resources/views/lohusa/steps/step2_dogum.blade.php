        <div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">A.2 Eşin Tanıtıcı Bilgileri</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for="es_yas" class="form-label">Eşinin Yaşı</label>
                        <input type="number" name="es_yas" id="es_yas" class="form-control @error('es_yas') is-invalid @enderror" value="{{ old('es_yas') }}" min="15" max="100">
                        @error('es_yas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="es_dogum_yeri" class="form-label">Eşinin Doğum Yeri</label>
                        <input type="text" name="es_dogum_yeri" id="es_dogum_yeri" class="form-control only-letters @error('es_dogum_yeri') is-invalid @enderror" value="{{ old('es_dogum_yeri') }}">
                        @error('es_dogum_yeri')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="es_egitim" class="form-label">Eğitim durumu</label>
                        <select name="es_egitim" id="es_egitim" class="form-select @error('es_egitim') is-invalid @enderror">
                            <option value="">Seçiniz</option>
                            @foreach (\App\Support\MedicalFormOptions::educationLevels() as $option)
                                <option value="{{ $option }}" @selected(old('es_egitim') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('es_egitim')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="es_meslek" class="form-label">Meslek</label>
                        <input type="text" name="es_meslek" id="es_meslek" class="form-control only-letters @error('es_meslek') is-invalid @enderror" value="{{ old('es_meslek') }}">
                        @error('es_meslek')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="es_kan_grubu" class="form-label">Kan Grubu</label>
                        <select name="es_kan_grubu" id="es_kan_grubu" class="form-select @error('es_kan_grubu') is-invalid @enderror">
                            <option value="">Seçiniz</option>
                            @foreach (\App\Support\MedicalFormOptions::bloodGroups() as $option)
                                <option value="{{ $option }}" @selected(old('es_kan_grubu') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('es_kan_grubu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="es_telefon" class="form-label">Telefon</label>
                        <input type="text" name="es_telefon" id="es_telefon" class="form-control only-numbers @error('es_telefon') is-invalid @enderror" value="{{ old('es_telefon') }}" placeholder="(5xx) xxx xx xx" data-inputmask="'mask': '(999) 999 99 99'" data-mask>
                        @error('es_telefon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-12 mt-2">
                        <label for="es_adres" class="form-label">Adres</label>
                        <textarea name="es_adres" id="es_adres" class="form-control @error('es_adres') is-invalid @enderror" rows="2">{{ old('es_adres') }}</textarea>
                        @error('es_adres')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

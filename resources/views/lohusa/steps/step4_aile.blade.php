<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">C. Geçmiş Tıbbi Öykü</div>

    <div class="card-body">
        <div class="mb-3">
            <label>Aşağıdaki durumlardan herhangi biri sizde ya da ailenizde oldu mu?</label>
        </div>

        <p><strong>Kendisi İçin</strong></p>
        @php
        $conditions = [
            'Operasyon', 'Cinsel yolla bulaşan hastalık', 'Kalp hastalığı', 'Romatizmal ateş',
            'Hipertansiyon', 'Tüberküloz', 'Astım', 'Sarılık', 'Ülser', 'Diyabet', 'Varikoz venler',
            'Tromboflebit', 'Tiroid problemleri', 'Depresyon veya gerginlik', 'Cinsel problemler',
            'İdrar yolları enfeksiyonu', 'Diğer problemler'
        ];
        @endphp

        @foreach ($conditions as $index => $item)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="gecmis_tibbi_oyku_kendisi[]" id="kendisi_{{ $index }}" value="{{ $item }}" @checked(in_array($item, old('gecmis_tibbi_oyku_kendisi', [])))>
            <label class="form-check-label" for="kendisi_{{ $index }}">{{ $item }}</label>
        </div>
        @endforeach

        <p class="mt-3"><strong>Ailesi İçin</strong></p>
        @foreach ($conditions as $index => $item)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="gecmis_tibbi_oyku_ailesi[]" id="ailesi_{{ $index }}" value="{{ $item }}" @checked(in_array($item, old('gecmis_tibbi_oyku_ailesi', [])))>
            <label class="form-check-label" for="ailesi_{{ $index }}">{{ $item }}</label>
        </div>
        @endforeach

        <div class="mt-3">
            <label for="gecmis_tibbi_oyku_diger_aciklama" class="form-label">Diğer Problemler Açıklama:</label>
            <textarea name="gecmis_tibbi_oyku_diger_aciklama" id="gecmis_tibbi_oyku_diger_aciklama" class="form-control @error('gecmis_tibbi_oyku_diger_aciklama') is-invalid @enderror">{{ old('gecmis_tibbi_oyku_diger_aciklama') }}</textarea>
            @error('gecmis_tibbi_oyku_diger_aciklama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
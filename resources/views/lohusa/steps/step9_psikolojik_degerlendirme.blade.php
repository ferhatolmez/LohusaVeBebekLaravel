        <div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">H. Psikolojik Değerlendirme</div>
            <div class="card-body">

                @php
                $psikolojik_belirtiler = [
                    'Aşırı sağlama / kontrol periyodları', 'Uykusuzluk', 'Anoreksi', 'Sinirlilik', 'Mutsuzluk',
                    'Yerinde duramama', 'Aile üyelerine ve bebeğe öfke', 'Dikkat azlığı',
                    'Mood değişikliği', 'Sosyal izolasyon', 'Depresyon', 'Kendine güvensizlik',
                    'Aşırı yorulma', 'Sorumluluklarda artma', 'Enfeksiyon-ağrı', 'Bebek hakkında endişe',
                    'Emzirmede güçlük', 'Eş geçimsizliği', 'Aile içi ilişki bozukluğu',
                    'Alkolik eş', 'Evde sakat birey', 'Diğer'
                ];
                @endphp

                @foreach ($psikolojik_belirtiler as $index => $belirti)
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="psikolojik_belirtiler[]" id="psikolojik_{{ $index }}" value="{{ $belirti }}" class="form-check-input @error('psikolojik_belirtiler') is-invalid @enderror" @checked(in_array($belirti, old('psikolojik_belirtiler', [])))>
                        <label class="form-check-label" for="psikolojik_{{ $index }}">{{ $belirti }}</label>
                    </div>
                @endforeach
                @error('psikolojik_belirtiler')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                <div class="mt-3">
                    <label for="psikolojik_diger_aciklama">Diğer Belirtiler Açıklama:</label>
                    <textarea name="psikolojik_diger_aciklama" id="psikolojik_diger_aciklama" class="form-control @error('psikolojik_diger_aciklama') is-invalid @enderror" rows="2">{{ old('psikolojik_diger_aciklama') }}</textarea>
                    @error('psikolojik_diger_aciklama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
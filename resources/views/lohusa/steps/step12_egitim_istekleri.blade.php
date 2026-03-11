        <div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">J. Eğitim İstekleri</div>
            <div class="card-body">

                @php
                $egitim_konulari = [
                    'Lohusalıkta fiziksel ve psikolojik değişiklikler', 'Kişisel hijyen', 'Göğüs bakımı',
                    'Sağma teknikleri', 'Beslenme', 'Aile planlaması', 'Egzersizler', 'Perine bakımı',
                    'Cinsel yaşam', 'Emzirme', 'Annelik becerileri', 'Anne-bebek ilişkisi',
                    'Bebek banyosu', 'Göbek bakımı', 'Pişik', 'Büyüme-gelişim', 'Aşılar',
                    'Biberonla besleme', 'Ek besinler', 'Gaz çıkarma', 'Diğer'
                ];
                @endphp
                <label class="fw-bold text-danger">Aşağıdaki konulardan hangileri hakkında eğitim almak istersiniz?</label>
                <br>
                @foreach ($egitim_konulari as $index => $konu)

                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('egitim_istekleri') is-invalid @enderror" type="checkbox" name="egitim_istekleri[]" id="egitim_{{ $index }}" value="{{ $konu }}" @checked(in_array($konu, old('egitim_istekleri', [])))>
                        <label class="form-check-label" for="egitim_{{ $index }}">{{ $konu }}</label>
                    </div>
                @endforeach
                @error('egitim_istekleri')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>
        </div>
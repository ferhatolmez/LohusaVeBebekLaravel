        <div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">İ. Emzirmenin Değerlendirilmesi</div>
            <div class="card-body">

                @php
                $emzirme_bulgular = [
                    'Emzirmenin sonrası yumuşak memeler', 'İleri uzamış dik meme uçları', 'Sağlıklı görünen deri', 'Emzirirken anne gevşek rahat pozisyonda',
                    'Bebeğin vücudu anneye ve bebeğe yakın','Bebeğin başı ve vücudu düz aynı hizada','Bebeğin ağzı genişçe açık', 'Dudaklar dışa dönük', 'Yanaklar yuvarlak',
                    'Ağız üzerinde daha fazla areola', 'Yavaş ve derin emme ve arada dinlenme', 'Göğüs ucunda ağrı ve acı yok'
                ];
                @endphp

                @foreach ($emzirme_bulgular as $index => $bulgu)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('emzirme_bulgular') is-invalid @enderror" type="checkbox" name="emzirme_bulgular[]" id="emzirme_{{ $index }}" value="{{ $bulgu }}" @checked(in_array($bulgu, old('emzirme_bulgular', [])))>
                        <label class="form-check-label" for="emzirme_{{ $index }}">{{ $bulgu }}</label>
                    </div>
                @endforeach
                @error('emzirme_bulgular')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror

                <div class="mt-3">
                    <label for="emzirme_suresi" class="form-label">Emzirme süresi (dakika):</label>
                    <input type="number" name="emzirme_suresi" id="emzirme_suresi" class="form-control @error('emzirme_suresi') is-invalid @enderror" value="{{ old('emzirme_suresi') }}">
                    @error('emzirme_suresi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                @php
                $sut_bulgular = [
                    'Bebek yeterli süt alıyor', 'Günde en az 8 kez emzirme', 'Bebeğin gaitası sarı',
                    'Bebek günde 6-8 kez idrar yapıyor (hazır bez 5-6)', 'Bebek günde 2-5 kez gaita yapıyor', 'Bir göğüsten 4 dk’dan az veya 30 dk’dan fazla emme (sorun göstergesi)'
                ];
                @endphp

                <div class="mt-3">
                    <label class="fw-bold text-danger">Bebekte süt yeterliliği göstergeleri:</label>
                    <br>
                    @foreach ($sut_bulgular as $index => $item)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('sut_yeterliligi') is-invalid @enderror" type="checkbox" name="sut_yeterliligi[]" id="sut_{{ $index }}" value="{{ $item }}" @checked(in_array($item, old('sut_yeterliligi', [])))>
                            <label class="form-check-label" for="sut_{{ $index }}">{{ $item }}</label>
                        </div>
                    @endforeach
                    @error('sut_yeterliligi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
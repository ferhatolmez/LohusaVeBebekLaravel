<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">D. Menstruel Öykü</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="menars_yasi" class="form-label">Menarş Yaşı:</label>
                <input type="number" name="menars_yasi" id="menars_yasi" class="form-control @error('menars_yasi') is-invalid @enderror" value="{{ old('menars_yasi') }}" min="9" max="19">
                @error('menars_yasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3">
            <label>Menstrüel siklus süresi (normalden sapma varsa işaretleyin):</label><br>
            <div class="form-check">
                <input type="checkbox" name="normal_sure_25_kisa" id="sure_kisa" value="25 günden kısa" class="form-check-input @error('normal_sure_25_kisa') is-invalid @enderror" @checked(old('normal_sure_25_kisa'))>
                <label class="form-check-label" for="sure_kisa">25 günden kısa</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="normal_sure_35_uzun" id="sure_uzun" value="35 günden uzun" class="form-check-input @error('normal_sure_35_uzun') is-invalid @enderror" @checked(old('normal_sure_35_uzun'))>
                <label class="form-check-label" for="sure_uzun">35 günden uzun</label>
            </div>
        </div>

        <div class="mt-3">
            <label>Kanama süresi (normalden sapma varsa işaretleyin):</label><br>
            <div class="form-check">
                <input type="checkbox" name="kanama_sure_3_kisa" id="kanama_kisa" value="3 günden kısa" class="form-check-input @error('kanama_sure_3_kisa') is-invalid @enderror" @checked(old('kanama_sure_3_kisa'))>
                <label class="form-check-label" for="kanama_kisa">3 günden kısa</label>
            </div>
            <div class="form-check">
                <input type="checkbox" name="kanama_sure_7_uzun" id="kanama_uzun" value="7 günden uzun" class="form-check-input @error('kanama_sure_7_uzun') is-invalid @enderror" @checked(old('kanama_sure_7_uzun'))>
                <label class="form-check-label" for="kanama_uzun">7 günden uzun</label>
            </div>
        </div>

        <div class="mt-3">
            <label>Menstrüel Sikluslar Düzenli Mi?</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="siklus_duzenli" id="siklus_evet" value="Evet" class="form-check-input @error('siklus_duzenli') is-invalid @enderror" @checked(old('siklus_duzenli') === 'Evet')>
                <label class="form-check-label" for="siklus_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="siklus_duzenli" id="siklus_hayir" value="Hayır" class="form-check-input @error('siklus_duzenli') is-invalid @enderror" @checked(old('siklus_duzenli') === 'Hayır')>
                <label class="form-check-label" for="siklus_hayir">Hayır</label>
            </div>
            @error('siklus_duzenli')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mt-3">
            <label for="gunde_kac_ped" class="form-label">Adet döneminde günde kaç ped kullanıyordunuz?</label>
            <input type="number" name="gunde_kac_ped" id="gunde_kac_ped" class="form-control @error('gunde_kac_ped') is-invalid @enderror" value="{{ old('gunde_kac_ped') }}" min="0" placeholder="Örn: 4">
            @error('gunde_kac_ped')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
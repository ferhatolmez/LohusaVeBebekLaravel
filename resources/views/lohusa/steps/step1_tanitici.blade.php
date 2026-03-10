        <div class="form-section card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">A.1 Lohusanın Tanıtıcı Bilgileri</div>
            <div class="card-body">
                <p class="text-muted small mb-4">Bu bölümde lohusanın temel kimlik ve iletişim bilgileri yer alır.</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="ad_soyad" class="form-label">Ad Soyad <span class="text-danger">*</span></label>
                        <input type="text"
                            name="ad_soyad"
                            id="ad_soyad"
                            class="form-control form-control-lg only-letters"
                            value="{{ old('ad_soyad') }}"
                            placeholder="Ad ve soyadı yazınız"
                            required>
                        <div class="invalid-feedback d-none" id="ad_soyad_error">
                            Sadece harf ve boşluk girilmelidir.
                        </div>
                        @error('ad_soyad')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="yas" class="form-label">Yaş <span class="text-danger">*</span></label>
                        <input type="text" name="yas" id="yas" class="form-control form-control-lg only-numbers" placeholder="Örn: 28" value="{{ old('yas') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="egitim_durumu" class="form-label">Eğitim Durumu</label>
                        <select name="egitim_durumu" id="egitim_durumu" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            <option value="Okuryazar Değil">Okuryazar Değil</option>
                            <option value="İlkokul">İlkokul</option>
                            <option value="Ortaokul">Ortaokul</option>
                            <option value="Lise">Lise</option>
                            <option value="Üniversite">Üniversite</option>
                            <option value="Yüksek Lisans/Doktora">Yüksek Lisans/Doktora</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="meslek" class="form-label">Meslek</label>
                        <input type="text" name="meslek" id="meslek" class="form-control form-control-lg only-letters" value="{{ old('meslek') }}" placeholder="Örn: Ev hanımı">
                    </div>
                    <div class="col-md-6">
                        <label for="saglik_guvence" class="form-label">Sağlık Güvence Durumu</label>
                        <select name="saglik_guvence" id="saglik_guvence" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            <option value="SGK">SGK</option>
                            <option value="Bağ-Kur">Bağ-Kur</option>
                            <option value="Özel Sigorta">Özel Sigorta</option>
                            <option value="Yok">Yok</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="akraba_evliligi" class="form-label">Akraba Evliliği</label>
                        <select name="akraba_evliligi" id="akraba_evliligi" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            <option value="Evet">Evet</option>
                            <option value="Hayır">Hayır</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="evlilik_yili" class="form-label">Evlilik Yılı</label>
                        <input type="number" name="evlilik_yili" id="evlilik_yili" class="form-control form-control-lg" value="{{ old('evlilik_yili') }}" min="1900" max="{{ date('Y') }}" placeholder="Örn: 2020">
                    </div>
                    <div class="col-md-6">
                        <label for="kan_grubu" class="form-label">Kan Grubu</label>
                        <select name="kan_grubu" id="kan_grubu" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            <option value="A Rh+">A Rh+</option>
                            <option value="A Rh-">A Rh-</option>
                            <option value="B Rh+">B Rh+</option>
                            <option value="B Rh-">B Rh-</option>
                            <option value="AB Rh+">AB Rh+</option>
                            <option value="AB Rh-">AB Rh-</option>
                            <option value="0 Rh+">0 Rh+</option>
                            <option value="0 Rh-">0 Rh-</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="gebelik_planlandimi" class="form-label">Gebelik Planlandı mı?</label>
                        <select name="gebelik_planlandimi" id="gebelik_planlandimi" class="form-select form-select-lg">
                            <option value="">Seçiniz</option>
                            <option value="Evet">Evet</option>
                            <option value="Hayır">Hayır</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="dogum_yeri" class="form-label">Doğum Yeri</label>
                        <input type="text" name="dogum_yeri" id="dogum_yeri" class="form-control form-control-lg only-letters" value="{{ old('dogum_yeri') }}" placeholder="Örn: İstanbul">
                    </div>
                </div>
            </div>
        </div>
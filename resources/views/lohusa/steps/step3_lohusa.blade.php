<div class="form-section fade-in p-3 rounded card shadow-sm mb-4">
    <div class="card-header bg-danger text-white">B. Ailenin Sağlıkla İlgili Tutum ve Deneyimleri</div>
    <div class="card-body">
        @php
            $familyCurrentDiseaseOptions = \App\Support\MedicalFormOptions::familyCurrentDiseaseOptions();
            $midwifeExpectationOptions = \App\Support\MedicalFormOptions::midwifeExpectationOptions();
            $socioeconomicStatusOptions = \App\Support\MedicalFormOptions::socioeconomicStatusOptions();
            $familyDecisionMakerOptions = \App\Support\MedicalFormOptions::familyDecisionMakerOptions();
            $expressionLevelOptions = \App\Support\MedicalFormOptions::expressionLevelOptions();
            $childImportanceOptions = \App\Support\MedicalFormOptions::childImportanceOptions();
            $adequacyLevelOptions = \App\Support\MedicalFormOptions::adequacyLevelOptions();
            $cleanlinessLevelOptions = \App\Support\MedicalFormOptions::cleanlinessLevelOptions();
            $caregiverAvailabilityOptions = \App\Support\MedicalFormOptions::caregiverAvailabilityOptions();
            $cookingImpactOptions = \App\Support\MedicalFormOptions::cookingImpactOptions();
            $storageConditionOptions = \App\Support\MedicalFormOptions::storageConditionOptions();
            $homeTypeOptions = \App\Support\MedicalFormOptions::homeTypeOptions();
        @endphp

        <div class="mb-3">
            <label for="ailenin_hastalik_durumu">1. Aile üyelerinden birinin geçirdiği hastalık, operasyon, hastane deneyimi, ölüm, boşanma, işsizlik olmuş mu? Bu kriz durumlarını nasıl geçirmişler?</label>
            <textarea name="ailenin_hastalik_durumu" id="ailenin_hastalik_durumu" class="form-control @error('ailenin_hastalik_durumu') is-invalid @enderror" rows="4">{{ old('ailenin_hastalik_durumu') }}</textarea>
            @error('ailenin_hastalik_durumu')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>2. Aile sağlıklı iken kontrollerin önemini biliyor mu?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('kontrollerin_onemi_biliniyor') is-invalid @enderror" type="radio" name="kontrollerin_onemi_biliniyor" id="kontrollerin_onemi_evet" value="Evet" @checked(old('kontrollerin_onemi_biliniyor') === 'Evet')>
                <label class="form-check-label" for="kontrollerin_onemi_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('kontrollerin_onemi_biliniyor') is-invalid @enderror" type="radio" name="kontrollerin_onemi_biliniyor" id="kontrollerin_onemi_hayir" value="Hayır" @checked(old('kontrollerin_onemi_biliniyor') === 'Hayır')>
                <label class="form-check-label" for="kontrollerin_onemi_hayir">Hayır</label>
            </div>
            @error('kontrollerin_onemi_biliniyor')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="aile_mevcut_hastaliklar">3. Aile bireylerinde mevcut hastalık / alerjiler / genetik bozukluklar var mı?</label>
            <select name="aile_mevcut_hastaliklar" id="aile_mevcut_hastaliklar" class="form-select @error('aile_mevcut_hastaliklar') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($familyCurrentDiseaseOptions as $option)
                    <option value="{{ $option }}" @selected(old('aile_mevcut_hastaliklar') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('aile_mevcut_hastaliklar')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="aile_ebeden_beklentiler">4. Ailenin ebeden beklentileri neler?</label>
            <select name="aile_ebeden_beklentiler" id="aile_ebeden_beklentiler" class="form-select @error('aile_ebeden_beklentiler') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($midwifeExpectationOptions as $option)
                    <option value="{{ $option }}" @selected(old('aile_ebeden_beklentiler') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('aile_ebeden_beklentiler')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>5. Ücretsiz sağlık hizmetleri hakkında bilgisi var mı?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('ucretsiz_saglik_bilgisi') is-invalid @enderror" type="radio" name="ucretsiz_saglik_bilgisi" id="ucretsiz_saglik_evet" value="Evet" @checked(old('ucretsiz_saglik_bilgisi') === 'Evet')>
                <label class="form-check-label" for="ucretsiz_saglik_evet">Evet</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input @error('ucretsiz_saglik_bilgisi') is-invalid @enderror" type="radio" name="ucretsiz_saglik_bilgisi" id="ucretsiz_saglik_hayir" value="Hayır" @checked(old('ucretsiz_saglik_bilgisi') === 'Hayır')>
                <label class="form-check-label" for="ucretsiz_saglik_hayir">Hayır</label>
            </div>
            @error('ucretsiz_saglik_bilgisi')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="sosyoekonomik_durum">6. Ailenin sosyoekonomik durumu nasıl?</label>
            <select name="sosyoekonomik_durum" id="sosyoekonomik_durum" class="form-select @error('sosyoekonomik_durum') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($socioeconomicStatusOptions as $option)
                    <option value="{{ $option }}" @selected(old('sosyoekonomik_durum') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('sosyoekonomik_durum')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="ailede_karar_veren">7. Aile içinde önemli kararlarda kim karar veriyor?</label>
            <select name="ailede_karar_veren" id="ailede_karar_veren" class="form-select @error('ailede_karar_veren') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($familyDecisionMakerOptions as $option)
                    <option value="{{ $option }}" @selected(old('ailede_karar_veren') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('ailede_karar_veren')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="aile_duygu_ortaya_koyma">8. Aile bireyleri duygu ve gereksinimlerini ne derece ortaya koyabiliyorlar?</label>
            <select name="aile_duygu_ortaya_koyma" id="aile_duygu_ortaya_koyma" class="form-select @error('aile_duygu_ortaya_koyma') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($expressionLevelOptions as $option)
                    <option value="{{ $option }}" @selected(old('aile_duygu_ortaya_koyma') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('aile_duygu_ortaya_koyma')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>9. Aile bireyleri sorunlarını paylaşabilecek birini bulabiliyor mu?</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sorun_paylasma[]" value="Eş">
                <label class="form-check-label">Eş</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sorun_paylasma[]" value="Aile">
                <label class="form-check-label">Aile</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sorun_paylasma[]" value="Akraba">
                <label class="form-check-label">Akraba</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sorun_paylasma[]" value="Komşular">
                <label class="form-check-label">Komşular</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="sorun_paylasma[]" value="Arkadaş">
                <label class="form-check-label">Arkadaş</label>
            </div>
        </div>

        <div class="mb-3">
            <label>10. Ailenin çocuğa verdiği önem nasıl?</label>
            <select name="cocuga_verilen_onem" class="form-select @error('cocuga_verilen_onem') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($childImportanceOptions as $option)
                    <option value="{{ $option }}" @selected(old('cocuga_verilen_onem') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="ev_tipi">11. Yaşanılan evin tipi:</label>
            <select name="ev_tipi" id="ev_tipi" class="form-select @error('ev_tipi') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($homeTypeOptions as $option)
                    <option value="{{ $option }}" @selected(old('ev_tipi') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('ev_tipi')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>12. Evdeki oda sayısı ve işlevleri, ısınma, havalandırma yeterli mi?</label>
            <select name="ev_odalar_islev_isi_hava" class="form-select @error('ev_odalar_islev_isi_hava') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($adequacyLevelOptions as $option)
                    <option value="{{ $option }}" @selected(old('ev_odalar_islev_isi_hava') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pencere_aydinlik">13. Pencere sayısı, aydınlanma nasıl?</label>
            <select name="pencere_aydinlik" id="pencere_aydinlik" class="form-select @error('pencere_aydinlik') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($cleanlinessLevelOptions as $option)
                    <option value="{{ $option }}" @selected(old('pencere_aydinlik') === $option)>{{ $option }}</option>
                @endforeach
            </select>
            @error('pencere_aydinlik')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>14. Evde ayrı bir banyo var mı?</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="banyo_var_mi" value="Var" class="form-check-input" id="banyo_var">
                <label class="form-check-label" for="banyo_var">Var</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="banyo_var_mi" value="Yok" class="form-check-input" id="banyo_yok">
                <label class="form-check-label" for="banyo_yok">Yok</label>
            </div>
        </div>

        <div class="mb-3">
            <label>Temizliği, havalandırması nasıl?</label>
            <select name="banyo_temizlik" class="form-select @error('banyo_temizlik') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($cleanlinessLevelOptions as $option)
                    <option value="{{ $option }}" @selected(old('banyo_temizlik') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>15. Tuvalet evin içinde mi, dışında mı?</label><br>
            <div class="form-check form-check-inline">
                <input type="radio" name="tuvalet_konum" value="İçeride" class="form-check-input" id="tuvalet_ic">
                <label class="form-check-label" for="tuvalet_ic">İçeride</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="tuvalet_konum" value="Dışarıda" class="form-check-input" id="tuvalet_dis">
                <label class="form-check-label" for="tuvalet_dis">Dışarıda</label>
            </div>
        </div>

        <div class="mb-3">
            <label>Temizliği, havalandırması nasıl?</label>
            <select name="tuvalet_durumu" class="form-select @error('tuvalet_durumu') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($cleanlinessLevelOptions as $option)
                    <option value="{{ $option }}" @selected(old('tuvalet_durumu') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>16. Evde lohusaya ve bebeğe bakabilecek kişiler var mı?</label>
            <select name="bakim_verenler" class="form-select @error('bakim_verenler') is-invalid @enderror">
                <option value="">Seçiniz</option>
                @foreach ($caregiverAvailabilityOptions as $option)
                    <option value="{{ $option }}" @selected(old('bakim_verenler') === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>17. Yemek pişirme yöntemleri, yiyeceklerin besin değerini etkiliyor mu?</label><br>
            @foreach ($cookingImpactOptions as $option)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yemek_pisirme_besin_degeri" value="{{ $option }}" @checked(old('yemek_pisirme_besin_degeri') === $option)>
                    <label class="form-check-label">{{ $option }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>18. Yiyeceklerin saklanma koşulu sağlığa uygun mu?</label><br>
            @foreach ($storageConditionOptions as $option)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="yiyecek_saklama_kosullari" value="{{ $option }}" @checked(old('yiyecek_saklama_kosullari') === $option)>
                    <label class="form-check-label">{{ $option }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>

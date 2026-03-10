@extends('layouts.app')

@section('content')

<div class="container py-4 form-page-lohusa">
    <div class="form-header mb-4">
        <h1 class="h3 mb-1 fw-600">Lohusa İzlem Formu</h1>
        <p class="text-muted mb-0">Adım adım ilerleyin; verileriniz güvende.</p>
    </div>

    <!-- İlerleme: adım göstergesi + çubuk -->
    <div class="form-progress-wrap mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-muted small">Adım <strong id="currentStepNum">1</strong> / {{ 16 }}</span>
            <span class="text-muted small" id="progressPercent">%0</span>
        </div>
        <div class="progress rounded-pill" style="height: 10px;">
            <div id="formProgress" class="progress-bar bg-teal rounded-pill" role="progressbar" style="width: 0%; transition: width 0.4s ease;"></div>
        </div>
    </div>

    <form id="lohusaForm" action="{{ route('lohusa.store') }}" method="POST">
        @csrf

        <!-- Adımlar -->
        <div id="step-1" class="step step-content">@include('lohusa.steps.step1_tanitici')</div>
        <div id="step-2" class="step step-content d-none">@include('lohusa.steps.step2_dogum')</div>
        <div id="step-3" class="step step-content d-none">@include('lohusa.steps.step3_lohusa')</div>
        <div id="step-4" class="step step-content d-none">@include('lohusa.steps.step4_aile')</div>
        <div id="step-5" class="step step-content d-none">@include('lohusa.steps.step5_menstruel')</div>
        <div id="step-6" class="step step-content d-none">@include('lohusa.steps.step6_gecmis_obstetrik')</div>
        <div id="step-7" class="step step-content d-none">@include('lohusa.steps.step7_postpartum_donem_obstretik')</div>
        <div id="step-8" class="step step-content d-none">@include('lohusa.steps.step8_fiziksel_muayene')</div>
        <div id="step-9" class="step step-content d-none">@include('lohusa.steps.step9_psikolojik_degerlendirme')</div>
        <div id="step-10" class="step step-content d-none">@include('lohusa.steps.step10_anne_bebek')</div>
        <div id="step-11" class="step step-content d-none">@include('lohusa.steps.step11_emzirmenin_degerlendirilmesi')</div>
        <div id="step-12" class="step step-content d-none">@include('lohusa.steps.step12_egitim_istekleri')</div>
        <div id="step-13" class="step step-content d-none">@include('lohusa.steps.step13_ebenin_degerlendirmesi')</div>
        <div id="step-14" class="step step-content d-none">@include('lohusa.steps.step14_bebek_bilgileri')</div>
        <div id="step-15" class="step step-content d-none">@include('lohusa.steps.step15_vital_bulgular')</div>
        <div id="step-16" class="step step-content d-none">@include('lohusa.steps.step16_diger_bilgiler')</div>

        <!-- Butonlar -->
        <div class="form-actions mt-4 pt-4 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <button type="button" class="btn btn-outline-secondary btn-lg px-4" onclick="prevStep()" id="prevBtn">← Geri</button>
            <button type="button" class="btn btn-primary btn-lg px-4" id="nextBtn" onclick="nextStep()">İleri →</button>
            <button type="submit" class="btn btn-success btn-lg px-4 d-none" id="submitBtn">Kaydet</button>
        </div>
    </form>
</div>

<style>
    .form-page-lohusa .form-header { max-width: 600px; }
    .form-page-lohusa .form-progress-wrap { max-width: 600px; }
    .form-page-lohusa .step-content { animation: stepFade 0.3s ease; }
    @keyframes stepFade { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    .form-page-lohusa .form-actions { background: linear-gradient(to top, #f8fafc, transparent); margin: 0 -1rem -1rem; padding: 1.25rem 1rem !important; border-radius: 0 0 8px 8px; }
    .form-page-lohusa .card { border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
    .form-page-lohusa .card-header { padding: 1rem 1.25rem; font-size: 1rem; }
    .form-page-lohusa .card-body { padding: 1.25rem 1.5rem; }
    .form-page-lohusa .form-label { font-weight: 500; color: #475569; margin-bottom: 0.35rem; }
    .form-page-lohusa .form-control, .form-page-lohusa .form-select { border-radius: 8px; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; }
    .form-page-lohusa .form-control:focus, .form-page-lohusa .form-select:focus { border-color: #0d9488; box-shadow: 0 0 0 3px rgba(13,148,136,0.15); }
    .form-page-lohusa .form-check-inline { margin-right: 1rem; margin-bottom: 0.5rem; padding: 0.5rem 0.75rem; border-radius: 8px; transition: background 0.2s; }
    .form-page-lohusa .form-check-inline:hover { background: #f1f5f9; }
    .form-page-lohusa .form-check.bg-checked, .form-page-lohusa .bg-checked { background: rgba(13,148,136,0.12) !important; border-radius: 8px; }
    .bg-teal { background-color: #0d9488; }
</style>

<script>
    let currentStep = 1;
    const totalSteps = 16;

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('lohusaForm');
        const progressBar = document.getElementById('formProgress');
        const input = document.getElementById("ad_soyad");
        const errorMsg = document.getElementById("ad_soyad_error");
        const patterns = {
            "only-letters": /^[\p{L}\s]*$/u,
            "only-numbers": /^[0-9]*$/,
            "no-special": /^[\p{L}\d\s]*$/u
        };
        Object.keys(patterns).forEach(cls => {
            document.querySelectorAll(`.${cls}`).forEach(input => {
                input.addEventListener("input", function () {
                    const value = input.value;
                    const regex = patterns[cls];
                    if (!regex.test(value)) {
                        input.classList.add("is-invalid");
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('invalid-feedback')) {
                            const warning = document.createElement('div');
                            warning.classList.add('invalid-feedback');
                            warning.textContent = cls === 'only-letters' ? "Sadece harf ve boşluk girilmelidir."
                                : cls === 'only-numbers' ? "Sadece rakam girilmelidir." : "Özel karakter kullanılamaz.";
                            input.parentNode.appendChild(warning);
                        }
                        input.nextElementSibling?.classList.remove("d-none");
                    } else {
                        input.classList.remove("is-invalid");
                        input.nextElementSibling?.classList.add("d-none");
                    }
                });
            });
        });
        if (input) {
            input.addEventListener("input", function () {
                const regex = /^[\p{L}\s]*$/u;
                if (!regex.test(this.value)) {
                    input.classList.add("is-invalid");
                    errorMsg.classList.remove("d-none");
                } else {
                    input.classList.remove("is-invalid");
                    errorMsg.classList.add("d-none");
                }
            });
        }

        form.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', function () {
                const parent = this.closest('.form-check');
                if (parent) {
                    parent.classList.toggle('bg-checked', this.checked);
                }
            });
        });

        form.addEventListener('input', calculateProgress);
        form.addEventListener('change', calculateProgress);

        setTimeout(() => calculateProgress(), 100);
        showStep(currentStep);

        // Session ve CSRF: 5 dakikada bir token yenile (419 önlemi)
        setInterval(function () {
            fetch('{{ route("lohusa.csrf-refresh") }}', { credentials: 'same-origin' })
                .then(r => r.json())
                .then(data => {
                    const inp = document.querySelector('#lohusaForm input[name="_token"]');
                    if (inp && data.token) { inp.value = data.token; }
                })
                .catch(() => {});
        }, 5 * 60 * 1000);

        // Göndermeden hemen önce token güncelle
        form.addEventListener('submit', function (e) {
            fetch('{{ route("lohusa.csrf-refresh") }}', { credentials: 'same-origin' })
                .then(r => r.json())
                .then(data => {
                    const inp = document.querySelector('#lohusaForm input[name="_token"]');
                    if (inp && data.token) inp.value = data.token;
                    form.submit();
                })
                .catch(() => form.submit());
            e.preventDefault();
        });
    });

    function calculateProgress() {
        const form = document.getElementById('lohusaForm');
        const progressBar = document.getElementById('formProgress');
        const inputs = Array.from(form.querySelectorAll('input, select, textarea')).filter(el => el.type !== 'hidden');
        let filled = 0;
        const checkboxGroupMap = {};

        inputs.forEach(el => {
            if (el.type === 'checkbox') {
                const name = el.name.replace(/\[\]$/, '');
                checkboxGroupMap[name] = checkboxGroupMap[name] || [];
                checkboxGroupMap[name].push(el);
            } else if (el.value.trim() !== '') {
                filled++;
            }
        });

        Object.values(checkboxGroupMap).forEach(group => {
            if (group.some(chk => chk.checked)) filled++;
        });

        const normalFields = inputs.filter(el => el.type !== 'checkbox').length;
        const total = normalFields + Object.keys(checkboxGroupMap).length;
        const percent = total === 0 ? 0 : Math.round((filled / total) * 100);

        progressBar.style.width = percent + '%';
        const percentEl = document.getElementById('progressPercent');
        if (percentEl) percentEl.textContent = '%' + percent;

        progressBar.classList.remove('bg-danger', 'bg-warning', 'bg-success');
        progressBar.classList.add('bg-teal');
    }

    function showStep(step) {
        currentStep = step;
        document.querySelectorAll('.step').forEach(el => el.classList.add('d-none'));
        const current = document.getElementById(`step-${step}`);
        if (current) current.classList.remove('d-none');

        const stepNumEl = document.getElementById('currentStepNum');
        if (stepNumEl) stepNumEl.textContent = step;

        const submitBtn = document.getElementById('submitBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        if (submitBtn) submitBtn.classList.toggle('d-none', step !== totalSteps);
        if (prevBtn) prevBtn.classList.toggle('d-none', step === 1);
        if (nextBtn) nextBtn.classList.toggle('d-none', step === totalSteps);
    }


    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    }


</script>
@endsection









@extends('layouts.app')

@section('title', 'Lohusa İzlem Formu')

@section('content')
@php
    $steps = [
        1 => 'Temel bilgi',
        2 => 'Es ve dogum',
        3 => 'Lohusa durum',
        4 => 'Aile ve sosyal',
        5 => 'Menstruel',
        6 => 'Obstetrik gecmis',
        7 => 'Postpartum',
        8 => 'Fiziksel muayene',
        9 => 'Psikolojik',
        10 => 'Anne-bebek',
        11 => 'Emzirme',
        12 => 'Egitim ihtiyaci',
        13 => 'Ebe yorumu',
        14 => 'Bebek bilgileri',
        15 => 'Vital bulgular',
        16 => 'Diger bilgiler',
    ];
@endphp
<div class="container">
    <section class="d-flex flex-column flex-xl-row justify-content-between gap-4 mb-4">
        <div>
            <span class="badge-soft mb-2">Çok adımlı form</span>
            <h1 class="h2 mb-1">Lohusa İzlem Formu</h1>
            <p class="text-secondary mb-0">Artık zorunlu alanlar, veri tipi kontrolleri, adım bazlı ilerleme ve tarayıcı taslağı ile çalışır.</p>
        </div>
        <div class="glass-panel p-3 p-lg-4" style="max-width: 420px;">
            <div class="d-flex justify-content-between small text-secondary mb-2">
                <span>Adım <strong id="currentStepNum">1</strong> / {{ count($steps) }}</span>
                <span id="progressPercent">%0</span>
            </div>
            <div class="progress mb-3" style="height: 10px;">
                <div id="formProgress" class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                @foreach ($steps as $number => $label)
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 step-chip" data-step-target="{{ $number }}">{{ $number }}. {{ $label }}</button>
                @endforeach
            </div>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger glass-panel border-0 mb-4">
            <div class="fw-bold mb-2">Form kaydedilemedi.</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="draftNotice" class="alert alert-info glass-panel border-0 mb-4 d-none">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
            <div>
                <strong>Taslak geri yüklendi.</strong>
                <span class="small d-block text-secondary" id="draftTimestamp"></span>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary" id="clearDraftBtn">Taslağı temizle</button>
        </div>
    </div>

    <form id="lohusaForm" action="{{ route('lohusa.store') }}" method="POST" novalidate>
        @csrf

        <div id="step-1" class="step">@include('lohusa.steps.step1_tanitici')</div>
        <div id="step-2" class="step d-none">@include('lohusa.steps.step2_dogum')</div>
        <div id="step-3" class="step d-none">@include('lohusa.steps.step3_lohusa')</div>
        <div id="step-4" class="step d-none">@include('lohusa.steps.step4_aile')</div>
        <div id="step-5" class="step d-none">@include('lohusa.steps.step5_menstruel')</div>
        <div id="step-6" class="step d-none">@include('lohusa.steps.step6_gecmis_obstetrik')</div>
        <div id="step-7" class="step d-none">@include('lohusa.steps.step7_postpartum_donem_obstretik')</div>
        <div id="step-8" class="step d-none">@include('lohusa.steps.step8_fiziksel_muayene')</div>
        <div id="step-9" class="step d-none">@include('lohusa.steps.step9_psikolojik_degerlendirme')</div>
        <div id="step-10" class="step d-none">@include('lohusa.steps.step10_anne_bebek')</div>
        <div id="step-11" class="step d-none">@include('lohusa.steps.step11_emzirmenin_degerlendirilmesi')</div>
        <div id="step-12" class="step d-none">@include('lohusa.steps.step12_egitim_istekleri')</div>
        <div id="step-13" class="step d-none">@include('lohusa.steps.step13_ebenin_degerlendirmesi')</div>
        <div id="step-14" class="step d-none">@include('lohusa.steps.step14_bebek_bilgileri')</div>
        <div id="step-15" class="step d-none">@include('lohusa.steps.step15_vital_bulgular')</div>
        <div id="step-16" class="step d-none">@include('lohusa.steps.step16_diger_bilgiler')</div>

        <div class="glass-panel p-3 p-lg-4 mt-4 d-flex flex-column flex-md-row justify-content-between gap-3 align-items-md-center">
            <div class="text-secondary">Zorunlu alanlar tamamlanmadan bir sonraki adıma geçilemez. Form girişi otomatik olarak tarayıcı taslağı olarak saklanır.</div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-primary" id="prevBtn">Geri</button>
                <button type="button" class="btn btn-outline-primary" id="nextBtn">İleri</button>
                <button type="submit" class="btn btn-primary d-none" id="submitBtn">Kaydı oluştur</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .step {
        animation: fadeUp 0.25s ease;
    }

    .step-chip.active {
        background: var(--brand-700);
        color: #fff;
        border-color: var(--brand-700);
    }

    .form-section .card-header {
        font-size: 1rem;
    }

    .form-check-inline,
    .form-check {
        border-radius: 14px;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
    let currentStep = 1;
    const totalSteps = {{ count($steps) }};
    const errorFields = @json($errors->keys());

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('lohusaForm');
        const progressBar = document.getElementById('formProgress');
        const stepButtons = document.querySelectorAll('.step-chip');
        const draftNotice = document.getElementById('draftNotice');
        const draftTimestamp = document.getElementById('draftTimestamp');
        const clearDraftBtn = document.getElementById('clearDraftBtn');
        const draftKey = 'lohusa-form-draft-v1';
        const patterns = {
            'only-letters': /^[\p{L}\s'.-]*$/u,
            'only-numbers': /^[0-9]*$/,
            'no-special': /^[\p{L}\d\s.-]*$/u,
        };

        Object.keys(patterns).forEach(function (cls) {
            document.querySelectorAll('.' + cls).forEach(function (input) {
                input.addEventListener('input', function () {
                    const valid = patterns[cls].test(input.value);
                    input.classList.toggle('is-invalid', !valid && input.value !== '');
                });
            });
        });

        restoreDraft();

        document.getElementById('nextBtn').addEventListener('click', function () {
            if (validateCurrentStep() && currentStep < totalSteps) {
                showStep(currentStep + 1);
            }
        });

        document.getElementById('prevBtn').addEventListener('click', function () {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });

        stepButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const targetStep = Number(button.dataset.stepTarget);
                if (targetStep < currentStep || validateCurrentStep()) {
                    showStep(targetStep);
                }
            });
        });

        form.addEventListener('input', function () {
            calculateProgress();
            persistDraft();
        });

        form.addEventListener('change', function () {
            calculateProgress();
            persistDraft();
        });

        form.addEventListener('submit', function () {
            localStorage.removeItem(draftKey);
        });

        clearDraftBtn.addEventListener('click', function () {
            localStorage.removeItem(draftKey);
            draftNotice.classList.add('d-none');
        });

        if (errorFields.length > 0) {
            const firstField = document.querySelector('[name="' + errorFields[0] + '"]');
            const firstStep = firstField ? Number(firstField.closest('.step')?.id.replace('step-', '')) || 1 : 1;
            showStep(firstStep);
        } else {
            showStep(1);
        }

        calculateProgress();

        setInterval(function () {
            fetch('{{ route('lohusa.csrf-refresh') }}', { credentials: 'same-origin' })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    const tokenInput = form.querySelector('input[name="_token"]');
                    if (tokenInput && data.token) {
                        tokenInput.value = data.token;
                    }
                })
                .catch(function () {});
        }, 5 * 60 * 1000);

        function validateCurrentStep() {
            const step = document.getElementById('step-' + currentStep);
            let valid = true;

            step.querySelectorAll('input, select, textarea').forEach(function (field) {
                if (field.type === 'hidden' || field.disabled) {
                    return;
                }

                if (field.hasAttribute('required') && !field.value) {
                    field.classList.add('is-invalid');
                    valid = false;
                }

                if (field.classList.contains('only-numbers') && field.value && !/^[0-9]+$/.test(field.value)) {
                    field.classList.add('is-invalid');
                    valid = false;
                }
            });

            return valid;
        }

        function calculateProgress() {
            const fields = Array.from(form.querySelectorAll('input, select, textarea')).filter(function (el) {
                return el.type !== 'hidden';
            });
            let filled = 0;
            const checkboxGroups = {};

            fields.forEach(function (field) {
                if (field.type === 'checkbox') {
                    checkboxGroups[field.name] = checkboxGroups[field.name] || [];
                    checkboxGroups[field.name].push(field);
                } else if ((field.type === 'radio' && field.checked) || (field.type !== 'radio' && String(field.value).trim() !== '')) {
                    filled += 1;
                }
            });

            Object.values(checkboxGroups).forEach(function (group) {
                if (group.some(function (item) { return item.checked; })) {
                    filled += 1;
                }
            });

            const radios = new Set(fields.filter(function (field) { return field.type === 'radio'; }).map(function (field) { return field.name; }));
            const total = fields.filter(function (field) { return field.type !== 'checkbox' && field.type !== 'radio'; }).length + Object.keys(checkboxGroups).length + radios.size;
            const percent = total === 0 ? 0 : Math.round((filled / total) * 100);
            progressBar.style.width = percent + '%';
            document.getElementById('progressPercent').textContent = '%' + percent;
        }

        function showStep(stepNumber) {
            currentStep = stepNumber;
            document.querySelectorAll('.step').forEach(function (step) {
                step.classList.add('d-none');
            });

            document.getElementById('step-' + stepNumber).classList.remove('d-none');
            document.getElementById('currentStepNum').textContent = stepNumber;
            document.getElementById('prevBtn').classList.toggle('d-none', stepNumber === 1);
            document.getElementById('nextBtn').classList.toggle('d-none', stepNumber === totalSteps);
            document.getElementById('submitBtn').classList.toggle('d-none', stepNumber !== totalSteps);

            stepButtons.forEach(function (button) {
                button.classList.toggle('active', Number(button.dataset.stepTarget) === stepNumber);
            });
        }

        function persistDraft() {
            const payload = {
                savedAt: new Date().toISOString(),
                values: {},
            };

            form.querySelectorAll('input, select, textarea').forEach(function (field) {
                if (!field.name || field.type === 'hidden' || field.name === '_token') {
                    return;
                }

                if (field.type === 'checkbox') {
                    payload.values[field.name] = payload.values[field.name] || [];
                    if (field.checked) {
                        payload.values[field.name].push(field.value);
                    }
                    return;
                }

                if (field.type === 'radio') {
                    if (field.checked) {
                        payload.values[field.name] = field.value;
                    }
                    return;
                }

                payload.values[field.name] = field.value;
            });

            localStorage.setItem(draftKey, JSON.stringify(payload));
        }

        function restoreDraft() {
            if (errorFields.length > 0) {
                return;
            }

            const raw = localStorage.getItem(draftKey);
            if (!raw) {
                return;
            }

            try {
                const draft = JSON.parse(raw);

                Object.entries(draft.values || {}).forEach(function (entry) {
                    const name = entry[0];
                    const value = entry[1];
                    const fields = form.querySelectorAll('[name="' + CSS.escape(name) + '"]');

                    fields.forEach(function (field) {
                        if (field.type === 'checkbox') {
                            field.checked = Array.isArray(value) && value.includes(field.value);
                        } else if (field.type === 'radio') {
                            field.checked = value === field.value;
                        } else {
                            field.value = value;
                        }
                    });
                });

                if (draft.savedAt) {
                    draftNotice.classList.remove('d-none');
                    draftTimestamp.textContent = 'Son taslak: ' + new Date(draft.savedAt).toLocaleString('tr-TR');
                }
            } catch (error) {
                localStorage.removeItem(draftKey);
            }
        }
    });
</script>
@endpush



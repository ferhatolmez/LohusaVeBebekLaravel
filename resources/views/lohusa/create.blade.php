@extends('layouts.app')

@section('title', 'Lohusa Izlem Formu')

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
            <span class="badge-soft mb-2">Multi-step workflow</span>
            <h1 class="h2 mb-1">Lohusa Izlem Formu</h1>
            <p class="text-secondary mb-0">Artik zorunlu alanlar, veri tipi kontrolleri ve adim bazli ilerleme dogrulamasi ile calisir.</p>
        </div>
        <div class="glass-panel p-3 p-lg-4" style="max-width: 420px;">
            <div class="d-flex justify-content-between small text-secondary mb-2">
                <span>Adim <strong id="currentStepNum">1</strong> / {{ count($steps) }}</span>
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
            <div class="text-secondary">Zorunlu alanlar tamamlanmadan bir sonraki adima gecilemez.</div>
            <div class="d-flex flex-wrap gap-2">
                <button type="button" class="btn btn-outline-primary" id="prevBtn">Geri</button>
                <button type="button" class="btn btn-outline-primary" id="nextBtn">Ileri</button>
                <button type="submit" class="btn btn-primary d-none" id="submitBtn">Kaydi olustur</button>
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

        form.addEventListener('input', calculateProgress);
        form.addEventListener('change', calculateProgress);

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
                } else if (String(field.value).trim() !== '') {
                    filled += 1;
                }
            });

            Object.values(checkboxGroups).forEach(function (group) {
                if (group.some(function (item) { return item.checked; })) {
                    filled += 1;
                }
            });

            const total = fields.filter(function (field) { return field.type !== 'checkbox'; }).length + Object.keys(checkboxGroups).length;
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
    });
</script>
@endpush

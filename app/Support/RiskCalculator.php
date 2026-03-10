<?php

namespace App\Support;

use App\Models\LohusaForm;

class RiskCalculator
{
    /**
     * Calculates a clinical risk score based on Lohusa form data.
     * Higher score means higher risk.
     * Minimum: 0, Maximum: loosely scoped, typically < 100.
     */
    public static function calculateForLohusa(LohusaForm $form): int
    {
        $score = 0;

        // 1. Vital Signs
        if (isset($form->ates) && (float) $form->ates >= 38.0) {
            $score += 25; // Fever is a significant risk factor postpartum
        }
        
        if (isset($form->tansiyon)) {
            $systolic = (int) explode('/', $form->tansiyon)[0];
            if ($systolic >= 140) {
                $score += 20; // Hypertension
            }
        }

        // 2. Laboratory
        if (isset($form->hemoglobin)) {
            $hb = (float) $form->hemoglobin;
            if ($hb < 10.0) {
                $score += 15; // Anemia
            } elseif ($hb < 11.0) {
                $score += 5;
            }
        }

        // 3. Clinical Findings (Lochia, Abdomen, Perineum)
        $problematicFindings = ['kötü kokulu', 'pürülan', 'aşırı kanama', 'hassasiyet', 'kızarıklık'];
        
        if (isset($form->losia_bulgulari)) {
            foreach ($form->losia_bulgulari as $finding) {
                if (in_array(strtolower($finding), $problematicFindings)) {
                    $score += 10;
                }
            }
        }

        if (isset($form->abdomen_bulgulari)) {
            foreach ($form->abdomen_bulgulari as $finding) {
                if (in_array(strtolower($finding), $problematicFindings)) {
                    $score += 10;
                }
            }
        }

        // 4. Psychological / Emotional
        if (isset($form->psikolojik_belirtiler)) {
            $psychSigns = array_map('strtolower', $form->psikolojik_belirtiler);
            if (in_array('ağlama nöbetleri', $psychSigns) || in_array('depresif duygu durum', $psychSigns)) {
                $score += 15; // PPD risk
            }
        }

        // 5. Breastfeeding / Feeding
        if ($form->bebek_beslenmesi === 'formül mama' || $form->bebek_beslenmesi === 'inek sütü') {
            $score += 5; // Slight risk adjustment for formula/cow's milk
        }

        return $score;
    }

    /**
     * Categorizes the score into a risk level.
     */
    public static function getRiskLevel(int $score): string
    {
        if ($score >= 30) {
            return 'Yüksek Risk';
        }
        
        if ($score >= 15) {
            return 'Orta Risk';
        }

        return 'Düşük Risk';
    }

    /**
     * Returns a badge classification for the UI.
     */
    public static function getRiskBadge(int $score): string
    {
        if ($score >= 30) {
            return 'danger';
        }
        
        if ($score >= 15) {
            return 'warning';
        }

        return 'success';
    }
}

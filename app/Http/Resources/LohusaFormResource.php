<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LohusaFormResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ad_soyad' => $this->ad_soyad,
            'yas' => $this->yas,
            'meslek' => $this->meslek,
            'dogum_yeri' => $this->dogum_yeri,
            'bebek_beslenmesi' => $this->bebek_beslenmesi,
            'postpartum_gun' => $this->postpartum_gun,
            'postpartum_hafta' => $this->postpartum_hafta,
            'dogum_tarihi' => optional($this->dogum_tarihi)->toDateString(),
            'muayene_tarihi' => optional($this->muayene_tarihi)->toDateString(),
            'completion_score' => $this->completion_score,
            'suggested_follow_up_date' => optional($this->suggested_follow_up_date)->toDateString(),
            'suggested_follow_up_label' => $this->suggested_follow_up_label,
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}

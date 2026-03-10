<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BebekFormResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'dogum_tarihi' => optional($this->dogum_tarihi)->toDateString(),
            'muayene_tarihi' => optional($this->muayene_tarihi)->toDateString(),
            'izlem_sayisi' => $this->izlem_sayisi,
            'termin_durumu' => $this->termin_durumu,
            'cinsiyet' => $this->cinsiyet,
            'kan_grubu' => $this->kan_grubu,
            'completion_score' => $this->completion_score,
            'suggested_follow_up_date' => optional($this->suggested_follow_up_date)->toDateString(),
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}

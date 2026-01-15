<?php

namespace App\Notifications;

use App\Models\LandAssessment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AssessmentResultReady extends Notification
{
    use Queueable;

    public $assessment;

    public function __construct(LandAssessment $assessment)
    {
        $this->assessment = $assessment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $gardenName = $this->assessment->garden->name ?? 'Kebun Anda';

        return [
            'title' => 'Hasil Analisa Siap',
            'message' => "Hasil assessment/monitoring untuk {$gardenName} telah keluar. Cek rekomendasi terbaru kami.",
            'type' => 'schedule',
            'assessment_id' => $this->assessment->id,
        ];
    }
}
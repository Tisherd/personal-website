<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;

use Carbon\Carbon;

class WorkExperience extends Model
{
    public $timestamps = false;

    protected $table = 'work_experiences';

    protected $fillable = [
        'company_name',
        'position',
        'start_date',
        'end_date',
        'technology_stack',
        'desc',
    ];

    protected $casts = [
        'technology_stack' => 'array',
    ];

    protected $appends = ['formatted_date_range', 'period_in_month'];

    /**
     * Counts the active months.
     */
    public static function calculateActiveMonths(Collection $workExperiences): int
    {
        $activeMonths = collect();

        foreach ($workExperiences as $experience) {
            $start = Carbon::parse($experience['start_date']);
            $end = Carbon::parse($experience['end_date'] ?? Carbon::today());

            $start->startOfMonth();
            $end->endOfMonth();

            while ($start <= $end) {
                $activeMonths->push($start->format('Y-m'));
                $start->addMonth();
            }
        }

        return $activeMonths->unique()->count();
    }

    protected function formattedDateRange(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_date
                ? $this->formatDateRange($this->start_date, $this->end_date)
                : null
        );
    }

    protected function periodInMonth(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_date
                ? $this->calculatePeriodInMonth($this->start_date, $this->end_date)
                : null
        );
    }

    private function formatDateRange(?string $start, ?string $end): string
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $start)->locale('ru')->translatedFormat('F Y');
        $endDate = $end
            ? Carbon::createFromFormat('Y-m-d', $end)->locale('ru')->translatedFormat('F Y')
            : 'по настоящее время';

        return "{$startDate} - {$endDate}";
    }

    private function calculatePeriodInMonth(?string $start, ?string $end): int
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $start);
        $endDate = $end
            ? Carbon::createFromFormat('Y-m-d', $end)
            : Carbon::now();

        return (int)ceil($startDate->diffInMonths($endDate));
    }
}

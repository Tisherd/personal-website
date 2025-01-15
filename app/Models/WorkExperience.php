<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    /**
     * Добавляет аттрибут period для каждого элемента коллекции от WorkExperience
     */
    public static function withPeriodAttribute(Collection $workExperiences): Collection
    {
        $workExperiences = $workExperiences->map(function ($item) {
            $startDate = Carbon::parse($item->start_date);
            $endDate = Carbon::parse($item->end_date) ?? Carbon::today();
            $item['period_in_month'] = (int)ceil($startDate->diffInMonths($endDate));
            return $item;
        });

        return $workExperiences;
    }

    /**
     * Рассчитывает общий период для записей.
     */
    public static function calculateTotalPeriod(Collection|null $workExperiences = null): int
    {
        $workExperiences ??= self::all();

        $minStartDate = $workExperiences->min('start_date');
        $maxEndDate = $workExperiences->max(function ($experience) {
            return $experience->end_date ?? Carbon::today();
        });

        if ($minStartDate && $maxEndDate) {
            return Carbon::parse($minStartDate)->diffInMonths(Carbon::parse($maxEndDate));
        }

        return 0;
    }
}

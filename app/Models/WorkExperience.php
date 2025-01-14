<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;

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

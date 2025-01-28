<?php

namespace Tests\Unit\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use PHPUnit\Framework\Attributes\Test;

use App\Models\AboutMe;
use Tests\TestCase;

class AboutMeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    #[Test]
    public function it_clears_cache_on_update()
    {
        Cache::shouldReceive('forget')
            ->once()
            ->with(AboutMe::CACHE_KEY);

        $aboutMe = AboutMe::factory()->create();
        $aboutMe->update(['full_name' => 'Updated Name']);
    }

    #[Test]
    public function it_returns_correct_photo_url()
    {
        $photoPath = 'photos/test.jpg';
        Storage::disk('public')->put($photoPath, 'fake-content');

        $aboutMe = AboutMe::factory()->make(['photo_path' => $photoPath]);

        $this->assertEquals(asset("storage/$photoPath"), $aboutMe->photo_url);
    }

    #[Test]
    public function it_returns_null_photo_url_when_no_photo_path()
    {
        $aboutMe = AboutMe::factory()->make(['photo_path' => null]);

        $this->assertNull($aboutMe->photo_url);
    }

    #[Test]
    public function it_formats_birth_date_correctly()
    {
        $birthDate = '1990-01-01';
        $aboutMe = AboutMe::factory()->make(['birth_date' => $birthDate]);

        Carbon::setLocale('ru');
        $expected = Carbon::createFromFormat('Y-m-d', $birthDate)
            ->translatedFormat('d F Y г.');

        $this->assertEquals($expected, $aboutMe->birthdate_formatted);
    }

    #[Test]
    public function it_returns_null_formatted_birth_date_when_no_date()
    {
        $aboutMe = AboutMe::factory()->make(['birth_date' => null]);

        $this->assertNull($aboutMe->birthdate_formatted);
    }

    #[Test]
    public function it_calculates_full_age_correctly()
    {
        $birthDate = Carbon::now()->subYears(30)->format('Y-m-d');
        $aboutMe = AboutMe::factory()->make(['birth_date' => $birthDate]);

        $this->assertEquals(30, $aboutMe->full_age);
    }

    #[Test]
    public function it_returns_null_full_age_when_no_birth_date()
    {
        $aboutMe = AboutMe::factory()->make(['birth_date' => null]);

        $this->assertNull($aboutMe->full_age);
    }
}

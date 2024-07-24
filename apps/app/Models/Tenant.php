<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;

class Tenant extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'short_name',
        'website',
        'address',
        'postal_code',
        'province_id',
        'regency_id',
        'district_id',
        'question_set_id', // current active question set
        'slug',
        'token',
        'logo_path',
        'latitude',
        'longitude',
        'description',
        'submitted_at',
    ];

    protected array $qrCodeSizes = [
        'xl' => 720,
        'l' => 480,
        'm' => 240,
        's' => 120,
    ];

    public function getQRCodeSizes(): array
    {
        return $this->qrCodeSizes;
    }

    public function getQRCodeSize(string $name): int
    {
        return $this->qrCodeSizes[$name] ?? 0;
    }

    /**
     * Generating a random token for this model instance.
     *
     * @return self
     */
    public function generateToken(): self
    {
        $token = '';

        do {
            $token = str_pad(rand(0, 999999), 6, 0);
        } while (static::where('token', $token)->exists());

        $this->token = $token;

        return $this;
    }

    /**
     * Retrieving the path to the Tenant's QRCode.
     *
     * @return string path
     */
    public function getQRCodePath(string $size = 'm'): string
    {
        $path = "/qrcode/{$this->token}-{$size}.jpg";

        if (!Storage::disk('public')->exists($path)) {
            return null;
        }

        return $path;
    }

    /**
     * Retrieving a URL pointing to the Tenant's QRCode.
     *
     * @return string url
     */
    public function getQRCodeUrl(string $size = 'm'): string
    {
        $path = $this->getQRCodePath($size);

        if (!$path) {
            return '#';
        }

        return Storage::disk('public')
            ->url($path);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Retrieving the file path to the Tenant's QRCode.
     *
     * @return string|null path
     */
    public function getQRCodeFilePath(string $size = 'm'): string|null
    {
        $path = $this->getQRCodePath($size);

        if (!$path) {
            return null;
        }

        return Storage::disk('public')
            ->path($path);
    }

    /**
     * Interact with the tenant's short_name.
     */
    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $value ?? $attributes['name'],
        );
    }

    /**
     * @return HasMany respondents
     */
    public function respondents(): HasMany
    {
        return $this->hasMany(Respondent::class);
    }

    /**
     * @return HasMany divisions
     */
    public function divisions(): HasMany
    {
        return $this->hasMany(Division::class)
            ->orderBy('name');
    }

    /**
     * @return HasMany users
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class)
            ->orderBy('name');
    }

    /**
     * @return HasMany questionSets
     */
    public function questionSets(): HasMany
    {
        return $this->hasMany(QuestionSet::class)
            ->orderBy('name');
    }

    /**
     * @return BelongsTo province
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * @return BelongsTo regency
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * @return BelongsTo district
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Points to the default question set.
     *
     * @return BelongsTo question set
     */
    public function questionSet(): BelongsTo
    {
        return $this->belongsTo(QuestionSet::class);
    }
}

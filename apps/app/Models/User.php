<?php

namespace App\Models;

use App\Models\Scopes\SameTenantScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tenant_id',
        'username',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::boot();

        static::addGlobalScope(new SameTenantScope);
    }

    /**
     * Scope a query to only include WithoutMe users.
     */
    public function scopeWithoutMe(Builder $query): void
    {
        $loggedInOperator = auth()->user();

        $query->where('id', '!=', $loggedInOperator->id);
    }

    /**
     * @return BelongsTo tenant
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Authorizing user.
     * See: https://filamentphp.com/docs/2.x/admin/users#authorizing-access-to-the-admin-panel
     *
     * @return bool
     */
    public function canAccessFilament(): bool
    {
        return true;
    }
}

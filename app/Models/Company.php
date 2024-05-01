<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function scopeCreatedLastTenDays($query)
    {
        return $query->where('created_at', '>=', now()->subDays(10));
    }
    public function scopeHasMoreThanTwoEmployees($query)
    {
        return $query->has('employees', '>', 2);
    }

}

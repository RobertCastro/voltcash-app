<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Store
 * @package App\Models
 * @property int $id
 * @property string $namelegal_name
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */

class Store extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeFilter(Builder $query, array $filters)
    {
        if (!request("page")) {
            session()->put("search", $filters['search'] ?? null);
            session()->put("state", $filters['state'] ?? null);
        }
        $query->when(session("search"), function ($query, $search) {
            $query->where('legal_name', 'LIKE', '%' . $search . '%');
        })->when(session("state"), function ($query, $state) {

            if ($state === 'Pending') {

                $query->where('status', 'Pending');

            } elseif ($state === 'Declined') {

                $query->where('status', 'Declined');
               
            } elseif ($state === 'Approved') {

                $query->where('status', 'Approved');
                
            } elseif ($state === 'Finished') {

                $query->where('status', 'Finished');
            }
        });
    }
}

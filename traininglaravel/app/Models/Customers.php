<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Customers extends Model
{
    use HasFactory, Searchable;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'customername',
        'phone',
        'city',
        'state',
        'postalcode',
        'country',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'customername' => $this->customername,
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'postalcode' => $this->postalcode,
            'country' => $this->country,
        ];
    }
}
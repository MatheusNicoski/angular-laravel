<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'cpf',
    ];

    protected $dates = ['deleted_at'];

    public function create($fields)
    {

        return parent::create([
            'user_id'  => auth()->user()->id,
            'name'     => $fields['name'],
            'email'    => $fields['email'] ,
            'phone'    => $fields['phone'] ,
            'cpf'      => $fields['cpf'] ,
        ]);

    }

}

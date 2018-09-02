<?php

namespace App\Models;
use Carbon\Carbon;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
	protected $fillable = [
	'type', 'amount', 'total_before', 'total_after', 'user_id_trasanction', 'date' 
	];

	public function type($type = null)
	{

		$types = [
		'I' => 'Entrada',
		'O' => 'Saque',
		'T' => 'Transferência',
		];
		if (!$type)
			return $types;

		if ($this->user_id_trasanction != null && $type == 'I')
			return 'Transferência Recebido';

		return $types[$type];
	}

	public function getDateAttribute($value)
	{
		return Carbon::parse($value)->format('d/m/Y');
	}

	    public function scopeUserAuth($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

	public function user(){

		return $this->belongsTo(User::class);
	}

	public function userReceiver(){

		return $this->belongsTo(User::class, 'user_id_trasanction');
	}

	 public function search(Array $data)
    {
        $historics = $this->where(function ($query) use ($data) {
            if (isset($data['id']))
                $query->where('id', $data['id']);
            if (isset($data['date']))
                $query->where('date', $data['date']);
             if (isset($data['type']))
                $query->where('type', $data['type']);
        })// ->where('user_id', auth()->user()->id) **substitui isso pelo scope userAuth() declarado acima
        ->userAuth()
        	->with(['userReceiver'])
        	->paginate($this->totalPage);
              //->toSql();dd($historics);
        return $historics;
    }

}



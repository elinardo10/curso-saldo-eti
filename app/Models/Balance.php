<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Balance extends Model
{
  public $timestamps = false;

  public function deposit(float $value) : Array
  {
    DB::beginTransaction();

    $totalBefore = $this->amount ? $this->amount : 0;
    $this->amount += number_format($value, 2, '.', '');
    $deposit = $this->save();

    $historic = auth()->user()->historics()->create([
      'type'          => 'I',
      'amount'        => $value,
      'total_before'  => $totalBefore,
      'total_after'   => $this->amount,
      'date'          => date('ymd'),
      ]);

    if($deposit && $historic)
    {
      DB::commit();

      return [
      'success' => true,
      'message' => 'Sucesso ao carregar'
      ];
    }else{

      DB::rollBack();

      return [
      'success' => false,
      'message' => 'falha ao carregar'
      ];
    }


  }

  public function withdraw(float $value ): Array
  {

    if($this->amount < $value )
      return [
    'success' => false,
    'message' => 'Seu saldo é insuficiente'
    ];


    DB::beginTransaction();

    $totalBefore = $this->amount ? $this->amount : 0;
    $this->amount -= number_format($value, 2, '.', '');
    $withdraw = $this->save();

    $historic = auth()->user()->historics()->create([
      'type'          => 'O',
      'amount'        => $value,
      'total_before'  => $totalBefore,
      'total_after'   => $this->amount,
      'date'          => date('ymd'),
      ]);

    if($withdraw && $historic)
    {
      DB::commit();

      return [
      'success' => true,
      'message' => 'Saque realizado com sucesso!'
      ];
    }else{

      DB::rollBack();

      return [
      'success' => false,
      'message' => 'falha ao carregar'
      ];
    }


  }

  public function transfer(float $value, User $receiver): Array
  {
   if($this->amount < $value )
    return [
  'success' => false,
  'message' => 'Seu saldo é insuficiente'
  ];


   DB::beginTransaction();

   /*****************************************
    *   Atualiza o próprio saldo 
   ******************************************/

  $totalBefore = $this->amount ? $this->amount : 0;
  $this->amount -= number_format($value, 2, '.', '');
  $transfer = $this->save();

    $historic = auth()->user()->historics()->create([
    'type'                => 'T',
    'amount'              => $value,
    'total_before'        => $totalBefore,
    'total_after'         => $this->amount,
    'date'                => date('ymd'),
    'user_id_trasanction' => $receiver->id
    ]);

   /*****************************************
   *   Atualiza saldo do recebedor
   ******************************************/
  $receiverBalance = $receiver->balance()->firstOrCreate([]);
  $totalBeforeReceiver = $receiverBalance->amount ? $receiverBalance->amount : 0;
  $receiverBalance->amount += number_format($value, 2, '.', '');
  $transferReceiver = $receiverBalance->save();

  $historicReceiver = $receiver->historics()->create([
    'type'                => 'I',
    'amount'              => $value,
    'total_before'        => $totalBeforeReceiver,
    'total_after'         => $receiverBalance->amount,
    'date'                => date('ymd'),
    'user_id_trasanction' => auth()->user()->id,
    ]);

  if( $transfer && $historic && $transferReceiver && $historicReceiver )
  {
    DB::commit();

    return [
    'success' => true,
    'message' => 'Transferencia Realizada com Sucesso!'
    ];

  }

    DB::rollBack();

    return [
    'success' => false,
    'message' => 'falha ao transferir'
    ];

}

}

<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyFormRequest;
use App\User;
use App\Models\Historic;
use Carbon\Carbon;

class BalanceController extends Controller

{

    private $totalPage = 10;

    public function index(){

    	$balance = auth()->user()->balance;
    	$amount = $balance ? $balance->amount : 0;

    	return view('sistema.balance.index', compact('amount'));
    }

    public function deposit()
    {

    	return view('sistema.balance.deposit');
    }

    public function store(MoneyFormRequest $request){

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

         return redirect()->route('sistema.balance')->with(['msgsuccess'=>'Recarga com sucesso!']);
    }

     public function withdraw()
    {

        return view('sistema.balance.withdraw');
    }
    //store do saque
     public function sacar_store(MoneyFormRequest $request){

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);

          if ($response['success'])
            return redirect()
                        ->route('balance.sacar')
                        ->with('msgsuccess', $response['message']);
        return redirect()
                    ->back()
                    ->with('error', $response['message']);
    }

    public function transfer(){

        return view('sistema.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user){

       if(!$receiver = $user->getReceiver($request->receiver)) 
        return redirect()
                    ->back()
                    ->with(['error'=>'usuario n encontrado']);

       if($receiver->id === auth()->user()->id )
       return redirect()
                    ->back()
                    ->with('error', 'não pode transferir pra vc mesmo'); 

          $balance = auth()->user()->balance;          

      return view('sistema.balance.transfer-confirm', compact('receiver', 'balance'));

    }

    public function TransferStore(MoneyFormRequest $request, User $user){

        if (!$receiver = $user->find($request->receiver_id)) 
            return redirect()
                            ->route('balance.transfer')
                            ->with('error', 'rebedor não encontrado');

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $receiver);

          if ($response['success'])
            return redirect()
                        ->route('sistema.balance')
                        ->with('msgsuccess', $response['message']);
        return redirect()
                    ->back()
                    ->with('error', $response['message']);
    }

    public function historics(Historic $historic){

        $historics = auth()->user()->historics()->with('userReceiver')->paginate($this->totalPage);

        //passando valor para o form select no serch
        $types = $historic->type();

         return view('sistema.balance.historics', compact('historics', 'types'));

    }

    public function historicSearch(Request $request, Historic $historic){

        $dataForm = $request->except('_token');
        $historics = $historic->search($dataForm,$this->totalPage);
        $types = $historic->type();

         return view('sistema.balance.historics', compact('historics', 'types', 'dataForm'));
    }
}

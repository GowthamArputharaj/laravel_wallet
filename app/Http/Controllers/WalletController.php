<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();
        $wallet = null;

        if($auth_user) {
            $wallet = Wallet::where('user_id', $auth_user->id)->get();
        } else {
            $wallet = [];
        }
        
        return view('wallet.index', compact('wallet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = [
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'remark' => $request->remark,
            'type' => $request->type,
            'date' => date($request->date),
        ];

        $data['id'] = DB::table('wallets')->insertGetId($data);

        return response(json_encode($data), 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $data = [
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'remark' => $request->remark,
            'type' => $request->type,
            'date' => date($request->date),
        ];

        $data['id'] = DB::table('wallets')->where('id', $request->id)->update($data);

        return response(json_encode($data), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Wallet::where(['user_id' => Auth::id(), 'id' => $id])->delete();

        return response(json_encode(['id' => $id]), 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Chanel;
use App\Models\Member;
use App\Models\Harga;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $chanels = Chanel::all();
        return view('home', compact('user', 'chanels'));
    }

    public function stop(Request $request)
    {
        $chanelId = $request->input('idc');
        $memberId = $request->input('idm');

        $member = Member::find($memberId);
        $member->update([
            'tgl_stop' => now(),
            'tgl' => today(),
            'status' => 'B',
        ]);

        Chanel::where('id_chanel', $chanelId)->update(['status' => 'N']);

        return response()->json(['success' => true]);
    }

    public function timefs()
    {
        $member = Member::where('status', 'Y')->first();
        if ($member) {
            $diff = $member->tgl_mulai->diff(now());
            $total = ($diff->i / $member->harga->menit) * $member->harga->harga;

            $response = [
                'status' => 'success',
                'id_member' => $member->id_member,
                'nama' => $member->nama_member,
                'tl_rp' => 'Rp. ' . number_format($total, 0, ',', '.'),
                'total' => $total,
                'lama' => $diff->format('%H:%I:%S'),
            ];
        } else {
            $response = ['status' => 'failed'];
        }

        return response()->json($response);
    }

    public function start(Request $request)
    {
        $chanelId = $request->input('id');
        $member = Member::create([
            'nama_member' => $request->input('nama'),
            'tgl_mulai' => now(),
            'id_chanel' => $chanelId,
            'status' => 'Y',
        ]);

        Chanel::where('id_chanel', $chanelId)->update(['status' => 'Y']);

        return redirect()->route('home');
    }

    public function pay(Request $request)
    {
        $memberId = $request->input('id_m');
        $member = Member::find($memberId);
        $member->update([
            'status' => 'N',
            'lama_sewa' => $request->input('sewa'),
            'total' => $request->input('total'),
            'harga_permenit' => $request->input('hargac'),
            'dibayar' => $request->input('by'),
        ]);

        return redirect()->route('home')->with('status', 'Payment successful');
    }

    public function delete(Request $request)
    {
        $chanelId = $request->input('idc');
        $memberId = $request->input('idm');
        
        Member::where('id_member', $memberId)->delete();
        Chanel::where('id_chanel', $chanelId)->update(['status' => 'N']);

        return response()->json(['success' => true]);
    }

    public function editPayment(Request $request)
    {
        $memberId = $request->input('id');
        Member::where('id_member', $memberId)->update(['status' => 'B']);

        return response()->json(['success' => true]);
    }

    public function deletePayment(Request $request)
    {
        $memberId = $request->input('id');
        Member::where('id_member', $memberId)->delete();

        return response()->json(['success' => true]);
    }
}

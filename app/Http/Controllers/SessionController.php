<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\User;

class SessionController extends Controller
{
    public function index()
    {
        $session = Session::with('user')->get();
        $result = [
            'message' => 'Success',
            'error' => 0,
            'session' => $session
        ];
        return $result;
    }

    public function detail($id)
    {
        $session = Session::with('user')->find($id);
        if($session == null) {
            return response()->json(['message' => 'Data tidak ada']);
        }
        $result = [
            'message' => 'Success',
            'error' => 0,
            'session' => $session
        ];
        return $result;
    }

    public function create(Request $request)
    {
        $cekUser = User::find($request->userID);
        
        if($cekUser == null) {
            return response()->json(['message' => 'Id User tidak valid']);
        } else {
            $session = Session::create([
                'userID' => $request->userID,
                'name' => $request->name,
                'description' => $request->description,
                'start' => $request->start,
                'duration' => $request->duration,
            ]);
        }
        return response()->json(['message' => 'Berhasil Disimpan', 'error' => 0, 'session' => $session]);
    }
    
    public function update(Request $request, $id)
    {
        $session = Session::find($id);
        if($session == null) {
            return response()->json(['message' => 'Data Tidak Ada']);
        } 
        $session->userID = $request->userID;
        $session->name = $request->name;
        $session->description = $request->description;
        $session->start = $request->start;
        $session->duration = $request->duration;
        if(User::find($request->userID) == null) {
            return response()->json(['message' => 'Id User tidak valid']);
        }
        $session->save();
        return response()->json(['message' => 'Sukses', 'error' => 0, 'session' => $session]);
    }

    public function delete($id)
    {
        $session = Session::with('user')->find($id);
        if($session == null) {
            return response()->json(['message' => 'Data Tidak Ada']);
        } 
        $session->delete();
        return response()->json(['message' => 'Berhasil Dihapus', 'error' => 0]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\NhanVienRequest;
use App\Http\Requests\TestRequest;
use App\Models\HopDong;
use App\Models\Luong;
use App\Models\PhuCap;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HopDongController extends Controller
{
    public function create(){
        return view('hopdong.create')->with('phucaps', PhuCap::all());
    }
    public function save(TestRequest $request){
        // $request->avatar->move(public_path('uploads'), $request->avatar->getClientOriginalName());
        DB::beginTransaction();
        try{
            $nhanvien=new User();
            $nhanvien->fill($request->except('ngayKy', 'ngayHetHan', 'phucap', 'luong', 'password', 'avatar')); 
            $nhanvien->avatar="uploads/".$request->avatar->getClientOriginalName();
            $nhanvien->password=Hash::make($request->password);
            $nhanvien->phongban()->associate($request->idphongban);
            $nhanvien->save();
            $hopdong=new HopDong();
            $hopdong->fill(['ngayKy'=>$request->ngayKy, 'ngayHetHan'=>$request->ngayHetHan]);
            $hopdong->nhanvien()->associate($nhanvien);
            $luong=Luong::firstOrCreate(['mucluong'=> $request->luong]);
            $hopdong->luong()->associate($luong)->save();
            $idphucaps=explode(',', $request->idphucap[0]);
            $phucaps=PhuCap::find($idphucaps);
            foreach($phucaps as $phucap){
                $mucphucaps[$phucap->id]=['mucphucap'=>$phucap->mucphucap];
            }
            $hopdong->phucaps()->attach($mucphucaps);
            $hopdong->save();

            DB::commit();
            $request->avatar->move(public_path('uploads'), $request->avatar->getClientOriginalName());
        }
        catch(Exception $e){
            DB::rollback();
            return response()->json($e);
        }   
        return response()->json('them hop dong');
    }
}

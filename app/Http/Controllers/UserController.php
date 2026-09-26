<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersRole;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = UsersRole::all();
        return view('users/index',compact('users'));
    }
    public function edit($id = null){
        $levels = Level::pluck('name', 'id')->prepend('เลือกตำแหน่ง');
        if($id){
            $users = UsersRole::where('id',$id)->first();
            return view('users/edit')->with('users',$users)->with('levels',$levels);
        }
    }
    public function update(Request $request){
        $rules = array(
            'username' => 'required',
            'email' => 'required',
            'level_id' => 'required|numeric'
        );
        $message = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
        );
        $id = $request->input('id');
        $temp = array(
            'username'=> $request->username,
            'email' => $request->email,
            'level_id' => $request->level_id,
        );
        $validator = Validator::make($temp, $rules, $message);
        if($validator->fails()){
            return redirect('users/edit/'. $id)->withErrors($validator)->withInput();
        }
        $users = UsersRole::find($id);
        $users->username = $request->username;
        $users->email = $request->email;
        $users->level_id = $request->level_id;
        $users->save();
        return redirect('users')->with('ok',true)->with('บันทึกขอมูลเรียบร้อยแล้ว');
    }
}

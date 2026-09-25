@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>แก้ไขข้อมูล</h1>
            <ul class="breadcrumb">
                <li><a href="{{ URL::to('users') }}">ข้อมูลรายชื่อ</a></li>
                <li class="active">แก้ไขข้อมูล</li>
            </ul>
        </div>
        {!! Form::model($users, [
            'action' => 'App\Http\Controllers\UserController@update',
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <input type="hidden" name="id" value="{{ $users->id }}">

        <div class="panel-body">
            <table>
                <tr>
                    <td>{{ Form::label('username','ชื่อ') }}</td>
                    <td>{{ Form::text('username',$users->username,['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('email','อีเมล') }}</td>
                    <td>{{ Form::text('email',$users->email,['class' => 'form-control']) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('level_id','ตำแหน่ง') }}</td>
                    <td>{{ Form::select('level_id',$levels,Request::old('level_id'), ['class' => 'form-control']) }}</td>
                </tr>
            </table>
        </div>
        <div class="panel-footer">
            <button type="reset" class="btn btn-danger">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> บันทึก</button>
        </div>
        {!! Form::close() !!}
    </div>
@stop

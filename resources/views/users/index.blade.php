@extends('layouts.master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>แสดงรายชื่อผู้ใช้</h4>
            </div>
        </div>
        <div class="panel-body">
            <table class="table-bordered bs-table">
                <thead>
                    <tr class="">
                        <th>ชื่อ</th>
                        <th class="bs-center">อีเมล</th>
                        <th class="bs-center">ระดับ</th>
                        <th class="bs-center">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td class="bs-center">{{ $user->email }}</td>
                            <td class="bs-center">{{ $user->level->name }}</td>
                            <td><a href="{{ URL::to('users/edit/'. $user->id)}}"><i class="fa fa-edit"></i>แก้ไขข้อมูล</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
    </div>
@stop

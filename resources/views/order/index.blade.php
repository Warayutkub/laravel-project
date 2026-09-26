@extends('layouts.master')
@section('content')
    <div  class="container">
        <h2>แสดงการสั่งสื้อสินค้า</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>เลขที่ใบสั่งซื้อ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>วันที่สั่งซื้อ</th>
                    <th>ยอดรวม</th>
                    <th>รายละเอียด</th>
                    <th>สถานะการชำระเงิน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $o)
                    <tr>
                        <td>{{$o->id}}</td>
                        <td>{{$o->po_no}}</td>
                        <td>{{$o->cust_name}}</td>
                        <td>{{$o->po_date}}</td>
                        <td>{{number_format($o->total_amount,2)}}</td>
                        <td><a href="{{ url('/order/'.$o->id)}}" class="btn btn-primary btn-sm">รายละเอียด</a></td>
                        <td>
                        @if($o->payment_status == 'paid')
                            <span class="label label-success">ชำระเงินแล้ว</span>
                        @else
                            <span class="label label-danger">ยังไม่ชำระเงิน</span>
                        @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
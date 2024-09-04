@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Vendor Withdraw Request</h1>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Withdraw method</b></td>
                                        <td>{{$wrequest->method}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Withdraw charge </b></td>
                                        <td>{{($wrequest->withdraw_charge / $wrequest->total_amount) * 100}}%</td>
                                    </tr>
                                    <tr>
                                        <td><b>Withdraw charge amount</b></td>
                                        <td>{{$settings->currency_icon}}{{$wrequest->withdraw_charge}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total amount</b></td>
                                        <td>{{$settings->currency_icon}}{{$wrequest->total_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Withdraw amount</b></td>
                                        <td>{{$settings->currency_icon}}{{$wrequest->withdraw_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Status</b></td>
                                        <td>
                                            @if ($wrequest->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @elseif ($wrequest->status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                            @else
                                            <span class="badge bg-success">Declined</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Account Information</b></td>
                                        <td>{!!$wrequest->account_info!!}</td>
                                    </tr>
                                </tbody>
                            </table>
                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row mt-4">
                        <div class="col-md-4">
                       <form action="{{route('admin.withdraw.update', $wrequest->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                <option @selected($wrequest->status === 'pending') value="pending">Pending</option>
                                <option @selected($wrequest->status === 'paid') value="paid">Paid</option>
                                <option @selected($wrequest->status === 'declined') value="declined">Declined</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                       </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

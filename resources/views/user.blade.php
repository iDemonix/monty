@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>User: {{$user->name}}</h1>
          </div>

          <div class="row">   
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        User details
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <h5>Full Name</h5>
                        <p>{{$user->name}}</p>
                        <h5>Display Name</h5>
                        <p>{{$user->display_name}}</p>
                        <h5>Email</h5>
                        <p>{{$user->email}}</p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                       <h5>Account Created</h5>
                       <p>{{$user->created_at->diffForHumans()}}<br /><small>{{$user->created_at}}</small></p>
                    </div>
                </div>
            </div>
        </div>
@endsection

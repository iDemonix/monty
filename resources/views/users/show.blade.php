@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>User: {{$user->display_name}}</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <h3>{!!Helper::labelForUserStatus($user->status)!!}</h3>
              </div>
            </div>
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
                        <h5>Email</h5>
                        <p>{{$user->email}}</p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                       <h6>Account Created</h6>
                       <p>{{$user->created_at->diffForHumans()}}<br /><small>{{$user->created_at}}</small></p>
                       <h6>Last Login</h6>
                       <p>{!!Helper::lastLoginAt($user->last_login_at)!!}<br /><small>{{$user->last_login_at}}</small><br /><small>{{ ($user->last_login_ip == 0) ? '' : $user->last_login_ip }}</small></p>

                    </div>
                </div>
            </div>
        </div>
@endsection

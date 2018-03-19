@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>My Account</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#changeMyPasswordModal">
                    <span data-feather="lock" style="margin-right: 5px"></span>Change Password
                </button>
              </div>
            </div>
          </div>

          <div class="row">   
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit your details
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/account" method="POST">
                            {{csrf_field()}}
                          <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                          </div>
                          <div class="form-group">
                            <label for="display_name">Display Name</label>
                            <input type="text" class="form-control" name="display_name" value="{{$user->display_name}}">
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                          </div>
                          <button type="submit" class="btn btn-success">
                            <span data-feather="save" style="margin-right: 5px"></span>Update Account
                          </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                       <h5>Account Since</h5>
                       <p>{{$user->created_at->diffForHumans()}}<br /><small>{{$user->created_at}}</small></p>
                    </div>
                </div>
            </div>
        </div>
@include('modals.change-my-password')
@endsection
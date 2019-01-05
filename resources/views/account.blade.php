@extends('layouts.app')

@section('content')
<form action="/account" method="POST">
      {{csrf_field()}}
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>My Account</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#changeMyPasswordModal" style="margin-right: 10px">
                    <span data-feather="lock" style="margin-right: 5px"></span>Change Password
                </button>
                <button class="btn btn-sm btn-primary" type="submit">
                    <span data-feather="save" style="margin-right: 5px"></span>Save Settings
                </button>
              </div>
            </div>
          </div>
          @if(Session::has('message'))
          <div class="alert alert-{{Session::get('status', 'info')}}" role="alert">
            {{Session::get('message')}}
          </div>
          @endif
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="margin-bottom:30px">
                    <div class="card-body">
                       <h5>Locale</h5>
                       <p>Timezone</p>
                       <select class="custom-select" name="timezone">
                        @foreach($timezones as $timezone)
                        {{ $selected = ($timezone == $user->timezone) ? 'selected' : '' }}
                        <option value="{{ $timezone }}" {{$selected}}>{{ $timezone }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                       <h5>Personal Settings</h5>
                       <div class="form-group">
                            <span class="switch">
                              @if($user->sort_reverse)
                              <input type="checkbox" class="switch" name="sort_reverse" id="switch-id" checked>
                              @else
                              <input type="checkbox" class="switch" name="sort_reverse" id="switch-id">
                              @endif
                              <label for="switch-id">Reverse ticket history</label>
                            </span>
                          </div>
                    </div>
                </div>
            </div>
        </div>
      </form>
@include('modals.change-my-password')
@endsection

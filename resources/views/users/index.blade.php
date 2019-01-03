@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>User Accounts</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newTicketModal">Add User</button>
              </div>
            </div>
          </div>
          <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Display Name</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">Last Login</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr data-href="/user/{{$user->id}}" class="tr-pointer">
                  <th scope="row">{{$user->id}}</th>
                  <td><strong>{{$user->display_name}}</strong></td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{!!Helper::labelForUserStatus($user->status)!!}</td>
                  <td>{!!Helper::lastLoginAt($user->last_login_at)!!}</td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <!-- New Ticket Modal -->
            <!-- @ include('modals.ticket-create') -->

@endsection

@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>Queue: {{ $queue->name }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newTicketModal">Create Ticket</button>
              </div>
            </div>
          </div>
          <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Status</th>
                  <th scope="col">Priority</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Updates</th>
                  <th scope="col">Last Updated</th>
                  <th scope="col">Owner</th>
                </tr>
              </thead>
              <tbody>
                @foreach($queue->tickets()->get() as $ticket)
                <tr>
                  <th scope="row">{{$ticket->id}}</th>
                  <td>{!!Helper::labelForStatus($ticket->status)!!}</td>
                  <td>{!!Helper::labelForPriority($ticket->priority)!!}</td>
                  <td><a href="/ticket/{{$ticket->id}}">{{$ticket->subject}}</a></td>
                  <td>{{$ticket->notes->count() + $ticket->actions->count()}}</td>
                  <td>{{$ticket->updated_at->diffForHumans()}}</td>
                  <td>{!!Helper::userUrl($ticket->user)!!}</td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <!-- New Ticket Modal -->
            @include('modals.ticket-create')

@endsection

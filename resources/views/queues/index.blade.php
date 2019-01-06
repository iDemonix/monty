@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>Queue: {{ $queue->name }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group">
                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newTicketModal"><span data-feather="plus" style="margin-right: 5px"></span>Create Ticket</button>
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
                  <th scope="col"></th>
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
                  <td>
                    <a href="{{ route('ticket', ['ticket' => $ticket]) }}" style="text-decoration: none">{{$ticket->subject}}</a>
                  </td>
                  <td>
                    @if( $ticket->notes->count() > 0 )
                      <span style="font-size: 0.7em; color: #bbb;"> &nbsp;<span data-feather="message-square"></span> {{$ticket->notes->count()}}</span>
                    @endif
                  </td>
                  <td><small>{{$ticket->updated_at->diffForHumans()}}</small></td>
                  @if($ticket->user)
                  <td>{!!Helper::userUrl($ticket->user)!!}</td>
                  @else
                  <td><h6><span class="badge badge-warning">Unassigned</span></h6></td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>


            <!-- New Ticket Modal -->
            @include('modals.ticket-create')

@endsection

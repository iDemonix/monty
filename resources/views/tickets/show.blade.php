@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>Ticket: {{ $ticket->subject }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                @if($ticket->status == 0)
                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#reopenTicketModal">
                  Re-open Ticket
                </button>
                @else
                <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#closeTicketModal">
                  Close Ticket
                </button>
                @endif
              </div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row details-row">
                      <div class="col-md-3">
                        <span class="details-left">Status</span>
                      </div>
                      <div class="col-md-9">
                        <h5 style="display:inline"><span class="details-right">{!!Helper::labelForStatus($ticket->status)!!}</span></h5>
                      </div>
                    </div>  

                     <div class="row details-row">
                      <div class="col-md-3">
                        <span class="details-left">Priority</span>
                      </div>
                      <div class="col-md-9 detail-editable">
                        @if($ticket->priority == 1)
                        <h5 style="display:inline"><span class="badge badge-danger">Critical</span></h5>
                        @elseif($ticket->priority == 2)
                        <h5 style="display:inline"><span class="badge badge-warning">High</span></h5>
                        @elseif($ticket->priority == 3)
                        <h5 style="display:inline"><span class="badge badge-info">Normal</span></h5>
                        @elseif($ticket->priority == 4)
                        <h5 style="display:inline"><span class="badge badge-secondary">Low</span></h5>
                        @endif
                        <span class="showmeonhover">
                            <a href="" data-toggle="modal" data-target="#priorityModal"><span data-feather="edit-2"></span></a>
                        </span>

                      </div>
                    </div>  

                     <div class="row details-row">
                      <div class="col-md-3">
                        <span class="details-left">Created</span>
                      </div>
                      <div class="col-md-9">
                        <span class="details-right">{{$ticket->created_at}}</span>
                        <span class="details-right details-mute">{{$ticket->created_at->diffForHumans()}}</span>

                      </div>
                    </div>  

                     <div class="row details-row">
                      <div class="col-md-3">
                        <span class="details-left">Queue</span>
                      </div>
                      <div class="col-md-9">
                        <span class="details-right">{{$ticket->queue->name}}</span>
                      </div>
                    </div>  
                </div>
              </div>
            </div>
          </div>
          @foreach($events as $event)
          <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
              
              <div class="card">
                <div class="card-body">
                  @if($event->field)
                    @if($event->field == 'priority')
                      {{ ucfirst($event->field) }} changed from {!!Helper::labelForPriority($event->old)!!} to {!!Helper::labelForPriority($event->new)!!} at {{$event->created_at}} by {{!empty($event->user->name) ? $event->user->name : 'Unknown'}}
                    @endif
                  @else
                    Note: {{ $event->body }} at {{$event->created_at}} by {{$event->user->name}}  
                  @endif
                </div>
              </div>
              
            </div>
          </div>
          @endforeach

          <!-- Modals -->
          @include('modals.ticket-priority')
          @include('modals.ticket-close')
          @include('modals.ticket-reopen')

@endsection
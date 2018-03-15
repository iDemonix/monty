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
          <div class="spacer"></div>
          @foreach($events as $event)
          <div class="row">
            <div class="col-md-12">
                <div class="timeline-time test-">
                  <span class="tl-time">
                    {{ Carbon\Carbon::parse($event->created_at)->format('H:i') }}
                  </span>
                  <span class="tl-day">
                    @if($event->created_at->isToday())
                      Today
                    @else
                      {{ Carbon\Carbon::parse($event->created_at)->format('F jS') }}
                    @endif
                  </span>
                </div>
                @if($event->field)
                  @if($event->field == 'priority' && ($event->old > $event->new))
                  <div class="timeline-icon timeline-icon-action">
                      <span data-feather="arrow-up"></span>
                  </div>
                  @elseif($event->field == 'priority' && ($event->old < $event->new))
                  <div class="timeline-icon timeline-icon-action">
                      <span data-feather="arrow-down"></span>
                  </div>
                  @else
                  <div class="timeline-icon ">
                      <span class="timeline-icon-text">?</span>
                  </div>
                  @endif
                @endif
                <div class="timeline-box test-">
                  @if($event->field)
                  <!-- event -->
                  <div class="timeline-update">
                    @if($event->field == 'priority')
                      {{ ucfirst($event->field) }} changed from {!!Helper::labelForPriority($event->old)!!} to {!!Helper::labelForPriority($event->new)!!} by <strong>{{!empty($event->user->name) ? $event->user->name : 'Unknown'}}</strong>
                    @endif
                  </div>
                  @else
                  <!-- note -->
                  <div class="card card-note">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-auto col-avatar test-">
                          <div class="avatar-placeholder">DW</div>
                        </div>
                        <div class="col-md-10 test-">
                          <span class="note-author">Dan Walker</span>
                          <span class="note-time">Today at 13:59</span>

                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      {{ $event->body }}
                    </div>
                  </div>
                  @endif
                </div>
            </div>
          </div>
          @endforeach
          <div class="row">
            <div class="col-md-12">
                <div class="timeline-time">
                  <span class="tl-time">
                    {{ Carbon\Carbon::parse($event->created_at)->format('H:i') }}
                  </span>
                  <span class="tl-day">
                    @if($event->created_at->isToday())
                      Today
                    @else
                      {{ Carbon\Carbon::parse($event->created_at)->format('F jS') }}
                    @endif
                  </span>
                </div>
                  <div class="timeline-icon timeline-icon-action timeline-final">
                      <span data-feather="sun"></span>
                  </div>
                  <div class="timeline-box timeline-box-final">
                    <div class="timeline-update">
                      Created at <strong>{{$ticket->created_at}}</strong> ({{$ticket->created_at->diffForHumans()}}) by <strong>{{$ticket->user->name}}</strong>
                    </div>
                </div>
            </div>
          </div>
          
          <!--
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
          -->

          <!-- Modals -->
          @include('modals.ticket-priority')
          @include('modals.ticket-close')
          @include('modals.ticket-reopen')

@endsection
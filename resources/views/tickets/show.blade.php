@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <div class="page-title">
   <h2>Ticket: {{ $ticket->subject }}</h2>
   <small class="created">Created {{ $ticket->created_at->diffForHumans() }} ({{ $ticket->created_at }})</small>
  </div>
  <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
         @if($ticket->status == 0)
         <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#reopenTicketModal">
         Reopen Ticket
         </button>
         @else
         <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#renameTicketModal">
         Rename Ticket
         </button>
         <button class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#closeTicketModal">
         Close Ticket
         </button>
         @endif
      </div>
  </div>
</div>
<div class="row">   
   <div class="col-md-3">
      <div class="card card-mini">
         <div class="card-body card-body-mini">
            <span class="details-mini">Status</span>
            <h5 style="display:inline">{!!Helper::labelForStatus($ticket->status)!!}</h5>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card card-mini">
         <div class="card-body card-body-mini test-">
            <span class="details-mini">Priority</span>
            <a href="" data-toggle="modal" data-target="#priorityModal">
            @if($ticket->priority == 1)
            <h5 style="display:inline"><span class="pri-badge badge badge-danger">Critical</span></h5>
            @elseif($ticket->priority == 2)
            <h5 style="display:inline"><span class="pri-badge badge badge-warning">High</span></h5>
            @elseif($ticket->priority == 3)
            <h5 style="display:inline"><span class="pri-badge badge badge-info">Normal</span></h5>
            @elseif($ticket->priority == 4)
            <h5 style="display:inline"><span class="pri-badge badge badge-secondary">Low</span></h5>
            @endif
            </a>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card card-mini">
         <div class="card-body card-body-mini test-">
            <span class="details-mini">Queue</span>
            {{$ticket->queue->name}}
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="card card-mini">
         <div class="card-body card-body-mini test-">
            <span class="details-mini">Owner</span>
            {{$ticket->user->name}}
         </div>
      </div>
   </div>
</div>
<div class="spacer"></div>

<!-- update ticket -->
@if($ticket->status)
<form method="POST" action="/note/create">
   <input type="hidden" name="ticket" value="{{$ticket->id}}">
   {{csrf_field()}}
   <div class="row">
      <div class="col-md-10">
         <div class="form-group">
            <textarea class="form-control" name="body" rows="4"></textarea>
         </div>
      </div>
      <div class="col-md-2">
         <button type="submit" class="btn btn-success btn-sm btn-spacer"><span data-feather="plus-circle"></span> Update Ticket</button>
         <button type="button" class="btn btn-outline-secondary btn-sm btn-spacer"><span data-feather="paperclip"></span>  Add Attachment</button>
         <button type="button" class="btn btn-outline-danger btn-sm btn-spacer"><span data-feather="x"></span> Close Ticket</button>
      </div>
   </div>
</form>
<div class="spacer"></div>
@endif
<!-- events (notes and actions) -->

@foreach($events as $event)
<div class="row">
   <div class="col-md-12">
      <!--time-->
      <div class="timeline-time">
         <span class="tl-time">
         {{ Carbon\Carbon::parse($event->created_at)->timezone(Auth::user()->timezone)->format('H:i') }}
         </span>
         <span class="tl-day">
         @if($event->created_at->isToday())
         Today
         @else
         {{ Carbon\Carbon::parse($event->created_at)->timezone(Auth::user()->timezone)->format('F jS') }}
         @endif
         </span>
      </div>
      <!-- not a note -->
      @if($event->field)
        @if($event->field == 'priority' && ($event->old > $event->new))
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="arrow-up"></span>
        </div>
        @elseif($event->field == 'priority' && ($event->old < $event->new))
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="arrow-down"></span>
        </div>
        @elseif($event->field == 'status' && $event->activity == 'close')
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="x"></span>
        </div>
        @elseif($event->field == 'status' && $event->activity == 'reopen')
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="book-open"></span>
        </div>
        @elseif($event->field == 'queue' && $event->activity == 'move')
        <div class="timeline-icon">
           <span data-feather="layers"></span>
        </div>
        @else
        <div class="timeline-icon">
           <span class="timeline-icon-text">?</span>
        </div>
        @endif
      @else
        <div class="timeline-icon timeline-icon-text">
           <span class="timeline-icon-text">DW</span>
        </div>
      @endif
      <div class="timeline-box test-">
         @if($event->field)
         <!-- event -->
         <div class="timeline-update">
            @if($event->field == 'priority')
            {{ ucfirst($event->field) }} changed from {!!Helper::labelForPriority($event->old)!!} to {!!Helper::labelForPriority($event->new)!!} by <strong>{!!Helper::userUrl($event->user)!!}</strong>
            @elseif($event->field == 'status')
            <strong>{{!empty($event->user->name) ? $event->user->name() : 'Unknown'}}</strong> set the ticket status to {!!Helper::labelForStatus($event->new)!!} (was previously {!!Helper::labelForStatus($event->old)!!})
            @elseif($event->field == 'queue')
            <strong>{{!empty($event->user->name) ? $event->user->name() : 'Unknown'}}</strong> moved the ticket from {!!Helper::labelForStatus($event->old)!!} to {!!Helper::labelForStatus($event->new)!!})
            @endif
         </div>
         @else
         <!-- note -->
         <div class="card card-note">
            <div class="card-header">
               <span class="note-author">{!!Helper::userUrl($event->user)!!}</span>
               <span class="note-time">{{$event->created_at->diffForHumans()}}</span>
               <div class="note-icons-right">
                @if($ticket->user_id == Auth::user()->id)
                  <a href=""><span data-feather="edit"></span></a>
                  <a href=""><span data-feather="trash"></span></a>
                @endif
               </div>
            </div>
            <div class="card-body">
               {!! Markdown::convertToHtml($event->body) !!}
            </div>
            @if($event->attachments->count() > 0)
            <div class="card-footer note-footer">
               @foreach($event->attachments as $attachment)
               <span data-feather="file"></span> <a href="#">{{$attachment->name}}</a> 
               @endforeach
            </div>
            @endif
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
         {{ Carbon\Carbon::parse($ticket->created_at)->format('H:i') }}
         </span>
         <span class="tl-day">
         @if($ticket->created_at->isToday())
         Today
         @else
         {{ Carbon\Carbon::parse($ticket->created_at)->format('F jS') }}
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

<!-- Modals -->
@include('modals.ticket-priority')
@include('modals.ticket-close')
@include('modals.ticket-reopen')
@endsection

@section('scripts')
<script>
  $('.pri-badge').hover(
       function(){ $(this).addClass('badge-dark') },
        function(){ $(this).removeClass('badge-dark') }
  )
</script>
@endsection
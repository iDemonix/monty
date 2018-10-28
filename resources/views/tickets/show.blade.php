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
         <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#renameTicketModal" style="margin-right:10px">
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

<!-- update ticket form -->
@if($ticket->status)
<form id="update-ticket" method="POST" action="/note/create">
   <input type="hidden" name="ticket" value="{{$ticket->id}}">
   <input type="hidden" id="attachments_array" name="attachments_array" value="">

   {{csrf_field()}}
   <div class="row">
      <div class="col-md-10">
         <div class="form-group">
            <textarea class="form-control" name="body" rows="4"></textarea>
         </div>
      </div>
      <div class="col-md-2">
         <button type="submit" class="btn btn-success btn-sm btn-spacer update-ticket">
          <span data-feather="plus-circle"></span>  Update Ticket
         </button>
         <button type="button" class="btn btn-outline-secondary btn-sm btn-spacer" data-toggle="modal" data-target="#addAttachmentsModal">
          <span data-feather="paperclip"></span>  <span id="addattachments">Add Attachments</span>
         </button>
         <button type="button" class="btn btn-outline-danger btn-sm btn-spacer">
          <span data-feather="x"></span>  Close Ticket
        </button>
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
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="layers"></span>
        </div>
        @elseif($event->field == 'subject' && $event->activity == 'rename')
        <div class="timeline-icon timeline-icon-action">
           <span data-feather="edit-3"></span>
        </div>
        @else
        <div class="timeline-icon">
           <span class="timeline-icon-text">?</span>
        </div>
        @endif
      @else
        <div class="timeline-icon timeline-icon-text" style="background-image:url('{{ $event->user->gravatar() }}')">
           
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

            @elseif($event->field == 'subject')
            <strong>{{!empty($event->user->name) ? $event->user->name() : 'Unknown'}}</strong> changed the ticket subject to <strong>{{$event->new}}</strong> (was <em>{{$event->old}}</em>)
            @endif
         </div>
         @else
         <!-- note -->
         <div class="card card-note">
            <div class="card-header">
               <span class="note-author">{!!Helper::userUrl($event->user)!!}</span>
               <span class="note-time">{{$event->created_at->diffForHumans()}}</span>
               <div class="note-icons-right">
                @if($event->user_id == Auth::user()->id)

                  <a href=""><span data-feather="edit"></span></a>
                  <a href="#delete-note" data-toggle="modal" data-target="#deleteNoteModal" data-id="{{$event->id}}"><span data-feather="trash"></span></a>
                @endif
               </div>
            </div>
            <div class="card-body">
               {!! Markdown::convertToHtml($event->body) !!}
               @if($event->updated_at->gt($event->created_at) )
                <small>Last edited {{$event->updated_at->diffForHumans()}}</small>
               @endif
            </div>
            @if($event->attachments->count() > 0)
            <div class="card-footer note-footer">
               @foreach($event->attachments as $attachment)
               <span data-feather="file"></span> <a href="{{$attachment->source}}">{{$attachment->name}}</a> 
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
@include('modals.note-delete')
@include('modals.ticket-priority')
@include('modals.ticket-close')
@include('modals.ticket-reopen')
@include('modals.ticket-rename')
@include('modals.ticket-attachments')
@endsection

@section('scripts')
<script>
  var attachment_count = 0;
  var attachment_array = [];

  $('.pri-badge').hover(
       function(){ $(this).addClass('badge-dark') },
       function(){ $(this).removeClass('badge-dark') }
  );

  $('a[href="#delete-note"]').click( function () {
       var noteid = $(this).data('id');
       $("#delete-note-id").val( noteid );
  });

  $('.update-ticket').click( function () {
       $(this).attr("disabled", "disabled");
       $('#update-ticket').submit();
  });

    /*
   * Some helper functions to work with our UI and keep our code cleaner
   */

// Adds an entry to our debug area
function ui_add_log(message, color)
{
  var d = new Date();

  var dateString = (('0' + d.getHours())).slice(-2) + ':' +
    (('0' + d.getMinutes())).slice(-2) + ':' +
    (('0' + d.getSeconds())).slice(-2);

  color = (typeof color === 'undefined' ? 'muted' : color);

  var template = $('#debug-template').text();
  template = template.replace('%%date%%', dateString);
  template = template.replace('%%message%%', message);
  template = template.replace('%%color%%', color);
  
  $('#debug').find('li.empty').fadeOut(); // remove the 'no messages yet'
  $('#debug').prepend(template);
}

// Creates a new file and add it to our list
function ui_multi_add_file(id, file)
{
  var template = $('#files-template').text();
  template = template.replace('%%filename%%', file.name);

  template = $(template);
  template.prop('id', 'uploaderFile' + id);
  template.data('file-id', id);

  $('#files').find('li.empty').fadeOut(); // remove the 'no files yet'
  $('#files').prepend(template);
}

// Changes the status messages on our list
function ui_multi_update_file_status(id, status, message)
{
  $('#uploaderFile' + id).find('span').html(message).prop('class', 'status text-' + status);
}

// Updates a file progress, depending on the parameters it may animate it or change the color.
function ui_multi_update_file_progress(id, percent, color, active)
{
  color = (typeof color === 'undefined' ? false : color);
  active = (typeof active === 'undefined' ? true : active);

  var bar = $('#uploaderFile' + id).find('div.progress-bar');

  bar.width(percent + '%').attr('aria-valuenow', percent);
  bar.toggleClass('progress-bar-striped progress-bar-animated', active);

  if (percent === 0){
    bar.html('');
  } else {
    bar.html(percent + '%');
  }

  if (color !== false){
    bar.removeClass('bg-success bg-info bg-warning bg-danger');
    bar.addClass('bg-' + color);
  }
}

  /* attachments */

  $(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */
  $('#drag-and-drop-zone').dmUploader({ //
    url: '/attachment/upload',
    maxFileSize: 1000000 * 64, // 64 MB - TODO: Configurate this
    extraData: {
       "_token": "{{csrf_token()}}",
       "ticket": "{{$ticket->id}}"
    },
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('All pending tranfers finished');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('New file added #' + id);
      ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Starting the upload of #' + id);
      ui_multi_update_file_status(id, 'uploading', 'Uploading...');
      ui_multi_update_file_progress(id, 0, '', true);
    },
    onUploadCanceled: function(id) {
      // Happens when a file is directly canceled by the user.
      ui_multi_update_file_status(id, 'warning', 'Canceled by User');
      ui_multi_update_file_progress(id, 0, 'warning', false);
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      //alert('Server Response for file #' + id + ': ' + data.id);
      ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
      ui_multi_update_file_status(id, 'success', 'Upload Complete');
      ui_multi_update_file_progress(id, 100, 'success', false);

      attachment_count = attachment_count + 1;
      $("#addattachments").html('Attachments (' + attachment_count + ')');

      var old = $("#attachments_array").prop('value');
      $("#attachments_array").prop('value', old + data.id + ',');

      // TODO: Update display    
      
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);  
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
  });
});
</script>
<!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>
@endsection
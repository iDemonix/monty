@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>Ticket: {{ $ticket->subject }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-danger">Close Ticket</button>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row details-row">
                      <div class="col-md-3">
                        <span class="details-left">Status</span>
                      </div>
                      <div class="col-md-9">
                        <h5 style="display:inline"><span class="details-right"><span class="badge badge-success">Open</span></span>
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
                            <a href="#" data-toggle="modal" data-target="#exampleModal"><span data-feather="edit-2"></span></a>
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

            <!-- Change Priority Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/ticket/{{$ticket->id}}/priority">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change ticket priority</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <ul class="radio-list">
                                <li>
                                    <input type="radio" name="priority" value="1" {{ $ticket->priority == 1 ? 'checked' : '' }}>
                                    <h6><span class="badge badge-nudge badge-danger">Critical</span> - Tickets requring urgent attention</h6>
                                </li>
                                <li>
                                    <input type="radio" name="priority" value="2" {{ $ticket->priority == 2 ? 'checked' : '' }}>
                                    <h6><span class="badge badge-nudge badge-warning">High</span> - Higher priority tickets</h6>
                                </li>
                                <li>
                                    <input type="radio" name="priority" value="3" {{ $ticket->priority == 3 ? 'checked' : '' }}>
                                    <h6><span class="badge badge-nudge badge-info">Normal</span> - Normal tickets</h6>
                                </li>
                                <li>
                                    <input type="radio" name="priority" value="4" {{ $ticket->priority == 4 ? 'checked' : '' }}>
                                    <h6><span class="badge badge-nudge badge-secondary">Low</span> - Tickets that can wait</h6>
                                </li>
                            </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
@endsection

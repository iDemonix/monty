@extends('layouts.app')

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h2>Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newTicketModal">Create Ticket</button>
              </div>
            </div>
          </div>
          <table class="table table-hover">
              <thead>
                <tr onclick="">
                  <th scope="col">Queue</th>
                  <th scope="col">Open</th>
                  <th scope="col">Overdue</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($queues as $queue)
                <tr href="/queue/{{$queue->id}}" style="cursor:pointer">
                  <th scope="row">{{$queue->name}}</th>
                  <td>
                    @foreach($counts[$queue->id] as $count)
                      {!!Helper::labelForQueueCount($count)!!}
                    @endforeach
                  </td>
                  <td>-</td>
                  <td><button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#newTicketModal"><i data-feather="plus"></i></button></td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <!-- New Ticket Modal -->
            @include('modals.ticket-create')

@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('table tr').click(function(){
        window.location = $(this).attr('href');
        return false;
    });
});
</script>
@endsection
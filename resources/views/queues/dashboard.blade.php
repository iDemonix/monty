@extends('layouts.app')

@section('content')
          <h2>Queue: {{ $queue->name }}</h2>
          <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
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
                  <td><a href="/ticket/{{$ticket->id}}">{{$ticket->subject}}</a></td>
                  <td>{{$ticket->notes->count() + $ticket->actions->count()}}</td>
                  <td>{{$ticket->updated_at->diffForHumans()}}</td>
                  <td>Someone</td>
                </tr>
                @endforeach
              </tbody>
            </table>

@endsection

@extends('layouts.app')

@section('content')
          <h2>Create Queue</h2>
          <form method="POST" action="">
            {{csrf_field()}}
          <div class="form-group">
            <label for="queue_name">Queue Name</label>
            <input type="text" class="form-control" name="name" aria-describedby="queue_help" placeholder="Monitoring">
            <small id="queue_help" class="form-text text-muted">A short and simple human readable name</small>
          </div>
          <button type="submit" class="btn btn-success">Create</button>
        </form>
@endsection

<div class="modal fade" id="newTicketModal" tabindex="-1" role="dialog" aria-labelledby="newTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/tickets/create">
                    {{ csrf_field() }}
                    <input type="hidden" name="queue" value="{{$queue->id}}">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="newTicketModalLabel">Create new ticket</h5>
                        <button type="button" class="create" data-dismiss="modal" aria-label="Create">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="subject">Subject</label>
                          <input type="text" class="form-control" name="subject">
                        </div>

                        <div class="form-group radio-group">
                          <input type="radio" name="priority" value="1">
                          <h5 style="display:inline; margin-right: 5px"><span class="badge badge-danger badge-nudge">Critical</span></h5>
                          <input type="radio" name="priority" value="2">
                          <h5 style="display:inline; margin-right: 5px"><span class="badge badge-warning badge-nudge">High</span></h5>
                          <input type="radio" name="priority" value="3" checked>
                          <h5 style="display:inline; margin-right: 5px"><span class="badge badge-info badge-nudge">Normal</span></h5>
                          <input type="radio" name="priority" value="4">
                          <h5 style="display:inline; margin-right: 5px"><span class="badge badge-secondary badge-nudge">Low</span></h5>
                        </div>

                        <div class="form-group">
                          <label for="owner">Owner</label>
                          <select class="form-control" id="owner" name="owner">
                            <option value="">Unassigned</option>
                            <option>You ({{Auth::user()->display_name}})</option>
                            @php
                              $userlist = App\User::all();
                            @endphp
                            @foreach($userlist as $user)
                            @if($user->id !== Auth::user()->id)
                            <option value="{{$user->id}}">{{$user->display_name}} ({{$user->name}})</option>
                            @endif
                            @endforeach
                          </select>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create ticket</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
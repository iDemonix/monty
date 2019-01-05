<div class="modal fade" id="priorityModal" tabindex="-1" role="dialog" aria-labelledby="priorityModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('ticket', ['ticket' => $ticket]) }}/priority">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="priorityModalLabel">Change ticket priority</h5>
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
<div class="modal fade" id="reopenTicketModal" tabindex="-1" role="dialog" aria-labelledby="reopenTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('ticket', ['ticket' => $ticket]) }}/reopen">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="reopenTicketModalLabel">Re-open Ticket</h5>
                        <button type="button" class="reopen" data-dismiss="modal" aria-label="reopen">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            Are you sure you want to reopen "{{$ticket->subject}}"?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Re-open ticket</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
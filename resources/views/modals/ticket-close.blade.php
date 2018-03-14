<div class="modal fade" id="closeTicketModal" tabindex="-1" role="dialog" aria-labelledby="closeTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/ticket/{{$ticket->id}}/close">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="closeTicketModalLabel">Close Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            Are you sure you want to close "{{$ticket->subject}}"?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Close ticket</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
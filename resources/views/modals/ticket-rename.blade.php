<div class="modal fade" id="renameTicketModal" tabindex="-1" role="dialog" aria-labelledby="renameTicketModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/ticket/{{$ticket->id}}/rename">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="renameTicketModalLabel">Rename Ticket</h5>
                        <button type="button" class="reopen" data-dismiss="modal" aria-label="reopen">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <input type="text" class="form-control" name="subject" value="{{$ticket->subject}}">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Rename ticket</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
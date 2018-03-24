<div class="modal fade" id="deleteNoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/note/delete">
                    {{ csrf_field() }}
                    <input type="hidden" name="delete-note-id" id="delete-note-id" value="">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteNoteModalLabel">Delete Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            Are you sure you want to delete this note?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
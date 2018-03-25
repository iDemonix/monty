<div class="modal fade" id="addAttachmentsModal" tabindex="-1" role="dialog" aria-labelledby="addAttachmentsModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/ticket/{{$ticket->id}}/close">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addAttachmentsModalLabel">Add Attachments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- Our markup, the important part here! -->
                          <div id="drag-and-drop-zone" class="dm-uploader">
                            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                            <div class="btn btn-primary btn-block">
                                <span>Open the file Browser</span>
                                <input type="file" title='Click to add Files' />
                            </div>
                          </div><!-- /uploader -->
                          <br />
                          <div class="card h-100">
                            <div class="card-header">
                              File List
                            </div>

                            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                              <li class="text-muted text-center empty">No files uploaded.</li>
                            </ul>
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">Continue</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
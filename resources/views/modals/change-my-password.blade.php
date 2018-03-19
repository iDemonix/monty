<div class="modal fade" id="changeMyPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="POST" action="/account/password">
                    {{ csrf_field() }}
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="closeTicketModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <label>Old password</label>
                            <input type="password" class="form-control" name="password_old" aria-describedby="passHelp">
                            <small id="passHelp" class="form-text text-muted">Your current password you use to login.</small>
                          </div>
                          <div class="form-group">
                            <label>New password</label>
                            <input type="password" class="form-control" name="password_new">
                          </div>
                          <div class="form-group">
                            <label>Confirm new password</label>
                            <input type="password" class="form-control" name="password_new_confirmation">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Change Password</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
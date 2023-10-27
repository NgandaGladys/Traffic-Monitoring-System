<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="addofficer">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Officer / Administrator</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--`userid`, `fullname`, `phone`, `email`, `password`, `token`, `role`, `date_registered` -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Full Name (required)</label>
                                <input class="form-control" name="fullname" type="text" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Phone Number (required)</label>
                                <input class="form-control" name="phone" maxlength="10" type="text" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Email (required)</label>
                                <input class="form-control" name="email" type="email" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Password (required)</label>
                                <input class="form-control" name="password" type="password" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_user_by_admin_new_user_btn" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="edit-user<?=$rx->userid; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?=$rx->userid; ?>" name="userid">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User Roles - <b style="box-shadow: 2px 1px #000; padding: 5px; border-radius: 10px;"><?=$rx->fullname; ?></b></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- `road_id`, `road_name` -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>User Role (required)</label>
                                <select class="form-control" name="role" required>
                                    <option value="user">Normal User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_user_role_new_user_btn" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
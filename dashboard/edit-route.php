<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="edit-route<?=$rx->rid; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?=$rx->rid; ?>" name="rid">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Route</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- `rid`, `road_id`, `fromm`, `too`, `status` -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Road Name (required)</label>
                                <input class="form-control" readonly name="road_name" value="<?=$rx->road_name; ?>" type="text" required />
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>Road From (required)</label>
                                <input class="form-control" name="fromm" value="<?=$rx->fromm; ?>" type="text" required />
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>Road too (required)</label>
                                <input class="form-control" name="too" value="<?=$rx->too; ?>" type="text" required />
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>Road status (required)</label>
                                <input class="form-control" name="status" value="<?=$rx->status; ?>" type="text" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="update_road_route_new_user_btn" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
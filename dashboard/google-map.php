<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="google-map<?=$rx->road_id; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Google Map - <?=$rx->road_name; ?></h5>
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
                                <label>Road Name (required)</label>
                                <input class="form-control" name="road_name" type="text" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_road_new_user_btn" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
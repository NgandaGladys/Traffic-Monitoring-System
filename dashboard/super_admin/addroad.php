<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="addroad">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Road</h5>
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
                                <label>Road Name</label>
                                <input class="form-control" name="road_name" type="text" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Location</label>
                                <select class="form-control" name="road_location" required>
                                    <option value="">Select location</option>
                                    <option>Jinja Road Main Station</option>
                                    <option>Mukono Police Station</option>
                                    <option>Bweyogerere Police Station</option>
                                    <!-- <option>D</option> -->
                                </select>
                                <!-- <input class="form-control" name="road_location" type="text" required /> -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_road_btn" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
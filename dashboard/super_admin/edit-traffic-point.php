<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>traffic points</title>
    <style>
        /* Define styles for each color */
        .option-clear {
            color: #2ecc71; /* Green color */
        }

        .option-moderate {
            color: #3498db; /* Blue color */
        }

        .option-jam {
            color: #e74c3c; /* Red color */
        }

        .option-unavailable {
            color: #95a5a6; /* Gray color */
        }
    </style>
</head>
<body>
    <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="edit-traffic-point<?=$rx->rid; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?=$rx->rid; ?>" name="rid">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Traffic Point</h5>
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
                                    <label>Road Name</label>
                                    <input class="form-control" readonly name="road_name" value="<?=$rx->road_name; ?>" type="text" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Road From</label>
                                    <input class="form-control" name="fromm" value="<?=$rx->fromm; ?>" type="text" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Road to</label>
                                    <input class="form-control" name="too" value="<?=$rx->too; ?>" type="text" required />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Traffic Status</label>
                                    <select class="form-control <?php echo 'option-' . strtolower($rx->status); ?>" name="status" required>
                                        <option value="Clear" class="option-clear" <?php echo ($rx->status === 'Clear') ? 'selected' : ''; ?>>Clear</option>
                                        <option value="Moderate" class="option-moderate" <?php echo ($rx->status === 'Moderate') ? 'selected' : ''; ?>>Moderate</option>
                                        <option value="Jam" class="option-jam" <?php echo ($rx->status === 'Jam') ? 'selected' : ''; ?>>Jam</option>
                                        <option value="Unavailable" class="option-unavailable" <?php echo ($rx->status === 'Unavailable') ? 'selected' : ''; ?>>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_route_btn" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

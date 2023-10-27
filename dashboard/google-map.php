<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-labelledby="modal_add_user" aria-hidden="true" id="google-map<?=$rx->road_id; ?>">
<?php 
    $result = json_decode(geolocation_api($rx->road_name), true);
    foreach ($result["data"] as $item) {
        if ($item["country"] === "Uganda") {
             $location = $item["name"];
             $lat = $item["latitude"];
             $lon = $item["longitude"];
            break; // Stop the loop when the first matching object is found
        }
    } ?>
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
                                <h1>Location: <?=$location; ?></h1>
                                   <iframe 
                                   width="600" 
                                   height="400" 
                                   frameborder="0" 
                                   scrolling="no" 
                                   marginheight="0" 
                                   marginwidth="0" 
                                   src="https://maps.google.com/maps?q=<?=$lat; ?>,<?=$lon; ?>&t=&z=15&ie=UTF8&iwloc=&output=embed">
                                   </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
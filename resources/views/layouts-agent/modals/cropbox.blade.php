
<!-- Modal Delete User -->
<div class="modal fade" id="CropboxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                                <div class="imageBox">
                                    <div class="thumbBox"></div>
                                    <div class="spinner" style="display: none">Loading...</div>
                                </div>
                                <div class="action text-center">
                                    <br/>
                                    <label class="btn btn-primary btn-file pull-left">
                                        Browse <input type="file" id="file" accept="image/*" style="display: none;">
                                    </label>
                                    <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success pull-right" id="btnCrop">Crop</button>
                                    <button type="button" class="btn btn-primary pull-left upload-zoom" id="btnZoomIn">+</button>
                                    <button type="button" class="btn btn-primary pull-left upload-zoom" id="btnZoomOut">-</button>
                                </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
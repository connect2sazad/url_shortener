<div class="page-heading">
    <h3>Shortened URLs</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <?php
                        if ($is_admin) {
                            include_once ___ABS_PATH___ . 'in/pages/admin-qrs.php';
                        } else {
                            include_once ___ABS_PATH___ . 'in/pages/users-qrs.php';
                        }
                        ?>
                    </div>
                </div>
                <div class="modal fade text-left" id="qr-generation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel19">QR Generated</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body" style="display: flex; justify-content: center; align-items: center;" id="qr-code-wrapper">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary btn-sm" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-sm-block d-none">Close</span>
                                </button>
                                <button type="button" class="btn btn-primary ml-1 btn-sm" onclick="download_qrcode()" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-sm-block d-none"><i class="bi bi-arrow-down-circle"></i> Download</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
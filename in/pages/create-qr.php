<div class="page-heading">
    <h3>Create QR</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" onsubmit="return create_qr(this)">
                                <div class="form-group">
                                    <label for="long_url">Enter URL for which you want to create QR:</label>
                                    <input type="url" class="form-control" name="full_url" id="full_url" required>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Create</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </form>
                            <div id="status-message" class="mt-3">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
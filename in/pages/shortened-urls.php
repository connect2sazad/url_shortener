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
                            if($is_admin){
                                include_once ___ABS_PATH___.'in/pages/admin-su.php';
                            } else {
                                include_once ___ABS_PATH___.'in/pages/users-su.php';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php

    //  get user details
    $user = get_user($conn, $_SESSION[USER_GLOBAL_VAR]);
    // get associative array of details of the user
    $fetch = mysqli_fetch_assoc($user);

?>
<div class="page-heading">
    <h3>My Account</h3>
</div>
<div class="page-content">
    <section class="section">
        <div class="row" id="table-head">
            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST" onsubmit="return update_profile('<?= site_url() . '/' . DIRNAME ?>')">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="full_name">Full Name</label>
                                            <input type="text" id="full_name" class="form-control" placeholder="Full Name" name="full_name" value="<?= $fetch['full_name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?= $fetch['username'] ?>" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" id="phone" class="form-control" placeholder="Phone" name="phone" value="<?= $fetch['phone'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?= $fetch['email'] ?>" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" class="form-control" placeholder="Address" name="address" value="<?= $fetch['address'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" id="city" class="form-control" placeholder="City" name="city" value="<?= $fetch['city'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="state">State</label>
                                            <input type="text" id="state" class="form-control" name="state" placeholder="State" value="<?= $fetch['state'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pin">PIN Code</label>
                                            <input type="text" id="pin" class="form-control" name="pin" placeholder="PIN Code" value="<?= $fetch['pin'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
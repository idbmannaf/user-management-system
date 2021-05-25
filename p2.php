<?php require_once 'assets/php/header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link active font-weight-blod" data-bs-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editProfile" class="nav-link  font-weight-blod" data-bs-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link  font-weight-blod" data-bs-toggle="tab">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- profile tab content Start  -->
                        <div class="tab-pane container active" id="profile">
                            <div class="div card-group ">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID: <?php echo $cid; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Name:</b> <?php echo $cname; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Email:</b> <?php echo $cemail; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Gender:</b> <?php echo $cgender; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Date Of Birth:</b> <?php echo $cdob; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Phone:</b> <?php echo $cphone; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>Registered On:</b> <?php echo $reg_on; ?>
                                        </p>
                                        <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8">
                                            <b>E-mail Verified:</b> <?php echo $verified; ?>
                                            <?php if ($verified == 'Not Verified!') : ?>
                                                <a href="#" id="verify-email" class="float-right text-decoration-none">Verify Now</a>

                                            <?php endif; ?>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="card border-primary d-inline-block text-center"">
                                <?php if (!$cphoto) : ?>
                                    <img src=" assets/img/dummy.png" class="img-tumbnail img-fluid" width="390px ">

                                <?php else : ?>
                                    <img src="assets/img/<?php echo $cphoto ?>" class="img-tumbnail img-fluid" width="390px ">
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container" id="editProfile">
                            <div class="div card-group ">
                            <div class="card-group">
                                <div class="card border-danger align-self-center me-2">
                                    <div class="card border-primary d-inline-block text-center"">
                                        <?php if (!$cphoto) : ?>
                                    <img src=" assets/img/dummy.png" class="img-tumbnail img-fluid" width="390px ">

                                    <?php else : ?>
                                        <img src="assets/img/<?php echo $cphoto ?>" class="img-tumbnail img-fluid" width="390px ">
                                    <?php endif; ?>
                                    </div>

                                </div>
                                <div class="card  align-self-center ms-2" style="border: 1px solid red;">
                                    <form action="" method="post" class="mx-3 mt-2" enctype="multipart/form-data">
                                        <input type="hidden" name="oldImage" value="value=" <?php echo $cphoto; ?>">
                                        <div class="form-group m-0">
                                            <label for="profilePhoto" class="m-1">Upload Profile image</label>
                                            <input type="file" name="image" id="profilePhoto">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="name" class="m-1">Name</label>
                                            <input type="name" name="name" id="name" class="form-control" value="<?php echo $cname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="gender" class="m-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled <?php if ($cgender == NULL) {
                                                                                echo 'selected';
                                                                            } ?>>Select</option>
                                                <option value="male" <?php if ($cgender == 'male') {
                                                                            echo 'selected';
                                                                        } ?>>Male</option>
                                                <option value="female" <?php if ($cgender == 'female') {
                                                                            echo 'selected';
                                                                        } ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="dob" class="m-1">Date Of Birth</label>
                                            <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $cdob; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="phone" class="m-1">Phone</label>
                                            <input type="tel" name="phone" id="phone" class="form-control" value="<?php echo $cphoto; ?>" placeholder="Phone">
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" value="Update" name="update_profile" class="btn btn-danger btn-block form-control" id="profileUpdateBtn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane container" id="changePass">
                            <div class="div card-group">
                            <div class="card border-success">
                                    <div class="card-header bg-success text-white text-center lead"> Change Password </div>
                                    <form action="" method="POST" class='px-3 mt-2'>
                                        <div class="form-group">
                                            <label for="currentPass">Enter Your Current Password</label>
                                            <input type="password" name="currentPass" id="currentPass" placeholder="current pass" class="form-control form-control-lg">
                                        </div>
                                    </form>
                                </div>
                                <div class="card">Hello</div>
                            </div>
                        </div>
                        
                        <!-- profile tab content End  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
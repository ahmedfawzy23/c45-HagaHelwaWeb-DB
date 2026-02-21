<?php include "includes/header.php" ?>



<div class="card-body px-5 py-5" style="background-color:darkgray;">
    <h3 class="card-title text-left mb-3">Reset Password</h3>
    <?php
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<div class='alert alert-danger'>" . $error . "</div>";
        }
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }
    ?>
    <form action="handlers/resetPassword.php" method="post">
        <div class="form-group">
            <label>password *</label>
            <input type="password" class="form-control p_input" name="password" <?php if (isset($_SESSION['old']['password'])) echo "value=" . $_SESSION['old']['password'];
                                                                                unset($_SESSION['old']['password']); ?>>
        </div>
        <div class="form-group">
            <label>confirm password *</label>
            <input type="password" class="form-control p_input" name="confirm_password" <?php if (isset($_SESSION['old']['confirm_password'])) echo "value=" . $_SESSION['old']['confirm_password'];
                                                                                        unset($_SESSION['old']['confirm_password']); ?>>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn" name="reset_password">Reset Password</button>
        </div>
        <div class="d-flex">
            <button class="btn btn-facebook me-2 col">
                <i class="mdi mdi-facebook"></i> Facebook </button>
            <button class="btn btn-google col">
                <i class="mdi mdi-google-plus"></i> Google plus </button>
        </div>
        <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
    </form>
</div>
</div>
</div>
<!-- content-wrapper ends -->
</div>
<!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php include "includes/footer.php" ?>

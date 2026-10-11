<!-- Add User Page for Admin -->
<?php include 'sidebar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- Sidebar already included -->
        </div>

        <div class="col-md-10" style="margin-top: 120px;">
            <h4 style="text-align: center; font-size: 24px; margin-bottom: 30px;">
                <i class="fas fa-user-plus"></i> Add New User
            </h4>

            <!-- Display messages -->
            <?php
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> User added successfully.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . htmlspecialchars($_GET['error']) . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
            ?>

            <div class="card shadow p-4">
                <form method="POST" action="process_adduser.php">
                    <div class="form-group">
                        <label for="name"><strong>Full Name</strong></label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email address">
                    </div>

                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password"><strong>Confirm Password</strong></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Confirm password">
                    </div>

                    <div class="form-group">
                        <label for="role"><strong>User Role</strong></label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="user">User</option>
                            <option value="Supplier">Supplier</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-check"></i> Add User
                        </button>
                        <a href="users.php" class="btn btn-secondary btn-lg btn-block mt-2">
                            <i class="fas fa-arrow-left"></i> Back to Users
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>

<!-- Bootstrap and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

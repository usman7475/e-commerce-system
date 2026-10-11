<?php include 'sidebar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- Sidebar already included -->
        </div>

        <div class="col-md-10" style="margin-top: 120px;">
            <h4 style="text-align: center; font-size: 24px; margin-bottom: 30px;">
                <i class="fas fa-user-edit"></i> Edit User Role
            </h4>

            <?php
            if (!isset($_GET['id'])) {
                header('Location: users.php?error=User ID not provided');
                exit;
            }

            $user_id = $_GET['id'];
            $query = "SELECT * FROM registration WHERE id = '$user_id'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                header('Location: users.php?error=User not found');
                exit;
            }

            $user = mysqli_fetch_array($result);
            ?>

            <!-- Display Messages -->
            <?php
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Role updated successfully.
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
                <form method="POST" action="process_edituser.php">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                    <div class="form-group">
                        <label for="name"><strong>User Name</strong></label>
                        <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="role"><strong>User Role</strong></label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                            <option value="supplier" <?php echo ($user['role'] == 'supplier') ? 'selected' : ''; ?>>Supplier</option>
                          
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-check"></i> Update Role
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

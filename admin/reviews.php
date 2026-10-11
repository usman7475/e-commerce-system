<?php include 'sidebar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- Sidebar already included -->
        </div>

        <div class="col-md-10" style="margin-top: 120px;">
            <h4 style="text-align: center; font-size: 24px; margin-bottom: 30px;">
                <i class="fas fa-star"></i> Product Reviews
            </h4>

            <!-- Display Messages -->
            <?php
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> ' . htmlspecialchars($_GET['success']) . '
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

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $query = "SELECT r.review_id, r.rating, r.review_text, r.created_at,
                                          p.name as product_name, p.pid,
                                          reg.name as customer_name, reg.email
                                   FROM reviews r
                                   INNER JOIN product p ON r.product_id = p.pid
                                   INNER JOIN registration reg ON r.user_id = reg.id
                                   ORDER BY r.created_at DESC";
                        
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $stars = str_repeat('⭐', $row['rating']);
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row['product_name']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <span class="badge badge-warning">
                                            <?php echo $stars; ?> (<?php echo $row['rating']; ?>/5)
                                        </span>
                                    </td>
                                    <td>
                                        <small><?php echo htmlspecialchars(substr($row['review_text'], 0, 50)); ?>...</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo date('d-m-Y', strtotime($row['created_at'])); ?>
                                        </small>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#reviewModal<?php echo $row['review_id']; ?>">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <a href="deletereview.php?id=<?php echo $row['review_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this review?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>

                                <!-- View Review Modal -->
                                <div class="modal fade" id="reviewModal<?php echo $row['review_id']; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Review Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Product:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                                                <p><strong>Customer:</strong> <?php echo htmlspecialchars($row['customer_name']); ?></p>
                                                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                                                <p><strong>Rating:</strong> <?php echo $stars; ?> (<?php echo $row['rating']; ?>/5)</p>
                                                <p><strong>Date:</strong> <?php echo date('F d, Y', strtotime($row['created_at'])); ?></p>
                                                <hr>
                                                <p><strong>Review:</strong></p>
                                                <p><?php echo htmlspecialchars($row['review_text']); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="8" class="text-center text-muted">No reviews found</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
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

<?php
    session_start();
    require '../config/config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>User CRUD</title>
</head>
<body>
  
    <div class="container mt-4">

        <?php include('./admin-message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User Details
                            <a href="./admin.php" class="btn btn-secondary float-end ms-1">Log out</a>
                            <a href="./admin-add-user.php" class="btn btn-primary float-end">Add User</a>
                            
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM users";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $user)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $user['user_id']; ?></td>
                                                <td><?= $user['user_name']; ?></td>
                                                <td><?= $user['email']; ?></td>
                                                <td><?= $user['password']; ?></td>
                                                <td>
                                                    <a href="admin-view-user.php?user_id=<?= $user['user_id']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="admin-edit-user.php?user_id=<?= $user['user_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="./admin-add-user-check.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_user" value="<?=$user['user_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once "connection.php";

$sql = "SELECT * FROM user";
$list_users = $link->query($sql);

require "header.php";
?>

    <div class="pagetitle">
      <h1>Users</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <a type="button" class="btn btn-primary float-right m-2" href="users-add.php"><i class="bi bi-file-plus"></i>    Add user</a>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Comapny</th>
                    <th scope="col">Merchent</th>
                
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
    
                  <?php
                            if ($list_users->num_rows > 0) {
                                // output data of each row
                                while ($row = $list_users->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row["username"] ?></td>
                                        <td><?php echo $row["role"] ?></td>
                                        <td><?php echo $row["company"] ?></td>
                                        <td><?php echo $row["merchant"] ?></td>
                                       
                                        <td style="display: inline-flex;">
                                                <a href="users-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning " style="margin-right: 4px;" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="users-delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                        </td>
                                    </tr>
                            <?php


                                }
                            }

                            ?>
           
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>


<?php
require "footer.php";
?>
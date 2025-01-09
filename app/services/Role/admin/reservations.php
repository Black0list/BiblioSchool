<?php include_once "./adminHeader.php"; ?>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Applications</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Users</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $roles = $role->getAllRoles();

                                    foreach ($roles as $row) {
                                        $role->addRole($row['id'], $row['name']);
                                        ?>

                                        <tr>
                                            <td>
                                                <img alt="..." src="https://bytewebster.com/img/logo.png" class="avatar avatar-xs rounded-circle me-2">
                                                <a class="text-heading font-semibold" href="#">
                                                <?php echo $role->getProperty("id"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php echo $role->getProperty("name"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php 
                                                    $users = $library->getAllUsers();
                                                    foreach($users as $user){
                                                        if($user->getProperty('role') == $row["name"]){?>
                                                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                                                <?php echo $user->getProperty("name"); ?>
                                                            </span>
                                                        <?php }
                                                    }
                                                ?>
                                                </a>
                                            </td>
                                            <td class="text-end">
                                                <a href="#<?php echo $row["id"]; ?>" class="btn btn-sm btn-neutral bi-pen"></a>
                                                <a href="#<?php echo $row["id"]; ?>" class="btn btn-sm btn-neutral bi-trash"></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
<?php include_once "./adminFooter.php"; ?>
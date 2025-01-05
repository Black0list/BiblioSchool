<?php include_once "./adminHeader.php"; ?>
                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <h5 class="mb-0">Applications</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">LastName</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = $library->getAllUsers();

                                    foreach ($users as $user) {?>
                                        <tr>
                                            <td>
                                                <img alt="..." src="https://bytewebster.com/img/logo.png" class="avatar avatar-xs rounded-circle me-2">
                                                <a class="text-heading font-semibold" href="#">
                                                <?php echo $user->getProperty("name"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php echo $user->getProperty("prenom"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php echo $user->getProperty("mail"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge badge-pill bg-soft-success text-success me-2">
                                                    <?php echo $user->getProperty("role"); ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <!-- <a href="#" class="btn btn-sm btn-neutral">View</a> -->
                                                <a href="#<?php echo $user->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-pen"></a>
                                                <a href="#<?php echo $user->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-trash"></a>
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
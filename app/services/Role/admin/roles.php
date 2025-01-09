<?php

use App\entities\Role;
use App\entities\User;

 include_once "./adminHeader.php"; ?>
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
                                    $roles = $crud->getAll("roles");
                                    foreach ($roles as $row) {
                                        $role = new Role;
                                        $role->initiateRole($row->id, $row->name);
                                        ?>

                                        <tr>
                                            <td>
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
                                                    $users = $crud->getAll("users");
                                                    foreach($users as $record){
                                                        if($record->role == $role->getProperty("id")){?>
                                                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                                                <?php echo $record->name ?>
                                                            </span>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>
                                                </a>
                                            </td>
                                            <td class="text-end">
                                                <?php 
                                                    if($role->getProperty("name") != "admin"){?>
                                                        <a href="#<?php echo $role->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-pen"></a>
                                                        <a href="../../../core/config/Crud.php?id=<?php echo $role->getProperty("id"); ?>&action=delete&table=roles" class="btn btn-sm btn-neutral bi-trash"></a>
                                                    <?php }
                                                ?>  
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
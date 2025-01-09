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
                                        <th scope="col">Name</th>
                                        <th scope="col">LastName</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = $crud->getAll("users");
                                    foreach ($users as $record) {
                                        $user = new User;
                                        $role = new Role;
                                        $role_id = $crud->getOne("roles", $record->role)->id;
                                        $role_name = $crud->getOne("roles", $record->role)->name;
                                        $role->initiateRole($role_id, $role_name);
                                        $user->initiateUser($record->id, $record->name, $record->prenom, $record->mail, $record->password, $role);
                                        ?>
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
                                                    <?php 
                                                        if($user->getProperty("role")->getProperty("name") != 1){
                                                            echo $user->getProperty("role")->getProperty("name");
                                                        } else {
                                                            echo "no role";
                                                        }
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <!-- <a href="#" class="btn btn-sm btn-neutral">View</a> -->
                                                <?php 
                                                    if($user->getProperty("role")->getProperty("name") != "admin"){?>
                                                        <a href="#<?php echo $user->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-pen"></a>
                                                        <a href="../../../core/config/Crud.php?id=<?php echo $user->getProperty("id"); ?>&action=delete&table=users" class="btn btn-sm btn-neutral bi-trash"></a>
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
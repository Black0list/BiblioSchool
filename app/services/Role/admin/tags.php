<?php

use App\entities\Book;
use App\entities\Tag;

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
                                        <th scope="col">Title</th>
                                        <th scope="col">Books</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tags = $crud->getAll("tags");
                                    $books = $crud->getAll("books");
                                    foreach ($tags as $row) {
                                        $tag = new Tag;
                                        $book_id = $crud->getOne("books", $row->id)->id;
                                        $book_title = $crud->getOne("books", $row->id)->title;
                                        $book_author = $crud->getOne("books", $row->id)->author;
                                        $book_type = $crud->getOne("books", $row->id)->type;
                                        $book = new Book;
                                        $book->initiateBook($book_id, $book_title, $book_author, $book_type, );
                                        $tag->initiateTag($row->id, $row->name, $book);
                                        ?>

                                        <tr>
                                            <td>
                                                <a class="text-heading font-semibold" href="#">
                                                <?php echo $tag->getProperty("id"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php echo $tag->getProperty("name"); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-heading font-semibold" href="https://www.bytewebster.com/">
                                                <?php 
                                                    foreach($books as $record){
                                                        if($record->type == $tag->getProperty("id")){?>
                                                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                                                <?php echo $record->title ?>
                                                            </span>
                                                        <?php 
                                                        }
                                                    }
                                                ?>
                                                </a>
                                            </td>
                                            <td class="text-end">
                                                <a href="#<?php $tag->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-pen"></a>
                                                <a href="../../../core/config/Crud.php?id=<?php echo $tag->getProperty("id"); ?>" class="btn btn-sm btn-neutral bi-trash"></a>
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
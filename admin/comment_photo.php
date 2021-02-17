<?php /** @noinspection PhpIncludeInspection */
include("includes/header.php");
require_once('includes/Session.php');
require_once('scripts/CommentService.php');

$session = $session ?? null;
$comment_service = $comment_service ?? null;

if (!$session->isSignedIn()) header("Location: login.php");

if (empty($_GET['id'])) {

    header("Location: photo.php");

}
$message = $session->getMessage();

$comments = $comment_service->fetchAllByPid($_GET['id']);


?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->


        <?php include("includes/top_nav.php") ?>


        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->


        <?php include("includes/side_nav.php"); ?>


        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">


        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users

                    </h1>

                    <p class="bg-success"> <?php echo $message; ?></p>


                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Body</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($comments as $comment): ?>

                                <tr>

                                    <td><?php echo $comment->id; ?> </td>

                                    <td><?php echo $comment->author; ?>
                                        <div class="action_links">

                                            <a href="del_comment_photo.php?id=<?php echo $comment->id; ?>">Delete</a>


                                        </div>
                                    </td>


                                    <td><?php echo $comment->body; ?></td>

                                </tr>


                            <?php endforeach; ?>


                            </tbody>
                        </table> <!--End of Table-->


                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
<?php

require_once '../../core/init.php';


$user = new User();
if ($user->isLoggedIn()) {

?>

    <!-- Datatable !-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" />
    <script>
        $(document).ready(function() {
            $('#fatima').DataTable();
        });
    </script>
    <!-- End datatable !-->


    <div class="container m-0 p-0">
        <div class="jumbotron jumbotron-fluid bg-white m-0 p-0">
            <div id="accounttile" class="">

                <div class="card-body text-center">
                    <p class="text-left">
                        Add New Programme Category</p>
                    <?php

                    $username = escape($user->data()->id);
                    $userSyscategory = escape($user->data()->syscategory);
                    $privilege = Db::getInstance()->query("SELECT * FROM `syscategory` WHERE `id` = $userSyscategory");
                    if ($userSyscategory == 1) {
                    ?>
                        <form autocomplete="off">

                            <div class="row">
                                <div class="form-group">
                                    <label for="Category" class="sr-only"> Programme Category</label>
                                    <textarea name="Category" id="Category" class="form-control" cols="50" style="width: 100%" placeholder="Programme Category"></textarea>
                                    <input type="hidden" name="added_by" id="added_by" value="<?php echo $username; ?>" />
                                </div>
                            </div>
                            <div class="row">

                                <div id="submitButton">
                                    <button type="button" id="save" class="btn btn-light">
                                        <span class="fa fa-save"> Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php

                    }

                    ?>
                </div>

            </div>
        </div>
    </div>

<?php

} else {
    $user->logout();
    Redirect::to('../../login/');
}


?>

<script>
    $(document).ready(function(e) {
        $("#save").click(function() {


            let Category = $('#Category').val();
            let added_by = $('#added_by').val();


            $.ajax({
                url: "view/schools/add_programme_server.php",
                method: 'POST',
                data: {

                    'Category': Category,
                    'added_by': added_by,

                },
                success: function(data) {

                    dalert.alert(data);
                    dataTable.ajax.reload();

                },
                error: function(xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }

            });

        });
        e.preventDefault();
    });
</script>
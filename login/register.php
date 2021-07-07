<?php

require_once '../core/init.php';


?>

<script src="../src/assets/ext/jquery.js"></script>
<script src="../src/assets/ext/jquery-1.10.2.min.js"></script>
<script src="../src/assets/ext/jquery-u.js"></script>

<script src="../src/jlib/pop.js"></script>
<script src="../src/jlib/normarizr.js"></script>
<link rel='stylesheet' type="text/css" href="../src/jlib/pop.css" />
<script src="../src/assets/ext/alertdialog.js"></script>

<div class="container">
  <div class="jumbotron jumbotron-fluid pt-1 bg-white">
    <div id="accounttile" class="container">

      <div class="card-body text-center">
        <p class="login-card-description">
          Register a new user account</p>

        <form class="row" autocomplete="off">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstname" class="sr-only">Firstname</label>
              <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First name" />
            </div>
            <div class="form-group">
              <label for="lastname" id="labellastname" class="sr-only">Last name</label>
              <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last name" />
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone" class="sr-only">Phone</label>
              <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone no." />
            </div>

            <div class="form-group">
              <label for="email" class="sr-only">Email</label>
              <input type="text" name="email" id="email" class="form-control" placeholder="Email" />
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="syscategory" id="labelSyscategory" class="sr-only">Privilege</label>
              <select class="form-control" name="syscategory" id="syscategory">
                <option selected>--Select Permission--</option>
                <?php

                $Syscategory = Db::getInstance()->query("SELECT * FROM syscategory");
                foreach ($Syscategory->results() as $Syscategory) {
                ?>
                  <option value="<?php echo $Syscategory->id; ?>"><?php echo $Syscategory->name; ?></option>
                <?php
                }

                ?>
              </select>
            </div>
 
            <div class="form-group">
              <label for="password" class="sr-only"> Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
            </div>
            <div class="form-group">
              <label for="confirm" class="sr-only">Confirm Password</label>
              <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm" />
              <input type="hidden" name="token" id="token" value="<?php echo Token::generate(); ?>" />
            </div>
          </div>
          <div id="submitButton">
            <button type="button" id="save" class="btn btn-light">
              <span class="fa fa-save"> Save</span>
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>



<script>
  $(document).ready(function(event) {
    $("#save").click(function() {

      let firstname = $('#firstname').val();
      let lastname = $('#lastname').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let syscategory = $('#syscategory').val();
      let password = $('#password').val();
      let confirm = $('#confirm').val();
      let token = $('#token').val();

      //alert(firstname + ", " + lastname + ", " + email + "," + phone + ", " + syscategory + ", " + password + ", " + confirm + ", " + token)
      $.ajax({
        url: "register_server",
        method: 'POST',
        data: {

          'firstname': firstname,
          'lastname': lastname,
          'email': email,
          'phone': phone,
          'syscategory': syscategory,
          'password': password,
          'confirm': confirm,
          'token': token

        },
        success: function(data) {

          dalert.alert(data);

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
    event.preventDefault();
  });
</script>
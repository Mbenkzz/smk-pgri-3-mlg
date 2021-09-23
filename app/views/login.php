<!DOCTYPE html>
<!-- saved from url=(0059)https://getbootstrap.com/docs/4.3/examples/floating-labels/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="<?= ASSETS_URL ?>backend/stylesheets/bootstrap.min.css">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="<?= ASSETS_URL ?>backend/stylesheets/floating-labels.css" rel="stylesheet">
  <script type="text/javascript" src="<?= ASSETS_URL ?>backend/scripts/jquery.min.js"></script>
  <script type="text/javascript" src="<?= ASSETS_URL ?>backend/scripts/bootstrap.min.js"></script>
</head>
<body>
  <form class="form-signin" id="form-signin" method="post" action="<?=BASE_URL?>admin-ea/login">
    <div class="text-center mb-4">
      <img class="mb-4" src="<?= ASSETS_URL ?>frontend/images/cropped-ico1-192x192.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    </div>

    <div class="form-label-group">
      <input type="text" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" name="username">
      <label for="inputEmail">Username</label>
    </div>

    <div class="form-label-group">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" name="password">
      <label for="inputPassword">Password</label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>
  <div class="modal fade" id="modal-notification">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-white" id="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          <p id="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script type="text/javascript">
   $('#form-signin').submit(function(event) {
    event.preventDefault();

    $.ajax({
      url: '<?= BASE_URL ?>admin-ea/login',
      type: 'POST',
      data: {
        username: $("#inputEmail").val(),
        password: $("#inputPassword").val()
      },
      success: function(response) {
        var res = eval(`(${response})`);
        showNotification(res.RESULT, res.MESSAGE);
        if(res.RESULT == "success") {
          setTimeout(function(){
            window.location.href = `<?= BASE_URL ?>${res.URL}`;
          }, 1500);
        }
      }
    });
    
  });

   function showNotification(result, message) {
    $('#modal-notification').modal({'backdrop':'static'});
    $(".modal-header").removeClass(`bg-success`);
    $(".modal-header").removeClass(`bg-danger`);
    $(".modal-header").addClass(`bg-${result}`);
    $("#modal-title").text(result == 'danger' ? 'Error' : "Sukses");
    $("#message").text(message);
  }
</script>

</body></html>
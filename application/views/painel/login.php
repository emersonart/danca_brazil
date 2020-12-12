<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login <?=SITE_NAME?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="viewport" content="width=device-width">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <?=link_tag('assets/vendor/fontawesome/css/all.min.css')?>

    <?=link_tag('assets/vendor/bootstrap/css/bootstrap.min.css')?>
<?=link_tag('assets/vendor/paper-dashboard/css/paper-dashboard.css?v=2.0.0')?>
<?=link_tag('assets/css/painel.css')?>
<link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.2/bootstrap-float-label.min.css"/>
<style type="text/css">
  /*
 * Globals
 */

/* Links */
a,
a:focus,
a:hover {
  color: #fff;
}

/* Custom default button */
.btn-secondary,
.btn-secondary:hover,
.btn-secondary:focus {
  color: #333;
  text-shadow: none; /* Prevent inheritance from `body` */
  background-color: #fff;
  border: .05rem solid #fff;
}


/*
 * Base structure
 */

html,
body {
  height: 100%;
  background: url('<?=base_url('assets/images/bg.png')?>');
  background-position: center center;
  background-size: cover;
}
body:after{
  content:  '';
  position: absolute;
  top:0;
  right: 0;
  bottom: 0;
  left: 0;
  background: #2F2B2B;
  opacity: .4;

}

body {
  display: -ms-flexbox;
  display: flex;
  color: #fff;
  z-index: 1;
}

.cover-container {
  max-width: 42em;
  z-index: 2
}


/*
 * Header
 */
.masthead {
  text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
  margin-bottom: 2rem;
}

.masthead-brand {
  margin-bottom: 0;
}

.nav-masthead .nav-link {
  padding: .25rem 0;
  font-weight: 700;
  color: rgba(255, 255, 255, .5);
  background-color: transparent;
  border-bottom: .25rem solid transparent;
}

.nav-masthead .nav-link:hover,
.nav-masthead .nav-link:focus {
  border-bottom-color: rgba(255, 255, 255, .25);
}

.nav-masthead .nav-link + .nav-link {
  margin-left: 1rem;
}

.nav-masthead .active {
  color: #fff;
  border-bottom-color: #fff;
}

@media (min-width: 48em) {
  .masthead-brand {
    float: left;
  }
  .nav-masthead {
    float: right;
  }
}


/*
 * Cover
 */
.cover {
  padding: 0 1.5rem;
}
.cover .btn-lg {
  padding: .75rem 1.25rem;
  font-weight: 700;
}

h1{
  font-size: 2em;
  margin-top: 1em;
}

/*
 * Footer
 */
.mastfoot {
  color: rgba(255, 255, 255, .5);
}
</style>
</head>

<body class="text-center"data-baseurl="<?=base_url();?>">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand"><?=SITE_NAME?></h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="<?=base_url()?>">Voltar ao site</a>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
         
          <div class="card-body">
             <?=form_open(null,['autocomplete'=>'off'])?>
            <div class="card-title">
              <h1>Acessar sistema</h1>
            </div>
            <?=get_msg()?>
           
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" autocomplete="off" class="form-control form-round form-creser" name="login" id="login" placeholder="Usuário">
                <span for="title_to_pt_br">Usuário</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <input type="password" autocomplete="off" class="form-control form-round form-creser" name="password" id="password" placeholder="Senha">
                <span for="title_to_pt_br">Senha</span>
              </label>
            </div>
            
          </div>
          <div class="card-footer">
            <button class="btn btn-success btn-block" type="submit">Acessar</button>
          </div>
          <?=form_close()?>
        </div>
      </div>
    </div>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>Cover template for <a href="https://getbootstrap.com/">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    </div>
  </footer>
</div>




	<!--   Core JS Files   -->
  <script src="<?=base_url('assets/vendor/paper-dashboard/js/core/jquery.min.js');?>"></script>
  <script src="<?=base_url('assets/vendor/paper-dashboard/js/core/popper.min.js');?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <?php /*
  <script src="<?=base_url('assets/vendor/paper-dashboard/js/core/bootstrap.min.js');?>"></script>
    */ ?>
  <script src="<?=base_url('assets/vendor/paper-dashboard/js/plugins/perfect-scrollbar.jquery.min.js');?>"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=base_url('assets/vendor/paper-dashboard/js/paper-dashboard.js?v=2.0.0')?>" type="text/javascript"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

<script type="text/javascript">
  console.log("<?=base_url()?>")
</script>
  
  <script type="text/javascript" charset="utf-8" src="<?=base_url('assets/js/login.js');?>"></script>
	<script type="text/javascript">
        $().ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
	</script>

</body>
</html>
<?php
require_once 'header.php';
?>
<main role="main" class="container text-center">
  <div class="row">
    <div class="col-12 py-5">
      <h1>Buggado</h1>
    </div>
  </div>
  <div class="row py-3">
    <div class="col-12">
      <h4>Cliente cadastrado com sucesso!</h4>
    </div>
  </div>
</main>
<script>
  setTimeout(function() {
    window.location.href = "/";
  }, 5000);
</script>
<?php require_once 'footer.php';?>
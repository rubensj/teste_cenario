<?php
require_once 'header.php';

require_once 'conn.php';

$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
?>
<main role="main" class="container">
  <div class="row">
    <div class="col-12 py-5 text-center">
      <h1>Buggado</h1>
    </div>
  </div>
  <?php if ($result->num_rows > 0) {
    ?>
    <div class="row py-3" style="border-bottom: 1px #000 solid">
    <div class="col-4">
      Nome
    </div>
    <div class="col-4">
      CEP
    </div>
    <div class="col-4">
      Celular
    </div>
  </div><?php
    while($row = $result->fetch_assoc()) {
      ?>
      <div class="row py-3">
    <div class="col-4">
      <?php echo $row['nome']; ?>
    </div>
    <div class="col-4">
      <?php echo $row['cep']; ?>
    </div>
    <div class="col-4">
      <?php echo '('.$row['ddd'].') '.$row['celular']; ?>
    </div>
  </div>
      <?php
    }
  } else {
    echo "Sem resultados";
  }
  $conn->close(); ?>
</main>
<?php require_once 'footer.php';?>
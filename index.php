<?php
require_once 'header.php';

if(isset($_POST['nome'])) {
    // Check name
    if(empty($_POST['nome']) || preg_match('/^[A-ZÀ-Ÿ][A-zÀ-ÿ\']+\s([A-zÀ-ÿ\']\s?)*[A-ZÀ-Ÿ][A-zÀ-ÿ\']+$/m', $_POST['nome']) === 0) {
        $eName= 'Por favor insira um nome válido.';
    }
    // Check CEP
    if(empty($_POST['cep']) || preg_match('/^[0-9]{5}\-[0-9]{3}/', $_POST['cep']) === 0) {
        $eCEP = 'Por favor insira um CEP válido.';
    }
    // Check cellphone number
    if(empty($_POST['celular']) || preg_match('/\([1-9]{2}\) 9[0-9]{4}\-[0-9]{4}/', $_POST['celular']) === 0) {
        $eCel = 'Por favor insira um celular válido.';
    }
    if(!isset($eCel) && !isset($eName) && !isset($eCEP)) {
        require_once 'conn.php';

        $stmt = $conn->prepare('INSERT INTO clientes (nome, cep, ddd, celular) VALUES (?, ?, ?, ?)');
        $stmt->bind_param("ssss", $nome, $cep, $ddd, $cel);

        $phone = explode(' ', $_POST['celular']);

        $nome = $_POST['nome'];
        $cep = $_POST['cep'];
        $ddd = str_replace( array('(', ')'), array('', ''), $phone[0]);
        $cel = $phone[1];

        if ($stmt->execute()) {
            echo "<script>window.location.href = '/success.php'</script>";
            die();
        } else {
          $eDB = 'Algo deu errado. Por favor tente de novo. <!-- Execute failed: (' . $stmt->errno . ') ' . $stmt->error . ' -->';
        }
        $conn->close();
    }
}
?>
<main role="main" class="container">
  <div class="row">
    <div class="col-12 py-5 text-center">
      <h1>Buggado</h1>
    </div>
  </div>
  <div class="row py-3">
    <div class="col-sm-4">
      <p class="d-block d-sm-none">Preencha o formulário abaixo para dacastrar um novo cliente no sistema Buggado.</p>
      <p class="d-none d-sm-block">Preencha o formulário ao lado para dacastrar um novo cliente no sistema Buggado.</p>
    </div>
    <div class="col-sm-8">
      <form id="formAddClient" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group row">
          <label for="inputNome" class="col-sm-2 col-form-label">Nome</label>
          <div class="col-sm-10">
            <input type="text" class="form-control<?php if(isset($eName)) echo ' is-invalid'; ?>" id="inputNome" name="nome" placeholder="Nome completo">
            <div class="invalid-feedback">Por favor, insira um nome válido.</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCEP" class="col-sm-2 col-form-label">CEP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control<?php if(isset($eCEP)) echo ' is-invalid'; ?>" id="inputCEP" name="cep" placeholder="CEP">
            <div class="invalid-feedback">Por favor, insira um CEP válido.</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="inputCel" class="col-sm-2 col-form-label">Celular</label>
          <div class="col-sm-10">
            <input type="tel" class="form-control<?php if(isset($eCel)) echo ' is-invalid'; ?>" id="inputCel" name="celular" placeholder="Celular">
            <div class="invalid-feedback">Por favor, insira um celular válido.</div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 text-center">
            <?php if(isset($eDB)) echo '<div class="invalid-feedback">'.$eDB.'</div>'; ?>
            <button type="submit" class="btn btn-primary col-4">
              Enviar <i class="fas fa-angle-double-right"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<?php require_once 'footer.php';?>
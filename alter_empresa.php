<?php    
	include_once("login/conexao.php");
    $empnome = $_POST['empnome'];
    $empfant = $_POST['empfant'];
    $empcnpj = $_POST['empcnpj'];
    $empie = $_POST['empie'];
    $empend = $_POST['empend'];
    $empnum = $_POST['empnum'];
    $empbai = $_POST['empbai'];
    $empcep = $_POST['empcep'];
    $empcid = $_POST['empcid'];
    $empuf = $_POST['empuf'];
    $emptel = $_POST['emptel'];
    $empmail = $_POST['empmail'];
    $empnfe = $_POST['empnfe'];

    $empnome = strtoupper($empnome);    
    $empfant = strtoupper($empfant);
    $empend = strtoupper($empend);
    $empbai = strtoupper($empbai);
    $empcid = strtoupper($empcid);
    $empuf = strtoupper($empuf);
   
	$alter = "INSERT INTO tbemp (empcod, empcnpj, empend, empnum, empbai, empnome, empfant, empie, empcid, empuf, emptel, empcep, empmail, empnfe) VALUES (1, '$empcnpj', '$empend', '$empnum', '$empbai', '$empnome', '$empfant', '$empie', '$empcid', '$empuf', '$emptel', '$empcep', '$empmail', '$empnfe')
    ON DUPLICATE KEY UPDATE empcnpj = '$empcnpj', empend = '$empend', empnum = '$empnum', empbai = '$empbai', empnome = '$empnome', empfant = '$empfant', empie = '$empie', empcid = '$empcid', empuf = '$empuf', emptel = '$emptel', empcep = '$empcep', empmail = '$empmail', empnfe = '$empnfe'";
	$result = mysqli_query($conexao, $alter);

    header("Location: cad_empresa.php");
?>
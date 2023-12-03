<?php
session_start();
if (!isset($_SESSION['dados']['userLogado'])) {
  header("Location: ../index.php");
}
?>
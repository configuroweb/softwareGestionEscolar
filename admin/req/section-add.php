<?php
session_start();
if (
  isset($_SESSION['admin_id']) &&
  isset($_SESSION['role'])
) {

  if ($_SESSION['role'] == 'Admin') {


    if (isset($_POST['section'])) {

      include '../../DB_connection.php';

      $section = $_POST['section'];

      if (empty($section)) {
        $em  = "Sección es requerida";
        header("Location: ../section-add.php?error=$em");
        exit;
      } else {
        $sql  = "INSERT INTO
                 section (section)
                 VALUES(?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$section]);
        $sm = "Nueva sección creada correctamente";
        header("Location: ../section-add.php?success=$sm");
        exit;
      }
    } else {
      $em = "An error occurred";
      header("Location: ../section-add.php?error=$em");
      exit;
    }
  } else {
    header("Location: ../../logout.php");
    exit;
  }
} else {
  header("Location: ../../logout.php");
  exit;
}

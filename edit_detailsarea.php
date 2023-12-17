<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $settingdetailsarea_id = $_GET['settingdetailsarea_id'];
   $area_id = $_POST['area_id'];
   $details_area = $_POST['details_area'];

   // Query untuk update data ke tabel settingdetails_area
   $query = "UPDATE db_mobile_collection.settingdetails_area SET area_id=?, details_area=? WHERE settingdetailsarea_id=?";
   
   $stmt = $connectionServernew->prepare($query);
   $stmt->bind_param("isi", $area_id, $details_area, $settingdetailsarea_id);

   if ($stmt->execute()) {
      echo json_encode(array('status' => 'success'));
      echo '<script>window.location.href = "settingdetailsarea.php?page=settingdetailsarea";</script>';
      exit();
   } else {
      echo json_encode(array('status' => 'error', 'message' => $stmt->error));
   }

   $stmt->close();
   $connectionServernew->close();
}
?>

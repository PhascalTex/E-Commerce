<?php 
include 'conn.php';
$sql = mysqli_query($conn, "SELECT * FROM `sellers` WHERE `status` = 'pending' ");
$i = 1;
if (isset($_GET['update'])) {
  $id = $_GET['update'];
  $sql = "UPDATE `sellers` SET `status` = 'used' WHERE `ID` = $id";
  if (mysqli_query($conn, $sql)) {
      echo "Status updated successfully.";
  } else {
      echo "Error updating status: " . mysqli_error($conn);
  }

  header("Location: sellerForm.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Seller_Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <h1 class="">Order Form</h1>
    <a class="back" href="index.php">back</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Email</th>
        <th>Items</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_array($sql)):?>
      <tr>
        <td><?= $i++ ?></td>
        <td><input type="text" value="<?= $row['Email'] ?>" readonly></td>
        <td><input type="text" value="<?= $row['items'] ?>" readonly></td>
        <td><input type="text" value="<?= $row['quantity']?>" readonly></td>
        <td><input type="text" value="<?= $row['price'] ?>" readonly></td>
        <td><input type="text" value="<?= $row['status'] ?>" readonly></td>
        <td>
        <button type="button" class="btn btn-danger" onclick="confirmDeletion(<?= $row[0] ?>)">confirm</button> </td>
      </tr>
    <?php endwhile; ?>  
    </tbody>
  </table>
</body>

<script>
function confirmDeletion(rowId) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, validate it!"
  }).then((result) => {
    if (result.isConfirmed) {
      // Perform the action (e.g., redirection)
      window.location.href = `sellerForm.php?update=${rowId}`;
      
      // Optionally show a follow-up success message
      Swal.fire({
        title: "Validated!",
        text: "Your transaction has been validited.",
        icon: "success"
      });
    }
  });
}
</script>
</script>
</html>
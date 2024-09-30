<h3>Releasing List</h3>
<div id="subcontent">
  <table id="data-list">
    <tr>
      <th>#</th>
      <th>Date Sold</th>
      <th>Customer</th>
      <th>Address</th>
      <th>Contact Number </th>
      <th>Status</th>
    </tr>
    <?php
    $count = 1;
    $count = 1;
    if ($release->list_release() != false) {
      foreach ($release->list_release() as $value) {
        extract($value);

    ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><a href="index.php?page=release&action=release&id="><?php echo $rel_date_added ?></a></td>
          <td><?php echo $rel_customer; ?></td>
          <td><?php echo $rel_description; ?></td>
          <td><?php echo $rel_amount; ?></td>
          <td><?php if ($rel_saved == 0) {
                echo "Pending Transaction";
              } else {
                echo "Sold";
              }
              ?>
          </td>
        </tr>
        <tr>
      <?php
        $count++;
      }
    } else {
      echo "No Record Found.";
    }
      ?>
  </table>
  <div class="download-button">	
			<form method="POST" action="reports/xlsx-sales-report.php">
				<button><a><i class="fa fa-download"></i> Excel</a></button>
			</form><form method="POST" action="reports/pdf-sales-report.php">
				<span><button><a><i class="fa fa-download"></i> PDF</a></button></span>
			</form>
		</div>
</div>
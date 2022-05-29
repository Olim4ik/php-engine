<?php
include_once "../includes/connect.php"; $conn_pdo = PDOPgSQL();
include_once "includes/header.php";

$count = 0;
$selectUser = $conn_pdo->prepare("SELECT * FROM users ");
$result1 = $selectUser->execute();
?>
<div class="container">
	<h2>User's Role Setting</h2>
	<p>Here is CRUD for users management:   </p>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>№</th>
			<th>Email</th>
			<th>Status</th>
			<th>Role</th>
			<th>Date</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
		</thead>
		<tbody>


		<?php # ---------------------   Start buffering for Status select -------------------------
        ob_start(); ?>
			<select name="status" id="">
				<?php
				$selectCategory = $conn_pdo->prepare("SELECT * FROM category where status = :status and url = :url");
				$result1 = $selectCategory->execute([':status' => 'active', ':url' => 'list-status.php']);
				while ($status = $selectCategory->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value=""><?= $status['name'] ?></option>
				<?php } ?>
			</select>
		<?php
		$status_select = ob_get_contents();
			ob_end_clean();
		# ---------------------   END buffering for Status select ------------------------- ?>


		<?php # ---------------------   Start buffering for Role select -------------------------
        ob_start(); ?>
            <select name="role" id="">
                <?php
                $selectCategory = $conn_pdo->prepare("SELECT * FROM category where status = :status and url = :url");
                $result = $selectCategory->execute([':status' => 'active', ':url' => 'list-role.php']);
                while ($role = $selectCategory->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value=""><?= $role['name'] ?></option>
                <?php } ?>
            </select>
		<?php
		$role_select = ob_get_contents();
		ob_end_clean();
		# ---------------------   END buffering for Role select ------------------------- ?>

        <?php while ($user = $selectUser->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
		                <?= $status_select ?>
                    </td>
                    <td>
		                <?= $role_select ?>
                    </td>
                    <td><?php echo $user['date']; ?></td>
                    <td><button type="button" class="btn btn-primary" style="padding: 3px 10px">Update</button></td>
                    <td><button type="button" class="btn btn-danger" style="padding: 3px 10px">Delete</button></td>
                </tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php include_once "includes/footer.php"; ?>
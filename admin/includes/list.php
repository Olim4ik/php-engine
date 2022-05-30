<?php
include_once "../includes/connect.php";
include_once "header.php";
$conn_pdo = PDOPgSQL();
$url_full = basename($_SERVER['REQUEST_URI']);
//var_dump($_GET['del']);
if ($_GET['del'] > 0) {
	$deleteCategory = $conn_pdo->prepare("UPDATE category SET status = 'del' WHERE id = :id");
	$result = $deleteCategory->execute([":id" => $_GET['del'],]);
//	header("Location: $url_array");
}
if ($_GET['rec'] > 0) {
	$deleteCategory = $conn_pdo->prepare("UPDATE category SET status = 'active' WHERE id = :id");
	$result = $deleteCategory->execute([":id" => $_GET['rec'],]);
}
$url_array = explode('?', $url_full);
$url = $url_array[0];



if (isset($_POST['name'])) {
	$insertCategory = $conn_pdo->prepare("INSERT INTO category (name, parent_id, url, user_id) VALUES (:name, :parent_id, :url, :user_id)");
	$result = $insertCategory->execute([
		":name" => $_POST['name'],
		":parent_id" => 0,
		":url" => $url,
		":user_id" => $_SESSION['user_id']
	]);
}

?>
<div class="d-flex justify-content-center" style="margin-top: 100px;">
    <div class="col-lg-6">
        <h2>Create list</h2>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter element name" name="name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
        </form>
        <h3>Active data</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
			<?php
                $count = 0;
                $selectCategory = $conn_pdo->prepare("SELECT * FROM category WHERE url = :url and status = :status");
                $result = $selectCategory->execute([":url" => $url, ":status" => "active"]);
                while ($item = $selectCategory->fetch(PDO::FETCH_ASSOC)) {
			?>
            <tr>
                <td><?= ++$count ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><button type="button" class="btn btn-primary" style="padding: 3px 10px"><a href="?edit=<?= $item['id'] ?>" class="nav-link">Update</a></button></td>
                <td><button type="button" class="btn btn-danger" style="padding: 3px 10px"><a href="?del=<?= $item['id'] ?>" class="nav-link">Delete</a></button></td>
<!--                <td><a href="?edit=--><?//= $item['id'] ?><!--">Update</a></td>-->
<!--                <td><a href="?del=--><?//= $item['id'] ?><!--">Delete</a></td>-->
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <h3>Draft data</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
		    <?php
		    $count = 0;
		    $selectCategory = $conn_pdo->prepare("SELECT * FROM category WHERE url = :url and status = :status");
		    $result = $selectCategory->execute([":url" => $url, ":status" => "del"]);
		    while ($item = $selectCategory->fetch(PDO::FETCH_ASSOC)) {
			    ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><button type="button" class="btn btn-primary" style="padding: 3px 10px"><a href="?edit=<?= $item['id'] ?>" class="nav-link">Update</a></button></td>
                    <td><button type="button" class="btn btn-warning" style="padding: 3px 10px"><a href="?rec=<?= $item['id'] ?>" class="nav-link">Recover</a></button></td>
<!--                    <td><a href="?edit=--><?php //echo $item['id']; ?><!--">Update</a></td>-->
<!--                    <td><a href="?rec=--><?php //echo $item['id']; ?><!--">Recover </a></td>-->
                </tr>
		    <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "footer.php" ?>

<?php
include_once "../includes/connect.php"; $conn_pdo = PDOPgSQL();
include_once "includes/header.php";

if ($_POST['user_id'] > 0) {
//	echo '<pre>';
//	var_dump($_POST);
//	echo '</pre>';
    if (isset($_POST['status'])) {
        $updateUser = $conn_pdo->prepare("UPDATE users SET status = :status WHERE id = :id");
        $result = $updateUser->execute([
            ":status" => $_POST['status'],
            ":id" => $_POST['user_id']
        ]);
    }
	if (isset($_POST['role'])) {
		$updateUser = $conn_pdo->prepare("UPDATE users SET role = :role WHERE id = :id");
		$result = $updateUser->execute([
			":role" => $_POST['role'],
			":id" => $_POST['user_id']
		]);
	}
}

$count = 0;
$selectUser = $conn_pdo->prepare("SELECT * FROM users ");
$result1 = $selectUser->execute();
?>
<div class="container">

	<h2>User's Role Setting</h2>
	<p>Here is CRUD for users management. You can Update by clicking select buttons</p>

    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Add User</h2>
                </div>
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" required class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" required class="form-control" id="password" placeholder="Enter password">
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
                    <button type="button" onclick="addUser()" class="btn btn-success submitBtn">Save Changes</button>   <!-- onclick="addUser()" -->
                </div>
            </div>
        </div>
    </div>
    <!--   Add Modal end-->


    <!-- Update Modal-->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Update User Details</h2>
                </div>
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="form-group">
                        <label for="update_email">Email</label>
                        <input type="email" required class="form-control" id="update_email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="update_password">Password</label>
                        <input type="text" required class="form-control" id="update_password" placeholder="Enter password">
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button"  class="btn btn-secondary pull-left" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateUser()" class="btn btn-success submitBtn">Save Changes</button>   <!-- onclick="addUser()" -->
                    <input type="hidden" id="hidden_data">
                </div>
            </div>
        </div>
    </div>
    <!--   Update Modal end-->

    <button id="add_user" type="button"  class="btn btn-success add_user" data-toggle="modal"
            data-target="#exampleModal" style="padding: 3px 10px; margin-left: 1240px; margin-bottom: 20px;">Add</button>

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


        <?php
            $selectCategory = $conn_pdo->prepare("SELECT * FROM category where status = :status and url = :url");
            $result1 = $selectCategory->execute([':status' => 'active', ':url' => 'list-status.php']);
            $status_array = [];
            while ($status = $selectCategory->fetch(PDO::FETCH_ASSOC)) {
                array_push($status_array, $status['name']);
            }
        ?>

        <?php
            $selectCategory = $conn_pdo->prepare("SELECT * FROM category where status = :status and url = :url");
            $result = $selectCategory->execute([':status' => 'active', ':url' => 'list-role.php']);
            $role_array = [];
            while ($role = $selectCategory->fetch(PDO::FETCH_ASSOC)) {
                array_push($role_array, $role['name']);
            }
        ?>

        <?php while ($user = $selectUser->fetch(PDO::FETCH_ASSOC)) {
//	        echo '<pre>';
//	        var_dump($user['id']);
//	        echo '</pre>';
            ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="status" id="" onchange="this.form.submit()">
                                <?php foreach ($status_array as $status) {
                                    $selected = '';
                                    if ($status == $user['status']) {
	                                    $selected = 'selected';
                                    }
                                ?>
                                <option <?= $selected ?>><?= $status ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="role" id="" onchange="this.form.submit()">
		                        <?php foreach ($role_array as $role) {
			                        $selected = '';
			                        if ($role == $user['role']) {
				                        $selected = 'selected';
			                        }
                                ?>
                                    <option <?= $selected ?>><?= $role ?></option>
		                        <?php } ?>
                            </select>
                        </form>
                    </td>
                    <td><?php echo $user['date']; ?></td>
<!--                    <button id="add_user" type="button"  class="btn btn-success add_user" data-toggle="modal"-->
<!--                            data-target="#exampleModal" style="padding: 3px 10px; margin-left: 1240px; margin-bottom: 20px;">Add</button>-->
                    <?= '<td><button type="button" id="edit_user"
                    data-id="'.$user['id'].'" data-target="#updateModal" data-toggle="modal"
                    class="btn btn-primary"  style="padding: 3px 10px">Update</button></td>' ?> <!-- onclick="editUser('.$user['id'].')" -->
                    <td><button type="button" class="btn btn-danger" style="padding: 3px 10px">Delete</button></td>
                </tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php include_once "includes/footer.php"; ?>

<script>
    function addUser() {
        let reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        let email = $('#email').val();
        let password = $('#password').val();
        if(email.trim() === '' ){
            alert('Please enter your email.');
            $('#inputEmail').focus();
            return false;
        } else if(email.trim() !== '' && !reg.test(email)){
            alert('Please enter valid email.');
            $('#inputEmail').focus();
            return false;
        } else if(password.trim() === '' ){
            alert('Please enter your password.');
            $('#inputName').focus();
            return false;
        } else if (password.length < 6) {
            alert('Password length must be at least 6 characters.');
            $('#inputName').focus();
            return false;
        } else {
            $.ajax({
                url: 'add-user.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                beforeSend: function () {
                    $('.submitBtn').attr("disabled","disabled");
                    $('.modal-body').css('opacity', '.5');
                },
                success:function(msg){
                    if(msg === 'ok'){
                        $('#email').val();
                        $('#password').val();
                        $('.statusMsg').html('<span style="color:green;">User added successfully!</p>');
                        location.reload();
                    } else if (msg === 'err_email_exists') {
                        $('.statusMsg').html('<span style="color:red;">User already exists!</span>');
                    } else{
                        $('.statusMsg').html('<span style="color:red;">Some problem occurred, please try again.</span>');
                    }
                    $('.submitBtn').removeAttr("disabled");
                    $('.modal-body').css('opacity', '');
                }
            });
        }
    }

    function editUser(update_id) {
        $('#updateModal').modal('show');

        $('#hidden_data').val(update_id);

        $.post("update-user.php",{update_id:update_id}, function (data, status){
            // console.log(data);
            // console.log(status);
            let user_id = JSON.parse(data);
            $('#update_email').val(user_id.email);
            $('#update_password').val(user_id.password);
        });
    }

    $(document).on("click", "#edit_user",function () {

        let id = $(this).attr('data-id')
        $('#hidden_data').val(id);
        console.log(id);

        $.post("update-user.php",{update_id:id}, function (data, status){
            // console.log(data);
            // console.log(status);
            let user_id = JSON.parse(data);
            $('#update_email').val(user_id.email);
            // $('#update_password').val(user_id.password);
        });
    });

    function updateUser(){
        let update_email = $('#update_email').val();
        let update_password = $('#update_password').val();
        let hidden_data = $('#hidden_data').val();

        $.post('update-user.php', {
            update_email: update_email,
            update_password: update_password,
            hidden_data: hidden_data,
        }, function (data, status) {
            $('#updateModal').modal('hide');
            // location.reload();

        })
    }

</script>

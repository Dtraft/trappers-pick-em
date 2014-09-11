<?php require_once('views/header.php'); ?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <h3>Users</h3>
        <div class='panel panel-default'>
            <div class="panel-body">
                <table class="table">
                  <tr>
                      <th>User</th>
                  </tr>
                  <?php foreach($this->data["users"] as $user): ?>
                  <tr>
                      <td><?php echo $user["name"];?></td>
                  </tr>
                  <?php endforeach?>
                  <tr>
                      <form class="form-inline" role="form" action='/picks/users/new' method='POST'>
                      <td>
                          <div class="form-group">
                            <input name="user" class='form-control' type='text' placeholder='Enter New User' style='width: 300px'>
                          </div>
                          <button type="submit" class="btn btn-primary">Add</button>
                      </td>
                      </form>
                  </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require_once('views/footer.php'); ?>
<?php require_once('views/header.php'); ?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <h3>Standings - <?php echo $this->data["week"];?></h3>
        <div class='panel panel-default'>
            <div class="panel-body">
                <table class="table">
                  <tr>
                      <th>User</th>
                      <th>Correct</th>
                      <th>Wrong</th>
                  </tr>
                  <?php foreach($this->data["users"] as $key=>$value):?>
                  <tr>
                      <td><?php echo $key; ?></td>
                      <td><?php echo $value;?>
                      <td><?php echo $this->data["count"] - $value;?>
                  </tr>
                  <?php endforeach?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require_once('views/footer.php'); ?>
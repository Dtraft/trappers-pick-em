<?php require_once('views/header.php'); ?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <form class="form-inline" role="form" action='/picks/save/<?php echo $this->data["week"]; ?>' method='POST'>
        <h3>
            <?php if($this->data["week"] > 1):?>
                <a class="btn btn-default" href='<?php echo $this->data['week'] - 1;?>'>
                    <span class='glyphicon glyphicon-chevron-left'></span>
                </a>
             <?php endif ?>
            
            Week <?php echo $this->data["week"]; ?> 
            
            <?php if($this->data["week"] < 17):?>
                <a class="btn btn-default" href='<?php echo $this->data['week'] + 1;?>'>
                    <span class='glyphicon glyphicon-chevron-right'></span> 
                </a>
             <?php endif ?>           
            
            <div class='pull-right'>
                <a href="/picks/standings/<?php echo $this->data['week']; ?>" style="font-size: 14px;font-weight:normal;">Standings for this week</a>
                <button type="submit" class="btn btn-primary">Save Pick</button>
            </div>
        </h3>
        <div class='panel panel-default'>
            <div class="panel-body">
                <table class="table">
                  <tr>
                      <th>
                          Away Team
                      </th>
                      <th>
                          @
                      </th>
                      <th>
                          Home Team
                      </th>
                      <?php foreach($this->data["games"][0]["picks"] as $key=>$value):?>
                          <th><?php echo $key;?></th>
                      <?php endforeach;?>
                      <?php if(!isset($this->data["games"][0]["winner"])):?>
                      <td>                          
                        <div class="form-group">
                          <select id="select" class="form-control" style="width: 125px;" name="user">
                              <option>--Select--</option>
                              <?php foreach ($this->data["users"] as $user): ?>
                              <option><?php echo $user["name"];?>
                              <?php endforeach?>
                          </select>
                        </div>
                      </td>   
                      <?php endif ?>         
                  </tr>
                  
                      <?php for($g = 0; $g < count($this->data["games"]); $g++): ?>
                          <?php 
                              $game = $this->data["games"][$g];
                              if($g > 0){
                                  $previous = $this->data["games"][$g - 1];
                              }                              
                          ?>
                          <?php if($g == 0 || $previous["dateTime"] != $game["dateTime"]):?>
                              <tr class="bg-info">
                                  <td colspan="30"><?php echo date("F j, Y, g:i a", $game["dateTime"]->sec)?></td>
                              </tr>
                          <?php endif ?>
                          <tr>
                              <td><?php echo $game["away"]["city"] . " " . $game["away"]["name"]?></td>
                              <td>@</td>
                              <td><?php echo $game["home"]["city"] . " " . $game["home"]["name"]?></td>
                              
                              <?php foreach($game["picks"] as $key=>$value):?>
                                  <?php
                                  if(isset($game["winner"])){
                                      if($game["winner"] === $value){
                                          echo "<td class='bg-success'>" . $value . "</td>";
                                      }else{
                                          echo "<td class='bg-danger'>" . $value . "</td>";
                                      }
                                  }else{
                                      echo "<td>" . $value . "</td>";
                                  }
                                  ?>
                              <?php endforeach;?>      
                              <?php if(!isset($this->data["games"][0]["winner"])):?>                      
                              <td>
                                  <div class="form-group">
                                      <select type="text" class="form-control" style="width: 125px;" name="<?php echo $game["_id"]->{'$id'}; ?>">
                                          <option>--Pick--</option>
                                          <option><?php echo $game["away"]["city"] ?></option>
                                          <option><?php echo $game["home"]["city"] ?></option>
                                      </select>
                                  </div>
                              </td>
                              <?php endif?>
                          </tr>
                      <?php endfor; ?>
                      
                </table>
            </div>
        </div>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>

<?php require_once('views/footer.php'); ?>
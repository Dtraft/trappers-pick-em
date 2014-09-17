<?php require_once('views/header.php'); ?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <form class="form-inline" role="form" action='/picks/save/<?php echo $this->data["week"]; ?>/winners' method='POST'>
        <h3>
            <?php if($this->data["week"] > 1):?>
                <a class="btn btn-default" href='<?php echo $this->data['week'] - 1;?>/assign'>
                    <span class='glyphicon glyphicon-chevron-left'></span>
                </a>
             <?php endif ?>
            
            Week <?php echo $this->data["week"]; ?> 
            
            <?php if($this->data["week"] < 17):?>
                <a class="btn btn-default" href='<?php echo $this->data['week'] + 1;?>/assign'>
                    <span class='glyphicon glyphicon-chevron-right'></span> 
                </a>
             <?php endif ?>           
            
            <div class='pull-right'>
                <button type="submit" class="btn btn-primary">Save Winners</button>
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
                      <th>
                          Winner
                      </th>            
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
                              
                              <?php if(isset($game["winner"]) && $game["winner"] != "--Pick--"):?>
                              <td><?php echo $game["winner"];?></td>
                              <?php else:?>
                             <td>
                                 <div class="form-group">
                                     <select type="text" class="form-control" style="width: 125px;" name="<?php echo $game["_id"]->{'$id'}; ?>">
                                         <option>--Pick--</option>
                                         <option><?php echo $game["away"]["city"] ?></option>
                                         <option><?php echo $game["home"]["city"] ?></option>
                                     </select>
                                 </div>
                             </td>                           
                              <?php endif;?>                            
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
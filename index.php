<?php
require('db.php');
$db = new Database();
$rows = $db->get();
?>
<!DOCTYPE html>
<html>
<head>
   <title>Reloading Log</title>
   <link rel="stylesheet" type="text/css" href="_css/main.css">
</head>
<body>
   <div class="results">
      <?php foreach($rows as $row):?>
         <?php $tmp = (object) $row;?>
         <div class="load">
            <div class="delete"><a href="delete.php?id=<?php echo $tmp->id;?>">x</a></div>
            <h2><?php echo $tmp->caliber; ?> (<?php echo $tmp->bullet;?>) <small><?php echo $tmp->charge; ?> grains<span><?php echo $tmp->CC; ?> CC</span></small></h2>
            <div class="report"><?php echo $tmp->report; ?></div>
         </div>
      <?php endforeach;?>
   </div>

   <form action="add.php" method="post">
      <label>Caliber
         <input type="text" name="caliber" />
      </label>

      <label>Bullet
         <input type="text" name="bullet" />
      </label>

      <label>Charge Weight
         <input type="text" name="charge" />
      </label>

      <label>CC
         <input type="text" name="CC" />
      </label>

      <label>COL
         <input type="text" name="COL" />
      </label>
      <label>Report<textarea type="text" name="report"></textarea>
      </label>
      <input type="submit" />
   </form>

</body>
</html>
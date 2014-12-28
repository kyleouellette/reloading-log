<?php
require('db.php');
$db = new Database();

if(isset($_POST['submit'])){
   $items = array(
      'caliber',
      'bullet',
      'charge',
      'cc',
      'report'
   );

   foreach($items as $i){
      // echo "Set $i=$_POST[$i]";
      $db->update_property($_GET['id'], $i, $_POST[$i]);
   }
}
$rows = $db->get_by_id($_GET['id']);
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
            <form method="post" action="./edit.php?id=<?php echo $_GET[id]; ?>">
               <label>
                  Caliber
                  <input value="<?php echo $tmp->caliber;?>" name="caliber"/>
               </label>
               <label>
                  Bullet
                  <input value="<?php echo $tmp->bullet;?>" name="bullet"/>
               </label>
               <label>
                  Charge
                  <input value="<?php echo $tmp->charge;?>" name="charge"/>
               </label>
               <label>
                  CC
                  <input value="<?php echo $tmp->CC;?>" name="CC"/>
               </label>
               <label>
                  Report
                  <textarea name="report"><?php echo $tmp->report;?></textarea>
               </label>
               <input type="submit" name="submit" value="submit" />
            </form>
         </div>
      <?php endforeach;?>
   </div>



</body>
</html>
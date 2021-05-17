<form method="post" action="">
    <span>Select languages</span><br/>
    <input type="checkbox" name='lang[]' value="PHP"> PHP <br/>
    <input type="checkbox" name='lang[]' value="JavaScript"> JavaScript <br/>
    <input type="checkbox" name='lang[]' value="jQuery"> jQuery <br/>
    <input type="checkbox" name='lang[]' value="Angular JS"> Angular JS <br/>

    <input type="submit" value="Submit" name="submit">
</form>

<?php
if(isset($_POST['submit'])){
$data="name LIKE '";
    if(!empty($_POST['lang'])) {

        // foreach($_POST['lang'] as $value){
        //     $data.="
        //   ".$value."' or name LIKE:'

        //     ";
        // }
// echo  count($_POST['lang']);
    }
    $i=1;
while(count($_POST['lang']) > $i){
         $data.="
          ".$_POST['lang'][$i]."' or name LIKE:'

            ";
            $i++;
}
echo $data;
echo "<br>";
echo substr($data, 0, -30);
}
?>
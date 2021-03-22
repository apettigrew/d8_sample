$donate_amount=array(
     '$5',
     '$10',
     '$25',
     '$50',
     '$100',
 )
<select name = "donate_amount">
<option value=""></option>
<?php
    foreach($donate_amount as $key => $value):
        echo '<option value="'.$key.'">'.$value.'</option>';
    endforeach;
?>
</select>
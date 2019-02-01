
<input name="email" type="text" value="dsadsa" readonly="readonly">
<?php

if(isset($detail_pelanggan)){
    foreach($detail_pelanggan as $row){
        ?>

 

        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input name="email" type="text" value="<?php echo $row['truck_name'];?>" readonly="readonly">
            </div>
        </div>
    <?php
    }
}
?>

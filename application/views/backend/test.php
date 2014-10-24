 <?/* if(isset($records)) : foreach($records as $row) : ?>
    
    <img src="https://graph.facebook.com/<? echo $row->username;?>/picture">
    <?php  ?>
    
    <? endforeach; ?>
    
    <? else : ?>
    <h2> No records returned. </h2>
    <? endif;*/ ?>
    
     <? echo $albums2;
     for($x=0; $x<=20; $x++)
    {
                
    ?><img src="<? echo $photos['data'][$albums2]['photos']['data'][$x]['source'];?>"><? echo "<br>";
    }
     
     ?>
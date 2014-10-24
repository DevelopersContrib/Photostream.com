<pre>
<?

//echo print_r($albums,TRUE);

//echo count($albums['data']);
//echo "<h1>".count($photos['data'])."</h1>";
echo print_r($photos,TRUE);


$pictures = array();
  
    //display the pictures url
echo "<h1>".count($photos['data'])."</h1>";

?><select id="albums2" name="albums2" >
 <? foreach( $albums['data'] as $albums['id']=>$val )
{
    echo"<option value =".$val['id'].">".$val['name']."</option>";
} ?>
</select><?

foreach( $photos['data'] as $val2)
{
    echo $val2['source'];
    echo "<br>";
}





?>
</pre>
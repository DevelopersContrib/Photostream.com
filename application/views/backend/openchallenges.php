<?if($challenges_open->num_rows() > 0):?>
		<style>
            #open-cha-ul{
                margin-left:40px;
            }
            #open-cha-ul > li{
                height: 200px;
                width:400px;
                margin: 10px;
                padding:0;
                box-shadow: 0 0 0 1px #DCDDDE;
                border-radius:3px;
            }
            .box-cont-open{
                /*height:150px;*/
            }
            .wrap-open-box{
                padding:10px;
                margin-bottom:10px;
                height: 125px;
            }
            .image-open{
                background-color: #FFFFFF;
                border: 1px solid #D9DCDD;
                border-radius: 3px;
                box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
                float: right;
                margin: 0 0 5% 5%;
                max-width: 110px;
                padding: 5px;
                width: 40%;
            }
            .image-open img{
                display:block;
                width:100%;
                height: 100px;
                vertical-align:top;
            }
            .header-open{
                word-wrap:break-word;
            }
            .header-open p{
                font-weight:normal;
                color:#5D6266;
            }
            .header-open .ttle-open{
                line-height:normal;
                font-weight:normal;
                font-size:1.5em;
                color: #0088CC;
            }
            .a-link-user{
                text-transform: capitalize;
                font-size: 12px;
            }
            .meta-box{
                border-top:1px solid #EDEEEE;
                color: #9DA6AB;
                padding: 0.875em;
            }
            #ul-meta-box > li{
                text-align: center;
                width:175px;
            }
        </style>
		
		<div class="row-fluid">
                <ul id="open-cha-ul" class="inline">
	<?foreach($challenges_open->result() as $openchall):?>
	<? $name2 = $this->photousers->getinfobyid('firstname',$openchall->userid)." ".$this->photousers->getinfobyid('lastname',$openchall->userid); ?>
                    <li>
                        <div class="box-cont-open">
                            <div class="wrap-open-box">
                                <div class="image-open text-center">
                                    <img src="<? echo $this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$openchall->userid)); ?>">
                                    <a href="/<?=$this->photousers->getinfobyid('username',$openchall->userid)?>" class="a-link-user"><? echo $name2; ?></a>
                                </div>
                                <div class="header-open">
                                    <h3 class="ttle-open ellipsis">
                                        <a href="<?=base_url()?>challenges/info/<?=$openchall->challenge_id?>"><?=$openchall->title?></a>
                                    </h3>
                                    <p class=""><?  
											$string = $openchall->description;

											if (strlen($string) > 120) {

												$stringCut = substr($string, 0, 120);

												$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
											}
											echo $string;
									?></p>
                                </div>
                            </div>
                            <div class="meta-box">
                                <ul id="ul-meta-box" class="inline">
                                    <li>
                                       <i class="icon-calendar"></i>
                                      <? echo date("M d, Y", strtotime($openchall->date_posted)); ?>
                                    </li>
                                    <li>
                                        <i class="icon-check"></i>
										<? 
										
											$challenge_submission  = $this->photosubmissions->getbyattribute('challenge_id',$openchall->challenge_id);
										
										?>
                                        <? echo $challenge_submission->num_rows(); ?> <? if($challenge_submission->num_rows() == 1){ echo "submission"; } else{ echo "submissions"; } ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </li>
		
	<?endforeach;?>
	</ul>
</div>
<?else:?>
	<p>There are no open challenges.</p>
<?endif;?>
<ul class="news-items">
<?foreach($challenges_open->result() as $openchall):?>
   <li>
           <div class="span2" style="text-align:center;">
                   <span class="meta-blogstyle-date" style="font-size: 35px;font-weight: 700;padding: 6px 0 0;width: 30%;color: #959595;"><img src="<?=$this->photopics->getinfobyid('filename',$this->photousers->getinfobyid('avatar_id',$openchall->userid))?>"></span></br>

                   <span class="meta-blogstyle-year" style="font-size: 9px;font-weight: 700;letter-spacing: 1.5px;padding-top: 0;text-transform: uppercase;width: 100%;color: #959595;"><a href="/<?=$this->photousers->getinfobyid('username',$openchall->userid)?>"><?=$this->photousers->getinfobyid('firstname',$openchall->userid)?></a></span>
           </div>
           
           <div class="news-item-detail">										
                   <a href="<?=base_url()?>challenges/info/<?=$openchall->challenge_id?>" class="news-item-title"><?=$openchall->title?></a>
                   <p class="news-item-preview"> <?=$openchall->description?> </p>
           </div>
           
           <div class="news-item-date">
                   <span class="news-item-day"></span>
                   <span class="news-item-month"></span>
           </div>
   </li>
   <?endforeach;?>
</ul>
<?php

require_once(dirname(__FILE__) . '/config.php');

 class DIR_LIB {

     function ShowDomains($categoryid,$limit=''){

            if(!empty($limit)){

                $limit = " LIMIT $limit ";

            }

           $result = mysql_query("SELECT * FROM `domain` where category_id=$categoryid order by id DESC $limit");

        if (!$result){

           $returnValue = mysql_error();

        }else {

            $html = "";

            while($row = mysql_fetch_array($result)){

              $html .= "<li><a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li>";

            }  

        }

       return $html;

     }

     function ShowDomains2($categoryid,$limit=''){

            if(!empty($limit)){

                $limit = " LIMIT $limit ";

            }

           $result = mysql_query("SELECT * FROM `domain` where category_id=$categoryid order by id DESC $limit");

        if (!$result){

           $returnValue = mysql_error();

        }else {

            /*$html = "";

            while($row = mysql_fetch_array($result)){

              $html .= "<li><a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li>";

            }  */

            $data='';

            $c = 1;

            while($row = mysql_fetch_array($result)){   			

                $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

                            "<a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a>".

                    '</div>';

                $c++;

                if($c>3){

                     $data = '<div class="row-holder" >'.$data.'</div>';

                     $c=1;

                }

            }

            $returnValue = $data;

        }

       return $returnValue;

     }

	 function ShowDomainsCount($categoryid){

	 $result = mysql_query("SELECT count(*) as total FROM `domain` where category_id=$categoryid");

        if (!$result){

           $returnValue = mysql_error();

        }else {

            $count = 0;

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

       return $count;

     }

     function ShowCategories(){

         $result = mysql_query("SELECT * FROM `category` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $i=1;

           $html = '

           <div class="row-holder">

           ';

            while($row = mysql_fetch_array($result)){

              $html .= "

              <div style=\"padding-left: 20px; width: 27%; padding-right: 40px;\" class=\"col-1\">

              <h3>".$row['name']."</h3>";

              $html .= "<ul class=\"cat-list\">".$this->ShowDomains($row['id'],5)."</ul>"; 

              $mod = $i % 3;

              $html .= "</div>";

              if (($mod)==0){

                   $html .= "</div>

                             <div class=\"row-holder\">

                             ";

               }

              $i++;

            }  

           $html .= "</div></div>"; 

           $returnValue = $html;

        }

        return $returnValue;

     }

     function ShowCategoriesList(){

         $result = mysql_query("SELECT * FROM `category` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $i=1;

           $html = '

           <div class="row-holder" style="width:115%;">

           ';

            while($row = mysql_fetch_array($result)){

              $html .= "

              <div style=\"padding-left: 1px; width: 25%; padding-right: 0px;\" class=\"col-1\">

              <h3><a href='browse.php?category=".$row['id']."&catname=".$row['name']."'>".$row['name']."</a></h3>";

              $html .= "<ul class=\"cat-list\">".$this->ShowDomains($row['id'],5)."</ul>"; 

              $mod = $i % 3;

              $html .= "</div>";

              if (($mod)==0){

                   $html .= "</div>

                             <div class=\"row-holder\" style=\"width:115%;\">

                             ";

               }

              $i++;

            }  

           $html .= "</div>"; 

           $returnValue = $html;

        }

        return $returnValue;

     }

          function ShowCategoriesList2(){

         $result = mysql_query("SELECT * FROM `category` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $i=1;

           $html = '

           <div class="row-holder" style="width:115%;">

           ';

            while($row = mysql_fetch_array($result)){

              $html .= "

              <div style=\"padding-left: 1px; width: 21%; padding-right: 0px;\" class=\"col-1\">

              <h3><a href='browse.php?category=".$row['id']."&catname=".$row['name']."'>".$row['name']."</a></h3>";

              //$html .= "<ul class=\"cat-list\">".$this->ShowDomains($row['id'],5)."</ul>"; 

              $mod = $i % 4;

              $html .= "</div>";

              if (($mod)==0){

                   $html .= "</div>

                             <div class=\"row-holder\" style=\"width:115%;\">

                             ";

               }

              $i++;

            }  

           $html .= "</div>"; 

           $returnValue = $html;

        }

        return $returnValue;

     }

     function ShowSelectContactCategory(){

        $result = mysql_query("SELECT * FROM `contact_category` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $html = "<select name='category'>";

           $html .= "<option value=\"\">Select Category</option>";

            while($row = mysql_fetch_array($result)){

                if ($row['id']==$catid){

                  $sel = "selected";

                } else {$sel="";}

              $html .= "<option value=\"".$row['id']."\" $sel>".$row['name']."</option>";

            }

           $html .= "</select>";

           $returnValue = $html;

        }

    return $returnValue;

    }

	function ShowSelectCategory($catid = null){

      $result = mysql_query("SELECT * FROM `category` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $html = "<select name='category'>";

           $html .= "<option value=\"\">Select Category</option>";

            while($row = mysql_fetch_array($result)){

                if ($row['id']==$catid){

                  $sel = "selected";

                } else {$sel="";}

              $html .= "<option value=\"".$row['id']."\" $sel>".$row['name']."</option>";

            }  

           $html .= "</select>"; 

           $returnValue = $html;

        }

    return $returnValue;

    }

    function ShowSelectAdsType(){

        $result = mysql_query("SELECT * FROM `ads_type` order by name");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $html = "<select name='adstype'>";

           $html .= "<option value=\"\">Select Ads Type</option>";

            while($row = mysql_fetch_array($result)){

                if ($row['id']==$catid){

                  $sel = "selected";

                } else {$sel="";}

              $html .= "<option value=\"".$row['id']."\" $sel>".$row['name']."</option>";

            }

           $html .= "</select>";

           $returnValue = $html;

        }

    return $returnValue;

    }

     function GetDomainIdByName($domainName){

		if (!empty($domainName)){

           $result = mysql_query("SELECT * FROM domain WHERE domain_name='$domainName'");

           if (!$result){

             $returnValue = mysql_error();

           }else {

			while($row = mysql_fetch_array($result)){

				$returnValue = $row['id'];

			}

           }

         }else {

            $returnValue = "-1";

         }

      return $returnValue;

	}

	function GetUserInfo($field1,$field2,$value){

		       $result = mysql_query("SELECT `$field1` as val FROM users WHERE `$field2`='$value'");

           if (!$result){

             $returnValue = mysql_error();

           }else {

			while($row = mysql_fetch_array($result)){

				$returnValue = $row['val'];

			}

           }

      return $returnValue;

	}

	 function SearchCount($str){

	 $result = mysql_query("SELECT count(*) as total  FROM domain, category WHERE (domain_name like'%$str%' OR description like '%$str%')

                    and (domain.category_id = category.id)");

        if (!$result){

           $returnValue = mysql_error();

        }else {

            $count = 0;

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

       return $count;

     }

     function Search($str='', $limit=''){

        if (!empty($str)){

			if(!empty($limit)){

                $limit = " LIMIT $limit ";

            }

            $result = mysql_query("SELECT domain.*,category.name, category.id cat_id  FROM domain, category WHERE (domain_name like'%$str%' OR description like '%$str%')

                    and (domain.category_id = category.id) order by domain_name asc $limit");

            if (!$result){

                $returnValue = mysql_error();

            }else {

                $data='';

                $c = 1;

                while($row = mysql_fetch_array($result)){

                    $domainName = $row['domain_name'];

                    $description = $row['description'];

					$catname = $row['name'];

					$cat_id = $row['cat_id'];

                    if ($_SESSION['userid']!=""){

                    $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

                        "<h3><a href='domainpage.php?domain=$domainName' style='color:black;'>$domainName</a></h3>".

                            '<ul class="cat-list">'.

                                '<li><a href="browse.php?category='.$cat_id.'&catname='.$catname.'">Category '.$catname.'</a></li>'.

							              '</ul>'.

                        '</div>';

                     }else {

                       $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

                        "<h3><a href='domainlander.php?domain=$domainName' style='color:black;'>$domainName</a></h3>".

                            '<ul class="cat-list">'.

                                '<li><a href="browse.php?category='.$cat_id.'&catname='.$catname.'">Category '.$catname.'</a></li>'.

							              '</ul>'.

                        '</div>';

                     }   

                    $c++;

                    if($c>3){

                         $data = '<div class="row-holder" >'.$data.'</div>';

                         $c=1;

                    }

                }

                if ($data== "") $data = "<h2>No Records Found</h2>";

                $returnValue = $data;

            }

        }else {

            $returnValue = "-1";

        }

        return $returnValue;

    }

	function SearchAdvance($domainname='', $limit='', $description='', $category='', $searchby='', $sortby='',$page=''){

        $str = '';

		if($domainname!='')

			$str = " domain_name like '%$domainname%' ";

		if($description != ''){

			if($str!='') $str .= ' OR ';

			$str .= " description like '%$description%' ";

		}

		if($str!='') $str = '( '.$str.' ) ';

		if($category != ''){

			if($str!='') $str .= ' AND ';

			$str .= "  (category.id = '$category') ";

		}

		if($str!='') $str .= 'and';

		if(!empty($limit)){

			$limit = " LIMIT $limit ";

		}

		if($searchby=='Categories' && $category!=''){

			$orderBy = ' name ';

			$sql = "SELECT domain.*,category.name, category.id as cat_id FROM domain, category WHERE $str 

                    (domain.category_id = category.id) order by $orderBy $sortby, domain_name $sortby $limit";

            //echo $sql; //die();

			$result = mysql_query($sql);

	        if (!$result){

	           $returnValue = mysql_error();

	        }else {

	            $data='';

	            $c = 1;

	            while($row = mysql_fetch_array($result)){   			

					$catname = $row['name'];

	                if ($_SESSION['userid']!=""){

                  $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

	                            "<a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a>".

	                    '</div>';

	                }else {

                   $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

	                            "<a href=\"domainlander.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a>".

	                    '</div>';

                  }    

	                $c++;

	                if($c>3){

	                     $data = '<div class="row-holder" >'.$data.'</div>';

	                     $c=1;

	                }

	            }

				if ($data== "") $data = "<h2>No Records Found</h2>";

				$returnValue=$data;

				if($page<2) $returnValue = "<h3>".$catname."</h3><br>".$data;

				$sql = "SELECT count(*) as total FROM domain, category WHERE $str 

                    (domain.category_id = category.id) ";

				//echo $sql; die();

				$result = mysql_query($sql);

				$count = 0;

	            while($row = mysql_fetch_array($result)){

	              $count = $row['total'];

	            }

				if($count>30){

					$returnValue = $returnValue."<span class=\"more\"><a id='$page' class='advance-more' href='#'><b><i>More...</i></b></a></span>

						<INPUT TYPE='hidden' id='advance-count' value='$count'>";

				}

	        }

		}else if($searchby=='Categories' && $category==''){

			$sql = "SELECT * FROM `category` order by name $sortby";

			$i=1;

           $html = '<div class="row-holder" style="width:115%;">';

           //echo $sql; die();

			$result = mysql_query($sql);

			$num_rows = 0;

            while($row = mysql_fetch_array($result)){

				$doms = $this->ShowDomainsWithFilter($row['id'], $domainname, 5, $description, $category, $searchby, $sortby); 

				if($doms!=''){

	              $html .= "

	              <div style=\"padding-left: 1px; width: 25%; padding-right: 0px;\" class=\"col-1\">

	              <h3><a href='browse.php?category=".$row['id']."&catname=".$row['name']."'>".$row['name']."</a></h3>";

	              //$html .= "<ul class=\"cat-list\">".$doms."</ul>"; 

				  $html .= "<ul class=\"cat-list\"></ul>"; 

	              $mod = $i % 3;

	              $html .= "</div>";

	              if (($mod)==0){

	                   $html .= "</div>

	                             <div class=\"row-holder\" style=\"width:115%;\">

	                             ";

	               }

	              $i++;

				  $num_rows++;

			  }

            }  

           $html .= "</div>"; 

		   if($num_rows<1) $html = "<h2>No Records Found</h2>";

           $returnValue = $html;

		}else{

			$orderBy = ' domain_name ';			

			$sql = "SELECT domain.*,category.name, category.id as cat_id FROM domain, category WHERE $str 

                     (domain.category_id = category.id) order by $orderBy $sortby $limit";

            //echo $sql; die();

			$result = mysql_query($sql);

            if (!$result){

                $returnValue = mysql_error();

            }else {

                $data='';

                $c = 1;

                while($row = mysql_fetch_array($result)){

                    $domainName = $row['domain_name'];

                    $description = $row['description'];

					$catname = $row['name'];

					$cat_id = $row['cat_id'];

                    if ($_SESSION['userid']!=""){

                    $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

                        "<h3><a href='domainpage.php?domain=$domainName' style='color:black;'>$domainName</a></h3>".

                            '<ul class="cat-list">'.

                                '<li><a href="browse.php?category='.$cat_id.'&catname='.$catname.'">Category '.$catname.'</a></li>'.

					                  '</ul>'.

                        '</div>';

                     }else {

                     $data .='<div style="padding-left: 1px; width: 33%; padding-right: 0px;" class="col-1">'.

                        "<h3><a href='domainlander.php?domain=$domainName' style='color:black;'>$domainName</a></h3>".

                            '<ul class="cat-list">'.

                                '<li><a href="browse.php?category='.$cat_id.'&catname='.$catname.'">Category '.$catname.'</a></li>'.

					                  '</ul>'.

                        '</div>';

                     }   

                    $c++;

                    if($c>3){

                         $data = '<div class="row-holder" >'.$data.'</div>';

                         $c=1;

                    }

                }

                if ($data== "") $data = "<h2>No Records Found</h2>";

                $returnValue = $data;

				$sql = "SELECT count(*) total FROM domain, category WHERE $str 

                     (domain.category_id = category.id)  ";

				//echo $sql; die();

				$result = mysql_query($sql);

				$count = 0;

	            while($row = mysql_fetch_array($result)){

	              $count = $row['total'];

	            }

				if($count>30){

		            $returnValue = $returnValue."<span class=\"more\"><a id='$page' class='advance-more' href='#'><b><i>More...</i></b></a></span>

						<INPUT TYPE='hidden' id='advance-count' value='$count'>";

				}

            }

		}

        return $returnValue;

    }

	 function ShowDomainsWithFilter($catid = '', $domainname='', $limit='', $description='', $category='', $searchby='', $sortby=''){

			if($domainname!='')

				$str = " domain_name like '%$domainname%' ";

			if($description != ''){

				if($str!='') $str .= ' OR ';

				$str .= " description like '%$description%' ";

			}

			if($str!='') $str = '( '.$str.' ) ';

			if($category != ''){

				if($str!='') $str .= ' AND ';

				$str .= "  (category.id = '$category') ";

			}

			if($str!='') $str .= 'and';

			if(!empty($limit)){

				$limit = " LIMIT $limit ";

			}

           $orderBy = ' domain_name ';			

			$sql = "SELECT domain.*,category.name, category.id as cat_id FROM domain, category WHERE $str 

                     (domain.category_id = category.id and category.id  = '$catid') order by $orderBy $sortby $limit";

            //echo $sql; die();

			$result = mysql_query($sql);

        if (!$result){

           $returnValue = mysql_error();

        }else {

            $html = "";

            while($row = mysql_fetch_array($result)){

              if ($_SESSION['userid']!=""){

              $html .= "<li><a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li>";

              }else {

              $html .= "<li><a href=\"domainlander.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li>";

              }   

            }  

            $returnValue =  $html ;

        }

       return $returnValue;

     }

    function ShowLatestSites($limit){

         $result = mysql_query("SELECT * FROM `domain` order by id DESC LIMIT $limit");

        if (!$result){

           $returnValue = mysql_error();

        }else {

           $i=1;

             $html = "<div class=\"col-1\"><ul>";

            while($row = mysql_fetch_array($result)){

              if ($_SESSION['userid']!=""){

              $html .= "<li><a href=\"domainpage.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li> ";

              }else {

              $html .= "<li><a href=\"domainlander.php?domain=".$row['domain_name']."\">".$row['domain_name']."</a></li> ";

              }   

              $mod = $i % 6;

              if (($mod)==0){

                   $html .= "</ul>

                              </div> 

                             <div class=\"col-1\"><ul>

                             ";

               }

              $i++;

            }  

           $html .= "</ul></div>"; 

           $returnValue = $html;

        }

        return $returnValue;

    }

    function ShowFeaturedSlider($limit){

         $result = mysql_query("SELECT * FROM `domain` where featured='1' order by rand() LIMIT $limit");

        if (!$result){

           $returnValue = mysql_error();

        }else {

            $html = "";

             while($row = mysql_fetch_array($result)){

                $html .= '<div class="slide-scroll">

    	<div class="slide-pic">

       		  <img src="http://www.domaindirectory.com/thumbalizr/index.php?url=http://www.'.$row['domain_name'].'" width="300" height="220" alt=" " /></div>

    	<div class="slide-info">

        	<h2>'.$row['domain_name'].'</h2>

            <p>'.$row['description'].'</p>

 			<a class="button">View Site</a>

        </div>

    </div><!--slide-scroll -->'; 

             }  

           $returnValue = $html;

        }

        return $returnValue;

    }

	function GetAdminData($format='array',$id=''){

		$adminId = '';

		if($id!='') $adminId = " where id = $id ";

		$result = mysql_query("select * from admin ".$adminId);

		if (!$result){

			$returnValue = mysql_error();

		}else {

			 $admin = array();

			  if(mysql_num_rows($result)) {

				while($admin = mysql_fetch_assoc($result)) {

				  $data[] = $admin;

				}

			  }

			if($format == 'json')

				return json_encode(array('admin'=>$data));

			else

				return $data;

		}

	}

	function SaveContact($domain_id,$bid_price,$contact_category_id,$message,$userid){

		$returnValue = '';

		$result = mysql_query("Insert into contact (domain_id,bid_price,contact_category_id,message,date_sent,userid) Values 

			('$domain_id','$bid_price','$contact_category_id','$message',NOW(),'$userid')");

		if (!$result){

			$returnValue = mysql_error();

		}else {

			$returnValue = "success";

		}

		return $returnValue;

	}

    function SaveAds($domain_id,$bid_price,$ads_type_id,$message,$userid){

		$returnValue = '';

		$result = mysql_query("Insert into ads (domain_id,bid_price,ads_type_id,message,date_sent,userid) Values

			('$domain_id','$bid_price','$ads_type_id','$message',NOW(),'$userid')");

		if (!$result){

			$returnValue = mysql_error();

		}else {

			$returnValue = "success";

		}

		return $returnValue;

	}

	 function SaveDomain($domain,$category,$price,$description,$featured){

         if (!empty($domain)||!empty($category)){

           $result = mysql_query("Insert into domain (domain_name,category_id,pricing,description,featured) Values ('$domain','$category','$price','".mysql_escape_string(trim($description))."','$featured')");

           if (!$result){

             $returnValue = mysql_error();

           }else {

             $returnValue = "Domain successfully added!";

           }

         }else {

            $returnValue = "Domain or Category should not be empty!";   

         }

      return $returnValue;

    }

    function GetDomainInfo($field,$domain_name){

		$returnValue ='';

        $result = mysql_query("SELECT `$field` as val FROM `domain` where domain_name = '$domain_name'");

        if (!$result){

           $returnValue = mysql_error();

        }else {

         while($row = mysql_fetch_array($result)){

              $returnValue = $row['val'];

         }

     }

     return $returnValue;

    }

	function GetCategoryName($catid){

         $result = mysql_query("SELECT name FROM `category` where id = '$catid'");

        if (!$result){

           $returnValue = mysql_error();

        }else {

         while($row = mysql_fetch_array($result)){

              $returnValue = $row['name'];

         }

     }

     return $returnValue;

    }

    function GetAppraisalDomain($domain){

        $res = file_get_contents("http://www.valuate.com/$domain");

	       $pattern = "/<span style=\" font-size: 22px;font-weight: bold;color=darkgreen\">(.*?)<\/span>/i";

          preg_match($pattern, $res, $matches);

         	if(count($matches) >= 1)

					{

					$app = trim($matches[1]);

					}else {

          $app = "$ 0.00"; 

          }	

       return $app;

    } 

  function generateCode($length=9, $strength=0) {

	$vowels = 'aeuy';

	$consonants = 'bdghjmnpqrstvz';

	if ($strength & 1) {

		$consonants .= 'BDGHJLMNPQRSTVWXZ';

	}

	if ($strength & 2) {

		$vowels .= "AEUY";

	}

	if ($strength & 4) {

		$consonants .= '23456789';

	}

	if ($strength & 8) {

		$consonants .= '@#$%';

	}

	$password = '';

	$alt = time() % 2;

	for ($i = 0; $i < $length; $i++) {

		if ($alt == 1) {

			$password .= $consonants[(rand() % strlen($consonants))];

			$alt = 0;

		} else {

			$password .= $vowels[(rand() % strlen($vowels))];

			$alt = 1;

		}

	}

	return $password;

}

 function SendActivationLink($email,$code,$domain=null){

    	$subject = "New domaindirectory.com account verification";

			$mailbody="";

			$mailbody.="<table width='600' cellspacing='0' cellpadding='0' class='tableborder' align='center'>";

			$mailbody.="<tr><td>&nbsp;</td></tr>";

			$mailbody.="<tr><td>";

			$mailbody.="<table width='98%' border='0' align='center'>";

			$mailbody.="<tr class='mtext'><td>&nbsp;</td></tr>";

			$mailbody.="<tr class='mtext'><td>This is the verification e-mail for your DomainDirectory.com account.</td></tr>";

			$mailbody.="<tr class='mtext'><td>Please click on the link below to verify your e-mail address:</td></tr>";

			$mailbody.="<tr class='mtext'><td>&nbsp;</td></tr>";

			$mailbody.="<tr class='mtext'><td><a href='http://www.domaindirectory.com/domainlander.php?step=step2b&code=$code&email=$email&domain=$domain'>Activation Link</a></td></tr>";

			$mailbody.="<tr class='mtext'><td>&nbsp;</td></tr>";

			$mailbody.="<tr class='mtext'><td>Regards,</td></tr>";

			$mailbody.="<tr class='mtext'><td>DomainDirectory.com Team</td></tr>";

			$mailbody.="</table></td></tr>";

			$mailbody.="<tr><td>&nbsp;</td></tr>";

			$mailbody.="</table></body></html>";

			$headers = "MIME-Version: 1.0\r\n";

			$headers .= "Content-type: text/html\r\n";

			$headers .= "From: DomainDirectory.com <info@ecorp.com>\r\n"; //optional headerfields 

     	mail($email, $subject, $mailbody, $headers);

 }

 function CheckEmailExist($email){

    $result = mysql_query("SELECT count(*) as total from users where email = '$email'");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

      if ($count>0){

         $returnValue = TRUE; 

      } else {

          $returnValue = FALSE;

      }  

   return $returnValue;

 }

 function CheckFBExist($fbid){

    $result = mysql_query("SELECT count(*) as total from users where firstname = '$fbid'");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

      if ($count>0){

         $returnValue = TRUE; 

      } else {

          $returnValue = FALSE;

      }  

   return $returnValue;

 }

 function SaveUser($firstname,$lastname,$company,$phone,$email,$password,$domain=null){

    $code = $this->generateCode();

		$returnValue = '';

		$result = mysql_query("Insert into users (firstname,lastname,company,phone,email,password,activation_code) Values 

			('$firstname','$lastname','$company','$phone','$email','$password','$code')");

		if (!$result){

			$returnValue = mysql_error();

		}else {

		   if (!$domain){

		     $domain = $this->GenerateDomainOffer();

       }

		   $this->SendActivationLink($email,$code,$domain);

     	$returnValue = "success";

		}

		return $returnValue;

	} 	

  function SaveUserFB($firstname){

   	$returnValue = '';

		$result = mysql_query("Insert into users (firstname,activated) Values 

			('$firstname','1')");

		if (!$result){

			$returnValue = mysql_error();

		}else {

	  	$returnValue = mysql_insert_id();

		}

		return $returnValue;

	}

 function ValidateCode($email,$code){

    $result = mysql_query("SELECT id from users where email = '$email' AND activation_code='$code' AND activated='0' ");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $id = $row['id'];

            }  

        }

     $result = mysql_query("Update users set activated='1' where id = $id");

     if (!$result){

        $returnValue = mysql_error();

     }else {

        $returnValue = "success";

     } 

   return $returnValue;

 }

 function CheckValidationCode($email,$code){

     $result = mysql_query("SELECT count(*) as total from users where email = '$email' AND activation_code='$code' AND activated='0' ");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

      if ($count>0){

         $returnValue = TRUE; 

      } else {

          $returnValue = FALSE;

      }  

   return $returnValue;

   }

 function GenerateDomainOffer(){

     $result = mysql_query("SELECT * FROM `domain` order by rand() LIMIT 1");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $domain = $row['domain_name'];

            }  

            $returnValue = $domain;

        }

   return $returnValue;

   }

  function CheckLoginAccount($email,$password){

    $result = mysql_query("SELECT count(*) as total from users where email = '$email' AND password='$password' AND activated='1' ");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

      if ($count>0){

         $returnValue = TRUE; 

      } else {

          $returnValue = FALSE;

      }  

   return $returnValue;

   }  

  function GetUserData($field,$selfield1,$value1){

    $result = mysql_query("SELECT `$field` as val from users where `$selfield1` = '$value1'");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $val = $row['val'];

            }  

           $returnValue = $val;

        }

   return $returnValue;

   }  

   function CountOfferReplies($conid){

     $result = mysql_query("SELECT count(*) as count FROM `contact_comments` where contact_id = '$conid'");

             while($row = mysql_fetch_array($result)){

               $count = $row['count'];

            }

       return $count;

  }

   function ShowContactOffer($userid){

	   $browser_search_results = 20;

       $prev_page_allowance = 3;

       $next_page_allowance = 5;

       $offset = $_REQUEST['offset'];

       $orderby = $_REQUEST['orderby'];

       $col = $_REQUEST['col'];

       if(!empty($orderby))$orderby = "order by $col $orderby";

       if (empty($offset)){

          $offset = 0;

       }

        if($offset < 0){

        $offset = 0;

        }

        $sql = "SELECT domain.domain_name, contact.*,contact.id conid,contact_category.name cat_name FROM contact, `domain`,`contact_category` where contact.domain_id = domain.id and `contact`.contact_category_id =`contact_category`.id and contact.userid=$userid $orderby";

        $result = mysql_query($sql);

        $search_total = mysql_num_rows($result);

        if (isset($_REQUEST['cmdSearch'])){

           $query = "SELECT domain.domain_name, contact.*,contact.id conid,contact_category.name cat_name FROM contact, `domain`,`contact_category` where contact.domain_id = domain.id and `contact`.contact_category_id =`contact_category`.id and contact.userid=$userid "; 

          //$query .= "order by contact.date_sent desc";

          $query .= " $orderby ";

          $result = mysql_query($query);

          $search_total = mysql_num_rows($result);

          $result = mysql_query($query." LIMIT $offset, $browser_search_results");

        }else {

        $result = mysql_query("$sql LIMIT $offset, $browser_search_results");

        }  

        if (!$result){

           $returnValue = mysql_error();

        }else {

          if(($offset - $browser_search_results) > $search_total) {

            $offset = $search_total - $browser_search_results;

            }  else {

            $offset = $offset - ($offset % $browser_search_results);

           }

            $page = "<div class=\"form-event-header\">";

            $page .= "<div class=\"result-left\"><h4>Results: <span>$search_total Offer Found</span></h4></div>";

            $page .= "<div class=\"pagging\">";

                      $page .= "<a class=\"pagging page\" href=\"manage.php?offset=0&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\">first</a>&nbsp;&nbsp;";

            $i = ($offset / $browser_search_results);

            $j = $i + $next_page_allowance + 1;

            $i = $i - $prev_page_allowance;

            if($i <= 0) {

                $i = 0;

            } else {

                $page .= "";

            }

            while (($i * $browser_search_results) < $search_total) {

                if($offset == ($i * $browser_search_results)) {

                     $page .= "<a class=\"active\" href=\"#\">";

                    $page .= ($i+1);

                    $page .= "</a> "; 

                } else {

                    if($i < $j) {

                        $page .= "<a class='page'  href=\"manage.php?offset=".(($i * $browser_search_results))."&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\">";

                        $page .= ($i+1);

                        $page .= "</a> ";

                    } else {

                        $page .= "&nbsp;&nbsp;";

                        break;

                    }

                }

                $i++;

            }

            $last_off = $search_total - ($search_total % $browser_search_results);

            if($last_off >= $search_total) {

                $last_off -= $browser_search_results; 

            }            

            $page .= "<a class='page' href=\"manage.php?offset=".$last_off."&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\"><span  class=\"next-page\">last</span></a>";

            $page .= "</div></div>";

          $html .= "	 $page <br /> <div class=\"table\">";

          $html .= "	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> ";

          $html .= "	<tr> ";

          $html .= "	<th width=\"13\"><input type=\"checkbox\" class=\"checkbox\" /></th>";

          $html .= "<th><a class='sort' id='domain_name' href='#'>Domain Name</a></th>"; 

          $html .= "<th><a class='sort' id='cat_name' href='#'>Category Name</a></th>";

          $html .= "<th><a class='sort' id='bid_price' href='#'>Bid Price</a></th>";

          $html .= "<th><a class='sort' id='message' href='#'>Message</a></th>";

          $html .= "<th><a class='sort' id='date_sent' href='#'>Date Sent</a></th>";

          $html .= "	<th width=\"110\" class=\"ac\">#Replies</th> ";

          $html .= "</tr>"; 

            while($row = mysql_fetch_array($result)){

            $html .= "	<tr class=\"odd\">";

            $html .= "	<td><input type=\"checkbox\" class=\"checkbox\" /></td> ";

            $html .= "  <td>".$row['domain_name']."</td>";

            $html .= "  <td>".$row['cat_name']."</td>";

            $html .= "	<td>".stripcslashes($row['bid_price'])."</td>  ";  

            $html .= "	<td>".stripcslashes($row['message'])."</td>  ";

            $html .= "	<td>".$row['date_sent']."</td>  ";

            $html .= " <td><a href=\"?sub=show_comments&conid=".$row['conid']."\">".$this->CountOfferReplies($row['conid'])." Replies</a></td>";

            $html .= "	</tr> ";

            }  

           $html .= "</table></div>"; 

           $returnValue = $html;

        }

		return $returnValue;

	}

	function ShowComments($contact_id){

        $result = mysql_query("SELECT domain.domain_name, contact.*,contact.id conid,contact_category.name cat_name FROM contact, `domain`,`contact_category` where contact.domain_id = domain.id and `contact`.contact_category_id =`contact_category`.id and contact.id=$contact_id");

        if (!$result){

           $returnValue = mysql_error();

        }else {

          $html .= "<div class=\"table\">";

          $html .= "	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> ";

          $html .= "	<tr> ";

          $html .= "<th><a class='sort' id='domain_name' href='#'>Domain Name</a></th>"; 

          $html .= "<th><a class='sort' id='cat_name' href='#'>Category Name</a></th>";

          $html .= "<th><a class='sort' id='bid_price' href='#'>Bid Price</a></th>";

          $html .= "<th><a class='sort' id='message' href='#'>Message</a></th>";

          $html .= "<th><a class='sort' id='date_sent' href='#'>Date Sent</a></th>";

          $html .= "</tr>"; 

            while($row = mysql_fetch_array($result)){

            $html .= "	<tr class=\"odd\">";

            $html .= "  <td>".$row['domain_name']."</td>";

            $html .= "  <td>".$row['cat_name']."</td>";

            $html .= "	<td>".stripcslashes($row['bid_price'])."</td>  ";  

            $html .= "	<td>".stripcslashes($row['message'])."</td>  ";

            $html .= "	<td>".$row['date_sent']."</td>  ";

            $html .= "	</tr> ";

            }  

            $html .= "</table></div>"; 

         }  

            $html .= "<p>&nbsp;</p>";

           $html .= "<h2><b>Replies</b></h2>";

           $result = mysql_query("SELECT * from contact_comments where contact_id=$contact_id");

        if (!$result){

           $returnValue = mysql_error();

        }else {

          $html .= "<div class=\"table\">";

          $html .= "	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> ";

          $html .= "	<tr> ";

          $html .= "<th><a href='#'>From</a></th>"; 

          $html .= "<th><a href='#'>Message</a></th>";

           $html .= "<th><a href='#'>&nbsp;</a></th>";

          $html .= "</tr>"; 

         while($row = mysql_fetch_array($result)){

                if ($row['userid']==0){

                   $name = "Admin";

                }else {

                   $name = $this->GetUserData('firstname','id',$row['userid'])." ".$this->GetUserData('lastname','id',$row['userid']);

                }

               $html .= "<tr><td>$name</b></td>

               <td>".$row['message']."</td>";

               if ($name!="Admin"){

               $html .="<td><a href=\"?sub=delete_comment&comid=".$row['id']."&conid=$contact_id\" onclick=\"return confirm('Are you sure you want to delete this comment?');\" class=\"ico del\">Delete</a></td>

               </tr>";

              }else {

                 $html .="<td>&nbsp;</td>

               </tr>";

              } 

         }

           $html .= "</table></div>";

        }   

           $returnValue = $html;

        return $returnValue;

    }

    function ShowCommentForm($contact_id){

        $html = "<form method=\"POST\" action=\"\">";

        $html .= " <br /><table>";

        $html .= "<tr valign='top'><td>Message:</td><td><textarea name=\"comment\" cols=\"40\" rows=\"5\"></textarea></td></tr>";

        $html .= "<tr><td>&nbsp;</td>

        <td><input type=\"hidden\" name=\"sub\" value=\"save_comment_contact\">

        <input type=\"hidden\" name=\"conid\" value=\"$contact_id\">

        <input type=\"Submit\" name=\"Submit\" value=\"Send\"></td></tr>";

        $html .= "</table>";

        $html .= "</form>";

        return $html;

    }

    function SaveContactComment($message,$conid){

         if (!empty($message)){

           $result = mysql_query("Insert into contact_comments (message,contact_id,date_sent,userid) 

           Values ('".mysql_escape_string($message)."','$conid',NOW(),".$_SESSION['userid'].")");

           if (!$result){

             $returnValue = mysql_error();

           }else {

             $returnValue = "Comment successfully sent!";

           }

         }else {

            $returnValue = "Message should not be empty!";   

         }

      return $returnValue;      

    }

    function DeleteComment($id){

         if (!empty($id)){

           $result = mysql_query("Delete from contact_comments where id=$id");

           if (!$result){

             $returnValue = mysql_error();

           }else {

             $returnValue = "Comment successfully deleted!";

           }

         }else {

            $returnValue = "Comment id should not be empty!";

         }

      return $returnValue;

    }

	 function ShowAds($userid){

	   $browser_search_results = 20;

       $prev_page_allowance = 3;

       $next_page_allowance = 5;

       $offset = $_REQUEST['offset'];

       $orderby = $_REQUEST['orderby'];

       $col = $_REQUEST['col'];

       if(!empty($orderby))$orderby = "order by $col $orderby";

       if (empty($offset)){

          $offset = 0;

       }

        if($offset < 0){

        $offset = 0;

        }

        $sql = "SELECT domain.domain_name, ads.*,ads.id adsid,ads_type.name ads_type_name FROM ads, `domain`,`ads_type` where ads.domain_id = domain.id and `ads`.ads_type_id =`ads_type`.id and ads.userid=$userid $orderby";

        $result = mysql_query($sql);

        $search_total = mysql_num_rows($result);

        if (isset($_REQUEST['cmdSearch'])){

           $query = "SELECT domain.domain_name, ads.*,ads.id adsid,ads_type.name ads_type_name FROM ads, `domain`,`ads_type` where ads.domain_id = domain.id and `ads`.ads_type_id =`ads_type`.id  and ads.userid=$userid  ";

          if ($_REQUEST['search_offer']!=""){

              $search_domain = trim($_POST['search_offer']);

              $query .= "And ads.name LIKE '%$search_offer%' ";

          }

          //$query .= "order by contact.date_sent desc";

          $query .= " $orderby ";

          $result = mysql_query($query);

          $search_total = mysql_num_rows($result);

          $result = mysql_query($query." LIMIT $offset, $browser_search_results");

        }else {

        $result = mysql_query("$sql LIMIT $offset, $browser_search_results");

        }

        if (!$result){

           $returnValue = mysql_error();

        }else {

          if(($offset - $browser_search_results) > $search_total) {

            $offset = $search_total - $browser_search_results;

            }  else {

            $offset = $offset - ($offset % $browser_search_results);

           }

            $page = "<div class=\"form-event-header\">";

            $page .= "<div class=\"result-left\"><h4>Results: <span>$search_total Ads Found</span></h4></div>";

            $page .= "<div class=\"pagging\">";

                      $page .= "<a class=\"pagging page\" href=\"manage.php?offset=0&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\">first</a>&nbsp;&nbsp;";

            $i = ($offset / $browser_search_results);

            $j = $i + $next_page_allowance + 1;

            $i = $i - $prev_page_allowance;

            if($i <= 0) {

                $i = 0;

            } else {

                $page .= " ";

            }

            while (($i * $browser_search_results) < $search_total) {

                if($offset == ($i * $browser_search_results)) {

                     $page .= "<a class=\"active\" href=\"#\">";

                    $page .= ($i+1);

                    $page .= "</a> "; 

                } else {

                    if($i < $j) {

                        $page .= "<a class='page'  href=\"manage.php?offset=".(($i * $browser_search_results))."&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\">";

                        $page .= ($i+1);

                        $page .= "</a> ";

                    } else {

                        $page .= "&nbsp;&nbsp;";

                        break;

                    }

                }

                $i++;

            }

            $last_off = $search_total - ($search_total % $browser_search_results);

            if($last_off >= $search_total) {

                $last_off -= $browser_search_results;

            }

            $page .= "<a class='page' href=\"manage.php?offset=".$last_off."&sub=".$_REQUEST['sub']."&cmdSearch=".$_REQUEST['cmdSearch']."&search_offer=".$_REQUEST['search_offer']."\"><span  class=\"next-page\">last</span></a>";

            $page .= "</div></div>";

           $html = " $page<br /> <div class=\"table\">";

           $html .= "	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"> ";

          $html .= "	<tr> ";

          $html .= "	<th width=\"13\"><input type=\"checkbox\" class=\"checkbox\" /></th>";

          $html .= "	<th><a class='sort' id='name' href='#'>Name</a></th>";

          $html .= "	<th><a class='sort' id='email' href='#'>Email</a></th>";

          $html .= "<th><a class='sort' id='domain_name' href='#'>Domain Name</a></th>"; 

          $html .= "<th><a class='sort' id='cat_name' href='#'>Ads Type</a></th>";

          $html .= "<th><a class='sort' id='bid_price' href='#'>Bid Price</a></th>";

          $html .= "<th><a class='sort' id='message' href='#'>Message</a></th>";

          $html .= "<th><a class='sort' id='date_sent' href='#'>Date Sent</a></th>";

          $html .= "	<th width=\"110\" class=\"ac\">Content Control</th> ";

          $html .= "</tr>"; 

          // $html .= "<tr><td><b><a class='sort' id='name' href='#'>Name</a></b></td><td><b><a class='sort' id='email' href='#'>Email</a></b></td><td><b><a class='sort' id='domain_name' href='#'>Domain Name</a></b></td><td><b><a class='sort' id='ads_type_name' href='#'>Ads Type</a></b></td><td><b><a class='sort' id='bid_price' href='#'>Bid Price</a></b></td><td><b><a class='sort' id='message' href='#'>Message</a></b></td><td><b><a class='sort' id='date_sent' href='#'>Date Sent</a></b></td><td>&nbsp;</td></tr>";

            while($row = mysql_fetch_array($result)){

              $html .= "<tr class=\"odd\">

              <td><input type=\"checkbox\" class=\"checkbox\" /></td>

              <td>".$this->GetUserData('firstname','id',$row['userid'])." ".$this->GetUserData('lastname','id',$row['userid'])."</td><td>".$this->GetUserData('firstname','id',$row['userid'])." ".$this->GetUserData('email','id',$row['userid'])."</td><td>".$row['domain_name']."</td><td>".$row['ads_type_name']."</td><td>".stripcslashes($row['bid_price'])."</td><td>".stripcslashes($row['message'])."</td><td>".$row['date_sent']."</td>

              <td><a href=\"?sub=delete_ads&adsid=".$row['adsid']."\" onclick=\"return confirm('Are you sure you want to delete this Ads?');\">[delete]</a></td></tr>";

            }

           $html .= "</table></div>";

           $returnValue = $html;

        }

		return $returnValue;

	}

    function DeleteAds($id){

         if (!empty($id)){

           $result = mysql_query("Delete from ads where id=$id");

           if (!$result){

             $returnValue = mysql_error();

           }else {

             $returnValue = "Ads successfully deleted!";

           }

         }else {

            $returnValue = "Ads id should not be empty!";

         }

      return $returnValue;

    }

	function SaveSettings($firstname,$lastname,$company,$phone,$password,$id){

     $result = mysql_query("Update users set firstname='$firstname',lastname='$lastname',company='$company',phone='$phone',password='$password' where id = $id");

     if (!$result){

        $returnValue = mysql_error();

     }else {

        $returnValue = "success";

     } 

   return $returnValue;

  }

	function CheckDomainExist($domain){

    $result = mysql_query("SELECT count(*) as total from domain where domain_name = '$domain'");

        if (!$result){

           $returnValue = mysql_error();

        }else {            

            while($row = mysql_fetch_array($result)){

              $count = $row['total'];

            }  

        }

      if ($count>0){

         $returnValue = TRUE; 

      } else {

          $returnValue = FALSE;

      }  

   return $returnValue;

 }

	function CheckReferral(){

    if(isset($_SERVER['HTTP_REFERER'])) {

        $ref = $_SERVER['HTTP_REFERER'];

        preg_match('@^(?:http://)?([^/]+)@i',$ref, $matches);

        $host = $matches[1];

        preg_match('/[^.]+\.[^.]+$/', $host, $matches);

        $domain = trim($matches[0]);

        if ($domain!="domaindirectory.com"){

        if ($this->CheckDomainExist($domain)){

            header ("Location: domainpage.php?domain=$domain");

            exit;

        }else {

            header ("Location: domainpage.php?domain=".$this->GenerateDomainOffer());

            exit;

        }

       } 

    }

  }

function getReferral(){

    if(isset($_SERVER['HTTP_REFERER'])) {

        $ref = $_SERVER['HTTP_REFERER'];

        preg_match('@^(?:http://)?([^/]+)@i',$ref, $matches);

        $host = $matches[1];

        preg_match('/[^.]+\.[^.]+$/', $host, $matches);

        $domain = trim($matches[0]);

        if ($domain!="domaindirectory.com"){

            if ($this->CheckDomainExist($domain)){

               return $domain;

            }else {

                return $this->GenerateDomainOffer();

            }

        }

    }

    return '';

}

  function getServiceType($id=''){

    $result = mysql_query("SELECT * FROM `service_type` order by name");

    if (!$result){

       $returnValue = mysql_error();

    }else {

       $html = "<select class='slc-1' id='service_' name='service_'>";

       $html .= "<option value=\"\">Select Service</option>";

        while($row = mysql_fetch_array($result)){

            if ($row['id']==$id){

              $sel = "selected";

            } else {$sel="";}

          $html .= "<option value=\"".$row['id']."\" $sel>".$row['name']."</option>";

        }

       $html .= "</select>";

       $returnValue = $html;

    }

    return $returnValue;

}

    function SaveServicePage($name,$email,$contact,$service,$msg,$domain){

        $returnValue = '';

        $result = mysql_query("Insert into service (name,email,contact_number,service,datetime_created,inquiry_msg,domain_name) Values

            ('$name','$email','$contact','$service',NOW(),'$msg','$domain')");

        if (!$result){

            $returnValue = mysql_error();

        }else {

            $returnValue = "success";

        }

        return $returnValue;

    }

    function SaveLeads($email,$domain){

        $returnValue = '';

        $result = mysql_query("select * from leads where email like '$email' and domain_name like '$domain' ");

		$total = mysql_num_rows($result);

		if($total<1){

			$result = mysql_query("Insert into leads (email,datetime_created,domain_name) Values

				('$email',NOW(),'$domain')");

			if (!$result){

				$returnValue = mysql_error();

			}else {

				$returnValue = "success";

			}

		}else{

			$returnValue = "Eeeak!!! You're already on our Exclusive List but we got your back. We'll let you know when we launch, really!";

		}

        return $returnValue;

    }

    function CountLeads($domain){

        $returnValue = '';

        $result = mysql_query("select count(*) total from leads where domain_name like '$domain' ");

        $total=0;

        while($row = mysql_fetch_array($result)){

            $total = $row['total'];

        }

        //return intval($total)*25;

        return $total;        

    }

    function test(){

        $returnValue = '';

        $result = mysql_query("select * from  leads ");

        while($row = mysql_fetch_array($result)){

            print_r($row);

        }

    }
    
    	function GetTableInfo($table,$field,$wherefield,$value){
    $result = mysql_query("SELECT `$field` as val from $table where `$wherefield` = '$value'");
        if (!$result){
           $returnValue = mysql_error();
        }else {            
            while($row = mysql_fetch_array($result)){
				//if($field == 'linkedin_picture' && $row==""){$value = " http://linked.com/images/avatar-linked.png";}
				$value = $row['val'];
            }  
        }
   return $value;
   }

 }

?>
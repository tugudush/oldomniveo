<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 */
?>     
<?php
  		if(isset($_POST['submit'])) {
         // error_reporting(E_NOTICE);
          function valid_email($str)
          {
          return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
		     }
          if($_POST['name']!='' && $_POST['email']!='' && valid_email($_POST['email'])==TRUE && strlen($_POST['message'])>1)
          {
              //$to = preg_replace("([\r\n])", "", $_POST['receiver']);
			  $name = $_POST['name'];
			  $email = $_POST['email'];
			  $to = preg_replace("([\r\n])", "", hexstr($_POST['receiver']));
			  $from = preg_replace("([\r\n])", "", $name);
			  $subject = "[".$_POST['blogname']."] contact from " . $name;
              $message = $_POST['message'];
			  $body = "Name: ".$name." \n\nEmail: ".$email. "\n\nComments: " . $message;
			  
			  $match = "/(bcc:|cc:|content\-type:)/i";
				if (preg_match($match, $to) ||
					preg_match($match, $from) ||
					preg_match($match, $message)) {
				  die("Header injection detected.");
				}
             $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
             
        if(mail($to, $subject, $body, $headers))
              {
                  echo 1; //SUCCESS
              }
              else {
                  echo 2; //FAILURE - server failure
              }
          }
          else {
       	  echo 3; //FAILURE - not valid email

          }
		  }else{
			 die("Direct access not allowed!");
		   }
		   
		    function hexstr($hexstr) {
				  $hexstr = str_replace(' ', '', $hexstr);
				  $hexstr = str_replace('\x', '', $hexstr);
				  $retstr = pack('H*', $hexstr);
				  return $retstr;
				}

      ?>
<?php
/***************************************************************************
 ISP Config Login Interface
     Author: Glorfindel       
 ---------------------------------------------------------------------------
 Desc: Provides a unified log-in outside of the ISPConfig control panel.   
 This unified login checks the ISPConfig user tables, and provides links   
 to each of the ISPConfig panels with one, unified, password outside port  
 81.                                                                       
***************************************************************************/

// start session
session_start(); 

include("connect.php");

function checkLogin()
{
    // convert username and password from _GET to _SESSION
    if($_GET){
      $_SESSION['username']=$_GET["username"];
      $_SESSION['passwort']=$_GET["passwort"];  
    } 
    
    $username = $_SESSION['username'];
    $passwort = $_SESSION['passwort'];
    
    $username = addslashes($username);
    $passwort = addslashes($passwort);
    
    $sql = "SELECT * FROM sys_user WHERE username = '$username' AND (passwort = '".md5($passwort)."' OR passwort = PASSWORD('$passwort'))";
    
    $result=mysql_query($sql);
    if (!$_SESSION['verified'])
    {
        if (( $num = mysql_num_rows($result) ) and ($passwort != ""))
        {
            if ($num != 0)
            {
                $_SESSION['ERROR'] = "";
                $_SESSION['verified'] = 1;
                
                // lets get their e-mail alias.
                $sql = "SELECT user_email FROM isp_isp_user WHERE user_name='$username'";
                $result = mysql_query($sql);
                $_SESSION['email'] = mysql_result($result,0,"user_email");
            } 
        } 
        else 
        {
            $_SESSION['ERROR'] = "login is WRONG!!";
        }
    }
    
    if ($_SESSION['verified'] != 1) $_SESSION['ERROR'] = "Login Failed. <br />";
}


//////////////////////////
// Main Bit Starts Here //
//////////////////////////
//
if ($_SESSION['verified'] != 1 and $_GET['action'] == "login")
    checkLogin(); 
    
if ($_GET['action'] == "logout")
{
    $_SESSION = array();
    session_destroy();
    $_SESSION['ERROR'] = "You have successfully logged out. <BR />";
}
    
if ($_SESSION['verified'] != 1)
{
    // User is NOT logged in, so lets give him a login form...
    echo("<!--Begin Login -->");
    echo("<font color='red'>");
    echo($_SESSION['ERROR']);
    $_SESSION['ERROR'] = ""; // reset the error message if there is one.
    echo("</font><br />");
    echo("<form method=\"GET\" action=\"");
    echo($_SERVER['PHP_SELF']);
    echo("\">");
    echo("Username: <br /><input type=\"text\" name=\"username\" size=\"15\" /><br />");
    echo("Password: <br /><input type=\"password\" name=\"passwort\" size=\"15\" /><br />");
    echo("<input type=\"hidden\" name=\"action\" value=\"login\" />");
    echo("<p><input type=\"submit\" value=\"Login\" /></p>");
    echo("</form>");
    echo("<!--End Login -->");
    } else {
    // if the user IS logged in, give him options here.
    
    // Javascript to make POST data submittable thru link...
    // Web Admin Panel
    echo("<script language='JavaScript' type='text/javascript'>\n");
    echo("<!--\n");
    echo("function submit()\n");
    echo("{\n");
    echo("document.loginform.submit();\n");
    echo("}\n");
    echo("-->\n");
    
    // Mail
    //echo("<script language='JavaScript' type='text/javascript'>\n");
    echo("<!--\n");
    echo("function submit1()\n");
    echo("{\n");
    echo("document.loginform1.submit();\n");
    echo("}\n");
    echo("-->\n");
    
    // PhpMyAdmin
    //echo("<script language='JavaScript' type='text/javascript'>\n");
    echo("<!--\n");
    echo("function submit2()\n");
    echo("{\n");
    echo("document.loginform2.submit();\n");
    echo("}\n");
    echo("-->\n");
    echo("</script>\n");
    ////////////////////////////////////////////////////////////////////
    // Note: Newlines are required, else it screws up the javascript  //
    ////////////////////////////////////////////////////////////////////
    
    echo("<B>Control Panel: </B><BR />");
    
    echo("<form method='POST' target=_blank action='http://www.glorf.com:81/login/login.php' name='loginform'>\n");
    echo("<input type=\"hidden\" name=\"username\" value=\"");
    echo($_SESSION['username']);
    echo("\"><input type=\"hidden\" name=\"passwort\" value=\"");
    echo($_SESSION['passwort']);
    echo("\">");
    echo("</form>");
    echo("<a href='javascript: submit()'>Website Admin Panel</a>\n");

    echo("<form method='POST' target=_blank action='http://www.glorf.com:81/webmail/msglist.php' name='loginform1'>\n");
    echo("<input type=\"hidden\" name=\"f_email\" value=\"");
    echo($_SESSION['email']);
    echo("@glorfy.com\"><input type=\"hidden\" name=\"f_pass\" value=\"");
    echo($_SESSION['passwort']);
    echo("\">");
    echo("</form>");
    echo("<a href='javascript: submit1()'>Web Mail</a><br />\n");
    
    
    echo("<BR /><B>Databases: </B><BR />");
    
    // Now lets get the database names...
    // first that means we need to link the username to a web_id.
    $email = $_SESSION['email'];
    $sql = "SELECT web_id FROM isp_fakt_record WHERE notiz= '$email'";
    $result = mysql_query($sql);
    $_SESSION['web_id'] = mysql_result($result,0,"web_id");
    $web_id = $_SESSION['web_id'];
    
    // now we need to use that to grab all the DB names for displaying.
    $sql = "SELECT datenbankuser FROM isp_isp_datenbank WHERE web_id = '$web_id'";
    $result = mysql_query($sql);
    // now lets loop the results and store them into an array for later display purposes.
    global $dbs, $num_db;
    $num_db = mysql_num_rows($result);
    $dbs = array(30); // a user can't have more than 30 databases :)
    for ($i=0; $i < $num_db; $i+=1)
    {
        $dbs[$i] = mysql_result($result,$i,"datenbankuser");
        echo("<a href=\"http://");
        echo($dbs[$i]);
        echo(":");
        echo($_SESSION['passwort']);
        echo("@www.glorf.com:81/phpmyadmin/index.php");
        echo("\">");
        echo($dbs[$i]);
        echo("</a><br />");
    }
    
    ///////////////////////////////////////
    echo("<hr />");
    echo("<a href=\"");
    echo($_SERVER['PHP_SELF']);
    echo("?action=logout\">logout<br></a>");
} 
mysql_close();
?> 

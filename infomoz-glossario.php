<?php

    /*
        Plugin Name: INFOmoz-glossario
        Plugin URI: http://www.infomoz.net/infomoz-glossario-plugin-para-wordpress-2-8-1-e-wordpress-mu/
        Description: The INFOmoz-glossario plugin was created by Internet Marketing Monitor, to give WordPress users an easy way to create and manage an online glossary of terms relevant to their website.  Adding terms and linking to them by hand was a tedious process.  The INFOmoz-glossario plugin makes keeping your readers educated easy. I have changed some parts of code to make it compatible with Wordpress 2.8+ and Wordpress MU. I have only tested on Wordpress MU2.8.1, but it should work on any other version.
        Version: 0.1
        Author: Elisio Leonardo(Based on Internet Marketing Monitor Wordpress Plugin)
        Author URI: http://infomoz.net/sobre-elisio-leonardo/
    */

    /*
        Initialize
    */

    function INFOmoz_glossario_Initialize ( )
    {

        $Temporary = require_once ABSPATH . 'wp-admin/upgrade-functions.php' ;

        $GLOBALS['INFOmoz-glossario']['Variables']['Table'] = $GLOBALS['table_prefix'] . 'INFOmoz-glossario' ;

        $Temporary = $GLOBALS['wpdb']->get_var ( 'SHOW TABLES LIKE \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Table'] . '\'' )  ;
    	if ( $Temporary != $GLOBALS['INFOmoz-glossario']['Variables']['Table'] )
        {
            $Table = 'CREATE TABLE `' . $GLOBALS['INFOmoz-glossario']['Variables']['Table'] . '` ( `ID` INT UNSIGNED NOT NULL AUTO_INCREMENT , `Title` VARCHAR(255) NOT NULL , `Definition` TEXT NOT NULL , PRIMARY KEY ( `ID` ) ) ;' ;
    	    $Temporary = dbDelta ( $Table ) ;
        }
        else
        {
        }

        $Author = INFOmoz_glossario_Get_Page_Author ( ) ;

        $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] = INFOmoz_glossario_Get_Page_ID ( ) ;
        while ( 0 == $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] )
        {
            $Array = Array
            (
                'post_author'           => $Author                  ,
                'post_date'             => date   ( 'Y-m-d H:i:s' ) ,
                'post_date_gmt'         => gmdate ( 'Y-m-d H:i:s' ) ,
                'post_content'          => '[[[INFOmoz-glossario]]]'     ,
                'post_title'            => 'INFOmoz-glossario'           ,
                'post_excerpt'          => ''                       ,
                'post_status'           => 'publish'                ,
                'comment_status'        => 'closed'                 ,
                'ping_status'           => 'closed'                 ,
                'post_password'         => ''                       ,
                'post_name'             => 'INFOmoz-glossario'           ,
                'to_ping'               => ''                       ,
                'pinged'                => ''                       ,
                'post_modified'         => date   ( 'Y-m-d H:i:s' ) ,
                'post_modified_gmt'     => gmdate ( 'Y-m-d H:i:s' ) ,
                'post_content_filtered' => ''                       ,
                'post_parent'           => 0                        ,
                'guid'                  => ''                       ,
                'menu_order'            => 0                        ,
                'post_type'             => 'page'                   ,
                'post_mime_type'        => ''                       ,
                'comment_count'         => 0                        ,
            ) ;
            $Temporary = INFOmoz_glossario_MySQL_Save ( $GLOBALS['table_prefix'] . 'posts' , $Array ) ;
            $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] = INFOmoz_glossario_Get_Page_ID ( ) ;
        }

        $GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta'] = 'INFOmoz-glossario_-_Posts_-_Permission' ;

        $Temporary = INFOmoz_glossario_Get_MySQL_Field_Get ( 'post_type' , $GLOBALS['table_prefix'] . 'posts' , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' , '' , '' ) ;
        if ( 'page' != $Temporary )
        {
            $Array = Array
            (
                'post_type' => 'page' ,
            ) ;
            $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['table_prefix'] . 'posts' , $Array , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' ) ;
        }
        else
        {
        }

        $Temporary = INFOmoz_glossario_Get_MySQL_Field_Get ( 'post_author' , $GLOBALS['table_prefix'] . 'posts' , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' , '' , '' ) ;
        if ( $Author != $Temporary )
        {
            $Array = Array
            (
                'post_author' => $Author ,
            ) ;
            $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['table_prefix'] . 'posts' , $Array , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' ) ;
        }
        else
        {
        }

        $Temporary = INFOmoz_glossario_Get_MySQL_Field_Get ( 'post_status' , $GLOBALS['table_prefix'] . 'posts' , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' , '' , '' ) ;
        if ( 'publish' != $Temporary )
        {
            $Array = Array
            (
                'post_status' => 'publish' ,
            ) ;
            $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['table_prefix'] . 'posts' , $Array , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' ) ;
        }
        else
        {
        }

        $Temporary = INFOmoz_glossario_Get_MySQL_Field_Get ( 'comment_status' , $GLOBALS['table_prefix'] . 'posts' , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' , '' , '' ) ;
        if ( 'closed' != $Temporary )
        {
            $Array = Array
            (
                'comment_status' => 'open' ,
            ) ;
            $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['table_prefix'] . 'posts' , $Array , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' ) ;
        }
        else
        {
        }

        $Temporary = INFOmoz_glossario_Get_MySQL_Field_Get ( 'ping_status' , $GLOBALS['table_prefix'] . 'posts' , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' , '' , '' ) ;
        if ( 'closed' != $Temporary )
        {
            $Array = Array
            (
                'ping_status' => 'closed' ,
            ) ;
            $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['table_prefix'] . 'posts' , $Array , '`ID` = \'' . $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] . '\'' ) ;
        }
        else
        {
        }

        $GLOBALS['INFOmoz-glossario']['Settings'] = INFOmoz_glossario_Get_Settings ( ) ;

        $Temporary = update_option ( 'rewrite_rules' , '' ) ;

        return TRUE ;

    }

    /*

        Options

    */

    function INFOmoz_glossario_admin_menu ( )
    {

        $Temporary = add_options_page ( 'INFOmoz-glossario' , 'INFOmoz-glossario' , 10 , 'INFOmoz-glossario/INFOmoz-glossario.php' , 'INFOmoz_glossario_Options_Edit' ) ;

        $Temporary = add_management_page ( 'INFOmoz-glossario' , 'INFOmoz-glossario' , 10 , 'INFOmoz-glossario/INFOmoz-glossario.php' , 'INFOmoz_glossario_Actions' ) ;

        return TRUE ;

    }

    function INFOmoz_glossario_wp_head ( )
    {

?>


<link rel="stylesheet" type="text/css" href="<?php echo get_option ( 'siteurl' ) ; ?>/wp-content/plugins/infomoz-glossario/style.css" />


<?php

   

        return TRUE ;

    }

    function INFOmoz_glossario_wp_footer ( )
    {

?>

<script type="text/javascript" language="javascript" src="<?php echo get_option ( 'siteurl' ) ; ?>/wp-content/plugins/infomoz-glossario/script.js"></script>

<?php



        return TRUE ;

    }

    /*

        Settings

    */

    function INFOmoz_glossario_Get_Settings ( )
    {

        $Settings = Array ( ) ;

        $Settings['Icon'] = get_option ( 'INFOmoz_glossario_-_Settings_-_Icon' ) ;
        if ( empty ( $Settings['Icon'] ) OR FALSE == in_array ( $Settings['Icon'] , Array ( 'Yes' , 'No' ) ) )
        {
            $Settings['Icon'] = 'Yes' ;
            if ( empty ( $Settings['Icon'] ) )
            {
                $Temporary = add_option ( 'INFOmoz_glossario_-_Settings_-_Icon' , $Settings['Icon']  , '' , 'no' ) ;
            }
            else
            {
                $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Icon' , $Settings['Icon'] ) ;
            }
        }
        else
        {
        }

        $Settings['Library'] = get_option ( 'INFOmoz_glossario_-_Settings_-_Library' ) ;
        if ( empty ( $Settings['Library'] ) OR FALSE == in_array ( $Settings['Library'] , Array ( 'A' , 'B' , 'C' ) ) )
        {
            $Settings['Library'] = 'A' ;
            if ( empty ( $Settings['Library'] ) )
            {
                $Temporary = add_option ( 'INFOmoz_glossario_-_Settings_-_Library' , $Settings['Library']  , '' , 'no' ) ;
            }
            else
            {
                $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Library' , $Settings['Library'] ) ;
            }
        }
        else
        {
        }

        $Settings['Number_Of_Terms_Per_Page'] = intval ( get_option ( 'INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page' ) ) ;
        if ( empty ( $Settings['Number_Of_Terms_Per_Page'] ) OR 0 > $Settings['Number_Of_Terms_Per_Page'] )
        {
            $Settings['Number_Of_Terms_Per_Page'] = 5 ;
            if ( empty ( $Settings['Number_Of_Terms_Per_Page'] ) )
            {
                $Temporary = add_option ( 'INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page' , $Settings['Number_Of_Terms_Per_Page']  , '' , 'no' ) ;
            }
            else
            {
                $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page' , $Settings['Number_Of_Terms_Per_Page'] ) ;
            }
        }
        else
        {
        }

        $Settings['Permission'] = get_option ( 'INFOmoz_glossario_-_Settings_-_Permission' ) ;
        if ( empty ( $Settings['Permission'] ) OR FALSE == in_array ( $Settings['Permission'] , Array ( 'All' , 'None' ) ) )
        {
            $Settings['Permission'] = 'All' ;
            if ( empty ( $Settings['Permission'] ) )
            {
                $Temporary = add_option ( 'INFOmoz_glossario_-_Settings_-_Permission' , $Settings['Permission']  , '' , 'no' ) ;
            }
            else
            {
                $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Permission' , $Settings['Permission'] ) ;
            }
        }
        else
        {
        }

        $Settings['Style'] = get_option ( 'INFOmoz_glossario_-_Settings_-_Style' ) ;
        if ( empty ( $Settings['Style'] ) OR FALSE == in_array ( $Settings['Style'] , Array ( 'A' , 'B' , 'C' , 'D' ) ) )
        {
            $Settings['Style'] = 'A' ;
            if ( empty ( $Settings['Style'] ) )
            {
                $Temporary = add_option ( 'INFOmoz_glossario_-_Settings_-_Style' , $Settings['Style']  , '' , 'no' ) ;
            }
            else
            {
                $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Style' , $Settings['Style'] ) ;
            }
        }
        else
        {
        }

        return $Settings ;

    }

    function INFOmoz_glossario_Options_Edit ( )
    {

        if ( !empty ( $_POST['action'] ) AND 'update' == $_POST['action'] )
        {
            $Temporary = INFOmoz_glossario_Options_Save ( ) ;
        }
        else
        {
        }

?>

    <div class="wrap">
        <h2><?php echo __ ( 'INFOmoz-glossario' ) ; ?></h2>
        <form action="options-general.php?page=<?php echo $_GET['page'] ; ?>" method="post">
            <fieldset class="options">
                <legend><?php echo __ ( 'Options' ) ; ?></legend>
                <table class="editform optiontable">
                  

                   <tr>
                        <th scope="row"><label for="INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page"><?php echo __ ( 'Number of Terms per Page:' ) ; ?></label></th>
                        <td>
                            <select name="INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page" id="INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page">

<?php

        $Array = Array
        (
            5 ,
            10 ,
            15 ,
            20 ,
            25 ,
            50 ,
            75 ,
            100 ,
        ) ;

?>

                                <?php echo INFOmoz_glossario_SELECT_Options ( Array ( 'All' => $Array , 'Default' => $GLOBALS['INFOmoz-glossario']['Settings']['Number_Of_Terms_Per_Page'] ) , 'No' ) ; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="INFOmoz_glossario_-_Settings_-_Permission"><?php echo __ ( 'Apply to:' ) ; ?></label></th>
                        <td>
                            <select name="INFOmoz_glossario_-_Settings_-_Permission" id="INFOmoz_glossario_-_Settings_-_Permission">

<?php

        $Array = Array
        (
            'All'  => 'All the occurrences in a Post/Page'       ,
            'None' => 'Only the first occurrence in a Post/Page' ,
        ) ;

?>

                                <?php echo INFOmoz_glossario_SELECT_Options ( Array ( 'All' => $Array , 'Default' => $GLOBALS['INFOmoz-glossario']['Settings']['Permission'] ) , 'Yes' ) ; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <p class="submit">
                <input type="hidden" name="action" value="update"                                 />
                <input type="submit" name="submit" value="<?php echo __ ( 'Update &raquo;' ) ; ?>"/>
            </p>
        </form>
        <p><strong>Plugin Developed By INFOmoz, Based on IMM-Glossary Plugin from <a href="http://www.internetmarketingmonitor.org/word-press-plugins/imm-glossary-wordpress-plugin/">Internet Marketing Monitor</a></strong></p><p>To learn more about Technology, visit our website: <a href="http://infomoz.net/">INFOrmática Moçambique</a>.</p>
					<p><strong><u>Report Problems & Request Features</u></strong></p><p>If you run across bugs or issues or would like to sumbit a feature request, <a href="http://www.internetmarketingmonitor.com/contact/">please let us know</a>.</p>
					<p><strong><u>IF YOU USE AND LIKE THIS PLUGIN...</u></strong></p><p>Consider making a donation to support future development and bugfixes. </p><p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8047928">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</p>
<p> You can also give a support for the IMM-Glossary Plugin developers, <a href="http://www.internetmarketingmonitor.org/word-press-plugins/imm-glossary-wordpress-plugin/">Internet Marketing Monitor</a>, who was developed the first versions of this plugin, by make a small donation or following their RSS Feeds</p>
        
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Options_Save ( )
    {

        $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Icon'                     , 'No' ) ;
        $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Library'                  , 'C' ) ;
        $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page' , $_POST['INFOmoz_glossario_-_Settings_-_Number_Of_Terms_Per_Page'] ) ;
        $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Permission'               , $_POST['INFOmoz_glossario_-_Settings_-_Permission'              ] ) ;
        $Temporary = update_option ( 'INFOmoz_glossario_-_Settings_-_Style'                    , $_POST['INFOmoz_glossario_-_Settings_-_Style'                   ] ) ;

        $GLOBALS['INFOmoz-glossario']['Settings'] = INFOmoz_glossario_Get_Settings ( ) ;

?>

    <div id="message" class="updated fade">
        <p><strong><?php echo __ ( 'The Options were saved successfully.' ) ; ?></strong></p>
    </div>

<?php

        return TRUE ;

    }

    /*

        Actions

    */

    function INFOmoz_glossario_Actions ( )
    {

        if ( empty ( $_REQUEST['action'] ) )
        {
            $_REQUEST['action'] = NULL ;
        }
        else
        {
        }

        switch ( $_REQUEST['action'] )
        {
            case 'save'   :
                $Temporary = INFOmoz_glossario_Term_Save              ( ) ;
                $Temporary = INFOmoz_glossario_Terms_Overview_Private ( ) ;
                $Temporary = INFOmoz_glossario_Term_Add               ( ) ;
                break ;
            case 'edit'   :
                $Temporary = INFOmoz_glossario_Term_Edit ( ) ;
                break ;
            case 'update' :
                $Temporary = INFOmoz_glossario_Term_Update            ( ) ;
                $Temporary = INFOmoz_glossario_Terms_Overview_Private ( ) ;
                $Temporary = INFOmoz_glossario_Term_Add               ( ) ;
                break ;
            case 'delete' :
                $Temporary = INFOmoz_glossario_Term_Delete            ( ) ;
                $Temporary = INFOmoz_glossario_Terms_Overview_Private ( ) ;
                $Temporary = INFOmoz_glossario_Term_Add               ( ) ;
                break ;
            default :
                $Temporary = INFOmoz_glossario_Terms_Overview_Private ( ) ;
                $Temporary = INFOmoz_glossario_Term_Add               ( ) ;
        }

        return TRUE ;

    }

    /*

        Terms

    */

    function INFOmoz_glossario_Terms_Overview_Private ( )
    {

        $Total_Number_Of_Terms = INFOmoz_glossario_Get_MySQL_Field_Get ( 'COUNT(*)' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '' , '' , '' ) ;

        $Number_Of_Terms_Per_Page = $GLOBALS['INFOmoz-glossario']['Settings']['Number_Of_Terms_Per_Page'] ;

        $Total_Number_Of_Pages = ceil ( $Total_Number_Of_Terms / $Number_Of_Terms_Per_Page ) ;

        $Key = !empty ( $_REQUEST['Key'] ) ? $_REQUEST['Key'] : '1' ;

        if ( $Total_Number_Of_Pages > 0 )
        {
            if ( $Key > $Total_Number_Of_Pages )
            {
                $Key = $Total_Number_Of_Pages ;
            }
            else if ( $Key < 1 )
            {
                $Key = 1 ;
            }
            else
            {
            }
        }
        else
        {
            $Key = 1 ;
        }

        $Previous = $Key - 1 ;
        if ( $Previous < 1 )
        {
            $Previous = 'Previous' ;
        }
        else
        {
            $Previous = '<a href="edit.php?Key=' . $Previous . '&amp;page=' . $_REQUEST['page'] . '" title="Previous">Previous</a>' ;
        }

        $Next = $Key + 1 ;
        if ( $Next > $Total_Number_Of_Pages )
        {
            $Next = 'Next' ;
        }
        else
        {
            $Next = '<a href="edit.php?Key=' . $Next . '&amp;page=' . $_REQUEST['page'] . '" title="Next">Next</a>' ;
        }

        $Limit = ( ( $Key - 1 ) * $Number_Of_Terms_Per_Page ) . ' , ' . $Number_Of_Terms_Per_Page ;

        $Terms = INFOmoz_glossario_MySQL_Records_Get ( '*' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '' , '`Title` ASC' , $Limit ) ;

?>

    <div class="wrap">
        <h2><?php echo __ ( 'INFOmoz-glossario' ) ; ?></h2>
       <p><strong>Plugin Developed By INFOmoz, Based on IMM-Glossary Plugin from <a href="http://www.internetmarketingmonitor.org/word-press-plugins/imm-glossary-wordpress-plugin/">Internet Marketing Monitor</a></strong></p><p>To learn more about Technology, visit our website: <a href="http://infomoz.net/">INFOrmática Moçambique</a>.</p>
					<p><strong><u>Report Problems & Request Features</u></strong></p><p>If you run across bugs or issues or would like to sumbit a feature request, <a href="http://www.infomoz.net/">please let us know</a>.</p>
					<p><strong><u>IF YOU USE AND LIKE THIS PLUGIN...</u></strong></p><p>Consider making a donation to support future development and bugfixes. </p><p><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8047928">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</p>
<p> You can also give a support for the IMM-Glossary Plugin developers, <a href="http://www.internetmarketingmonitor.org/word-press-plugins/imm-glossary-wordpress-plugin/">Internet Marketing Monitor</a>, who was developed the first versions of this plugin, by make a small donation or following their RSS Feeds</p>
        
    </div>
        

<?php

        if ( !empty ( $Terms ) )
        {

            if ( $Total_Number_Of_Pages > 1 )
            {
                echo '<p>' ;
                $Temporary = Array ( ) ;
                for ( $Index = 1 ; $Index <= $Total_Number_Of_Pages ; $Index = $Index + 1 )
                {
                    if ( $Key == $Index )
                    {
                        $Temporary[] = $Index ;
                    }
                    else
                    {
                        $Temporary[] = '<a href="edit.php?Key=' . $Index . '&amp;page=' . $_REQUEST['page'] . '" title="' . $Index . '">' . $Index . '</a>' ;
                    }
                }
                $Temporary = implode ( ' - ' , $Temporary ) ;
                echo $Previous . ' - ' . $Temporary . ' - ' . $Next ;
                echo '</p>' ;
            }
            else
            {
            }

?>

        <table id="the-list-x" width="100%" cellpadding="3" cellspacing="3">
	    <tr>
            <th align="left" scope="col"><nobr><?php echo __ ( 'Term'       ) ; ?></nobr></th>
            <th align="left" scope="col"><nobr><?php echo __ ( 'Definition' ) ; ?></nobr></th>
            <th colspan="2"><nobr><?php echo __ ( 'Actions'     ) ; ?></nobr></th>
    	</tr>

<?php

            $Class = '' ;

            foreach ( $Terms As $Term )
            {

                $Class = ( 'alternate' == $Class ) ? '' : 'alternate' ;
                $Edit = '<a href="edit.php?Terms_-_ID=' . $Term['ID'] . '&amp;Key=' . $Key . '&amp;action=edit&amp;page=' . $_REQUEST['page'] . '" class="edit">' . __ ( 'Edit' ) . '</a>' ;
                $Delete = '<a href="edit.php?Terms_-_ID=' . $Term['ID'] . '&amp;Key=' . $Key . '&amp;action=delete&amp;page=' . $_REQUEST['page'] . '" class="delete">' . __ ( 'Delete' ) . '</a>' ;

?>

        <tr id="cat-<?php echo $Term['ID'] ; ?>" class="<?php echo $Class ; ?>">
            <td valign="top"><nobr><?php echo $Term['Title'] ; ?></nobr></td>
            <td valign="top"><?php echo $Term['Definition'] ; ?></td>
            <td valign="top"><nobr><?php echo $Edit ; ?></nobr></td>
            <td valign="top"><nobr><?php echo $Delete ; ?></nobr></td>
    	</tr>

<?php

            }

?>

            </tr>
        </table>

<?php

            if ( $Total_Number_Of_Pages > 1 )
            {
                echo '<p>' ;
                $Temporary = Array ( ) ;
                for ( $Index = 1 ; $Index <= $Total_Number_Of_Pages ; $Index = $Index + 1 )
                {
                    if ( $Key == $Index )
                    {
                        $Temporary[] = $Index ;
                    }
                    else
                    {
                        $Temporary[] = '<a href="edit.php?Key=' . $Key . '&amp;page=' . $_REQUEST['page'] . '" title="' . $Index . '">' . $Index . '</a>' ;
                    }
                }
                $Temporary = implode ( ' - ' , $Temporary ) ;
                echo $Previous . ' - ' . $Temporary . ' - ' . $Next ;
                echo '</p>' ;
            }
            else
            {
            }

        }
        else
        {

            echo '<p>There are no Terms in the database.</p>' ;

        }

?>

    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Terms_Overview_Public ( $Content )
    {

        if ( $GLOBALS['post']->ID == $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] )
        {

            $Array = Array ( ) ;

            $permalink_structure = get_option ( 'permalink_structure' ) ;

            $Temporary = get_query_var ( 'Title' ) ;

            if ( empty ( $Temporary ) )
            {

                $Total_Number_Of_Terms = INFOmoz_glossario_Get_MySQL_Field_Get ( 'COUNT(*)' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '' , '' , '' ) ;

                $Number_Of_Terms_Per_Page = $GLOBALS['INFOmoz-glossario']['Settings']['Number_Of_Terms_Per_Page'] ;

                $Total_Number_Of_Pages = ceil ( $Total_Number_Of_Terms / $Number_Of_Terms_Per_Page ) ;

                $Key = get_query_var ( 'Key' ) ;
                $Key = !empty ( $Key ) ? $Key : '1' ;
                if ( $Key > $Total_Number_Of_Pages )
                {
                    $Key = $Total_Number_Of_Pages ;
                }
                else if ( $Key < 1 )
                {
                    $Key = 1 ;
                }
                else
                {
                }

                $Previous = $Key - 1 ;
                if ( $Previous < 1 )
                {
                    $Previous = 'Previous' ;
                }
                else
                {
                    if ( empty ( $permalink_structure ) )
                    {
                        $Previous = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . '&Key=' . $Previous . '" title="Previous">Previous</a>' ;
                    }
                    else
                    {
                        $Previous = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . 'Key/' . $Previous . '/' . '" title="Previous">Previous</a>' ;
                    }
                }

                $Next = $Key + 1 ;
                if ( $Next > $Total_Number_Of_Pages )
                {
                    $Next = 'Next' ;
                }
                else
                {
                    if ( empty ( $permalink_structure ) )
                    {
                        $Next = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . '&Key=' . $Next . '" title="Next">Next</a>' ;
                    }
                    else
                    {
                        $Next = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . 'Key/' . $Next . '/' . '" title="Next">Next</a>' ;
                    }
                }

                $Limit = ( ( $Key - 1 ) * $Number_Of_Terms_Per_Page ) . ' , ' . $Number_Of_Terms_Per_Page ;

                $Terms = INFOmoz_glossario_MySQL_Records_Get ( '*' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '' , '`Title` ASC' , $Limit ) ;

                if ( !empty ( $Terms ) )
                {

                    if ( $Total_Number_Of_Pages > 1 )
                    {
                        $Array[] = '<p>' ;
                        $Temporary = Array ( ) ;
                        for ( $Index = 1 ; $Index <= $Total_Number_Of_Pages ; $Index = $Index + 1 )
                        {
                            if ( $Key == $Index )
                            {
                                $Temporary[] = $Index ;
                            }
                            else
                            {
                                if ( empty ( $permalink_structure ) )
                                {
                                    $Temporary[] = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . '&Key=' . $Index . '" title="' . $Index . '">' . $Index . '</a>' ;
                                }
                                else
                                {
                                    $Temporary[] = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . 'Key/' . $Index . '/' . '" title="' . $Index . '">' . $Index . '</a>' ;
                                }
                            }
                        }
                        $Temporary = implode ( ' - ' , $Temporary ) ;
                        $Array[] = $Previous . ' - ' . $Temporary . ' - ' . $Next ;
                        $Array[] = '</p>' ;
                    }
                    else
                    {
                    }

                    $Serial_Number = ( $Key - 1 ) * $Number_Of_Terms_Per_Page ;

                    foreach ( $Terms As $Term )
                    {

                        $Serial_Number = $Serial_Number + 1 ;

                        $Array[] = '<h3>' . $Serial_Number . '. <strong>' . $Term['Title'] . '</strong></h3>' ;
                        $Array[] = '<p>' . $Term['Definition'] . '</p>' ;

                    }

                    if ( $Total_Number_Of_Pages > 1 )
                    {
                        $Array[] = '<p>' ;
                        $Temporary = Array ( ) ;
                        for ( $Index = 1 ; $Index <= $Total_Number_Of_Pages ; $Index = $Index + 1 )
                        {
                            if ( $Key == $Index )
                            {
                                $Temporary[] = $Index ;
                            }
                            else
                            {
                                if ( empty ( $permalink_structure ) )
                                {
                                    $Temporary[] = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . '&Key=' . $Index . '" title="' . $Index . '">' . $Index . '</a>' ;
                                }
                                else
                                {
                                    $Temporary[] = '<a href="' . get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . 'Key/' . $Index . '/' . '" title="' . $Index . '">' . $Index . '</a>' ;
                                }
                            }
                        }
                        $Temporary = implode ( ' - ' , $Temporary ) ;
                        $Array[] = $Previous . ' - ' . $Temporary . ' - ' . $Next ;
                        $Array[] = '</p>' ;
                    }

                }
                else
                {

                    $Array[] = '<p>' . __ ( 'There are no Terms in the database.' ) . '</p>' ;

                }

            }
            else
            {

                $Title = get_query_var ( 'Title' ) ;
                $Title = !empty ( $Title ) ? $Title : '' ;
                $Title = base64_decode ( $Title ) ;

                $Referer = get_query_var ( 'Referer' ) ;
                $Referer = !empty ( $Referer ) ? $Referer : '' ;
                $Referer = base64_decode ( $Referer ) ;

                $Term = INFOmoz_glossario_MySQL_Record_Get ( '*' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '`Title` = \'' . $Title . '\'' , '' , '' ) ;

                if ( !empty ( $Term ) )
                {

                    $Array[] = '<h3>' . $Term['Title'] . '</h3>' ;
                    $Array[] = '<p>' ;
                    $Array[] = $Term['Definition'] ;
                    $Array[] = '</p>' ;

                    if ( 'A' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $Array[] = '<p>' ;
                        $Array[] = '<a href="' . $Referer . '" title="' . __ ( '&laquo; Go Back' ) . '">' . __ ( '&laquo; Go Back' ) . '</a>' ;
                        $Array[] = '</p>' ;
                    }

                }
                else
                {

                    $Array[] = '<p>' ;
                    $Array[] = __ ( 'You have specified an invalid Term ID.' ) ;
                    $Array[] = '</p>' ;

                    if ( 'A' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $Array[] = '<p>' ;
                        $Array[] = '<a href="' . $Referer . '" title="' . __ ( '&laquo; Go Back' ) . '">' . __ ( '&laquo; Go Back' ) . '</a>' ;
                        $Array[] = '</p>' ;
                    }

                }

            }

            $Array = implode ( "\n" , $Array ) ;

            $Content = $Array ;

        }

        return $Content ;

    }

    function INFOmoz_glossario_Term_Add ( )
    {

?>

    <div class="wrap">
        <h2><?php echo __ ( 'INFOmoz-glossario' ) ; ?></h2>
        <form action="" method="post">
            <fieldset class="options">
                <legend><?php echo __ ( 'Add Term' ) ; ?></legend>
                <table class="editform optiontable">
                    <tr>
                        <th scope="row"><label for="Title"><?php echo __ ( 'Term:' ) ; ?></label></th>
                        <td>
                            <input type="text" id="Title" name="Title" value="" size="35"/>
                        </td>
                    </tr>
                    <tr>
                        <th valign="top" scope="row"><label for="Definition"><?php echo __ ( 'Definition:' ) ; ?></label></th>
                        <td>
                            <textarea id="Definition" name="Definition" rows="10" cols="80"></textarea>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <p class="submit">
                <input type="hidden" name="Key"     value="<?php echo $_REQUEST['Key'] ; ?>"     />
                <input type="hidden" name="action"  value="save"                                 />
                <input type="hidden" name="page"    value="<?php echo $_REQUEST['page'] ; ?>"    />
                <input type="submit" name="submit"  value="<?php echo __ ( 'Save &raquo;' ) ; ?>"/>
            </p>
        </form>
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Term_Save ( )
    {

        $Array = Array
        (
            'Title'      => trim ( $_POST['Title'     ] ) ,
            'Definition' => trim ( $_POST['Definition'] ) ,
        ) ;

        $Temporary = INFOmoz_glossario_MySQL_Save ( $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , $Array ) ;

?>

    <div id="message" class="updated fade">
        <p><strong><?php echo __ ( 'The Term was saved successfully.' ) ; ?></strong></p>
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Term_Edit ( )
    {

        $Term = INFOmoz_glossario_MySQL_Record_Get ( '*' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '`ID` = \'' . $_REQUEST['Terms_-_ID'] . '\'' , '' , '' ) ;

?>

    <div class="wrap">
        <h2><?php echo __ ( 'INFOmoz-glossario' ) ; ?></h2>
        <form action="" method="post">
            <fieldset class="options">
                <legend><?php echo __ ( 'Edit Term' ) ; ?></legend>
                <table class="editform optiontable">
                    <tr>
                        <th scope="row"><label for="Title"><?php echo __ ( 'Term:' ) ; ?></label></th>
                        <td>
                            <input type="text" id="Title" name="Title" value="<?php echo htmlentities ( $Term['Title'] , ENT_QUOTES ) ; ?>" size="35"/>
                        </td>
                    </tr>
                    <tr>
                        <th valign="top" scope="row"><label for="Definition"><?php echo __ ( 'Definition:' ) ; ?></label></th>
                        <td>
                            <textarea id="Definition" name="Definition" rows="10" cols="80"><?php echo htmlentities ( $Term['Definition'] , ENT_QUOTES ) ; ?></textarea>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <p class="submit">
                <input type="hidden" name="Terms_-_ID" value="<?php echo $Term['ID'] ; ?>"            />
                <input type="hidden" name="Key"        value="<?php echo $_REQUEST['Key'] ; ?>"       />
                <input type="hidden" name="action"     value="update"                                 />
                <input type="hidden" name="page"       value="<?php echo $_REQUEST['page'] ; ?>"      />
                <input type="submit" name="submit"     value="<?php echo __ ( 'Update &raquo;' ) ; ?>"/>
            </p>
        </form>
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Term_Update ( )
    {

        $Array = Array
        (
            'Title'      => trim ( $_POST['Title'     ] ) ,
            'Definition' => trim ( $_POST['Definition'] ) ,
        ) ;

        $Temporary = INFOmoz_glossario_MYSQL_Update ( $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , $Array , '`ID` = \'' . $_POST['Terms_-_ID'] . '\'' ) ;

?>

    <div id="message" class="updated fade">
        <p><strong><?php echo __ ( 'The Term was updated successfully.' ) ; ?></strong></p>
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Term_Delete ( )
    {

        $Temporary = INFOmoz_glossario_MYSQL_Delete ( $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '`ID` = \'' . $_REQUEST['Terms_-_ID'] . '\'' ) ;

?>

    <div id="message" class="updated fade">
        <p><strong><?php echo __ ( 'The Term was deleted successfully.' ) ; ?></strong></p>
    </div>

<?php

        return TRUE ;

    }

    /*

        Pages

    */

    function INFOmoz_glossario_Get_Page_ID ( )
    {
        $ID = INFOmoz_glossario_Get_MySQL_Field_Get ( 'ID' , $GLOBALS['table_prefix'] . 'posts' , '`post_content` LIKE \'%[[[INFOmoz-glossario]]]%\'' , '`ID` ASC' , '' ) ;
        $ID = intval ( $ID ) ;
        return $ID ;
    }

    function INFOmoz_glossario_Get_Page_Author ( )
    {
        $Author = INFOmoz_glossario_Get_MySQL_Field_Get ( 'ID' ,  $GLOBALS['table_prefix'] . 'users' , '`user_login` = \'admin\'' , '' , '' ) ;
        if ( $Author > 0 )
        {
        }
        else
        {
            $Author = INFOmoz_glossario_Get_MySQL_Field_Get ( 'MIN(`ID`)' , $GLOBALS['table_prefix'] . 'users' , '' , '' , '' ) ;
        }
        return $Author ;
    }

    function INFOmoz_glossario_Get_Page_Content ( $Content )
    {

        if ( is_feed ( ) )
        {
        }
        else
        {

            $permalink_structure = get_option ( 'permalink_structure' ) ;

            if ( 'All' == $GLOBALS['INFOmoz-glossario']['Settings']['Permission'] )
            {
                $Limit = -1 ;
            }
            else if ( 'None' == $GLOBALS['INFOmoz-glossario']['Settings']['Permission'] )
            {
                $Limit = 1 ;
            }
            else
            {
                $Limit = -1 ;
            }

            if ( !empty ( $_GET['page_id'] ) )
            {
                $ID = $_GET['page_id'] ;
            }
            else
            {
                $ID = $GLOBALS['post']->ID ;
            }

            $Value = get_post_meta ( $ID , $GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta'] ) ;

            if ( !empty ( $Value[0] ) )
            {
                if ( 'All' == $Value[0] )
                {
                    $Limit = -1 ;
                }
                else if ( 'None' == $Value[0] )
                {
                    $Limit = 1 ;
                }
                else
                {
                }
            }
            else
            {
            }

            $Terms = Array ( ) ;
            $Temporary = INFOmoz_glossario_MySQL_Records_Get ( 'DISTINCT `Title`' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '' , '`ID` ASC' , '' ) ;
            if ( !empty ( $Temporary ) )
            {
                foreach ( $Temporary As $Key => $Value )
                {
                    $Array = INFOmoz_glossario_MySQL_Record_Get ( '*' , $GLOBALS['INFOmoz-glossario']['Variables']['Table'] , '`Title` = \'' . $Value['Title'] . '\'' , '`ID` ASC' , '' ) ;
                    if ( !empty ( $Array ) )
                    {
                        $Terms[] = $Array ;
                    }
                    else
                    {
                    }
                }
            }

            if ( !empty ( $Terms ) )
            {

                $Public = Array ( ) ;

                $Private = Array ( ) ;

                $Serial_Number = 0 ;

                $Temporary = preg_match_all ( '#<a([^>]*)>(.*)</a>#U' , $Content , $Matches , PREG_SET_ORDER ) ;

                if ( !empty ( $Matches ) )
                {
                    foreach ( $Matches As $Match )
                    {
                        $Serial_Number = $Serial_Number + 1 ;
                        $Public[$Serial_Number] = $Match[0] ;
                        $Content = str_replace ( $Match[0] , '[[[' . $Serial_Number . ']]]' , $Content ) ;
                    }
                }
                else
                {
                }

                $Temporary = preg_match_all ( '#</?[^>]*>#' , $Content , $Matches , PREG_SET_ORDER ) ;

                if ( !empty ( $Matches ) )
                {
                    foreach ( $Matches As $Match )
                    {
                        $Serial_Number = $Serial_Number + 1 ;
                        $Public[$Serial_Number] = $Match[0] ;
                        $Content = str_replace ( $Match[0] , '[[[' . $Serial_Number . ']]]' , $Content ) ;
                    }
                }
                else
                {
                }

                $Tool_Tips = Array ( ) ;

                $Serial_Number = 0 ;

                foreach ( $Terms As $Term )
                {

                    $Serial_Number = $Serial_Number + 1 ;

                    if ( empty ( $permalink_structure ) )
                    {
                        $URL = get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . '&Title=' . base64_encode ( $Term['Title'] ) . '&Referer=' . base64_encode ( $_SERVER['REQUEST_URI'] ) ;
                    }
                    else
                    {
                        $URL = get_permalink ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) . 'Title/' . base64_encode ( $Term['Title'] ) . '/Referer/' . base64_encode ( $_SERVER['REQUEST_URI'] ) . '/' ;
                    }

                    if ( 'B' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $URL = get_option ( 'siteurl' ) . '/wp-content/plugins/INFOmoz-glossario/Pop_Up.php?Title=' . base64_encode ( $Term['Title'] ) . '&Definition=' . base64_encode ( $Term['Definition'] ) ;
                    }


                    if ( 'A' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $termo=$Term['Definition'];

                        $Link= '<span class="hotspot" onmouseover="'."tooltip.show('$termo');".'" onmouseout="tooltip.hide();">${2}</span>';
                    }
                    else if ( 'B' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $Link = '<a href="#" onclick="return INFOmoz_glossario_Pop_Up ( \'' . $URL . '\' ) ;" title="${2}" class="' . $GLOBALS['INFOmoz-glossario']['Settings']['Style'] . '">${2}</a>' ;
                    }
                    else if ( 'C' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {
                        $termo=$Term['Definition'];

                        $Link= '<span class="hotspot" onmouseover="'."tooltip.show('$termo');".'" onmouseout="tooltip.hide();">${2}</span>';

                    }

                    if ( 'A' == $GLOBALS['INFOmoz-glossario']['Settings']['Library'] )
                    {

                    }
                    else
                    {
                        $Temporary = NULL ;
                    }

                    $Link = $Link . $Temporary ;

                    $Link = '${1}' . $Link . '${3}' ;
                    
                    $Content = preg_replace ( '#(\W)(' . preg_quote ( $Term['Title'] , '#' ) . ')(\W)#Ui' , '${1}%%%${2}%%%${3}' , $Content , $Limit ) ;

                    $Private['#(\W)%%%(' . preg_quote ( $Term['Title'] , '#' ) . ')%%%(\W)#Ui'] = $Link ;

                }

                $Patterns = Array ( ) ;

                $Replacements = Array ( ) ;

                $Serial_Number = 0 ;

                if ( !empty ( $Private ) )
                {
                    foreach ( $Private As $Key => $Value )
                    {
                        $Serial_Number = $Serial_Number + 1 ;
                        $Patterns[$Serial_Number] = $Key ;
                        $Replacements[$Serial_Number] = $Value ;
                    }
                }
                else
                {
                }

                $Content = preg_replace ( $Patterns , $Replacements , $Content , $Limit ) ;

                if ( !empty ( $Public ) )
                {
                    foreach ( $Public As $Key => $Value )
                    {
                        $Content = str_replace ( '[[[' . $Key . ']]]' , $Value , $Content ) ;
                    }
                }
                else
                {
                }

                $Tool_Tips = implode ( "\n" , $Tool_Tips ) ;

                $Content = $Content . $Tool_Tips ;

            }

        }

        return $Content ;

    }

    function INFOmoz_glossario_Permission_Get ( )
    {

	    $Value = get_post_meta ( $_GET['post'] , $GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta'] ) ;

        if ( empty ( $Value[0] ) )
        {
            $Value[0] = $GLOBALS['INFOmoz-glossario']['Settings']['Permission'] ;
        }

?>

    <div class="dbx-box-wrapper">
	    <fieldset id="INFOmoz_glossario_Posts" class="dbx-box">
		    <div class="dbx-handle-wrapper">
			    <h3 class="dbx-handle"><?php echo __ ( 'INFOmoz-glossario Settings' ) ; ?></h3>
		    </div>
    		<div class="dbx-content-wrapper">
	    		<div class="dbx-content">
				    <table cellspacing="3" cellpadding="3" align="left">
					    <tr>
						    <td align="right"><?php echo __ ( 'Apply To: ' ) ; ?></td>
						    <td align="left">
							    <select name="<?php echo $GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta'] ; ?>">

<?php

        $Array = Array
        (
            'All'  => 'All the occurrences in this Post/Page'       ,
            'None' => 'Only the first occurrence in this Post/Page' ,
        ) ;

?>

                                    <?php echo INFOmoz_glossario_SELECT_Options ( Array ( 'All' => $Array , 'Default' => $Value[0] ) , 'Yes' ) ; ?>
                                </select>
							</td>
					    </tr>
    				</table>
	    		</div>
		    </div>
    	</fieldset>
    </div>

<?php

        return TRUE ;

    }

    function INFOmoz_glossario_Permission_Set ( $ID )
    {

        if ( empty ( $ID ) )
        {
            $ID = $_POST['post_ID'] ;
        }
        else
        {
        }

        $Key = $GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta'] ;

        $Value = $_POST[$GLOBALS['INFOmoz-glossario']['Variables']['Page']['Meta']] ;

        $Temporary = delete_post_meta ( $ID , $Key ) ;

        $Temporary = add_post_meta ( $ID , $Key , $Value ) ;

        return TRUE ;

    }

    function INFOmoz_glossario_URLs_Variables ( $Variables )
    {

        $Temporary = array_push ( $Variables , 'Key' , 'Referer' , 'Title' ) ;

        return $Variables ;

    }

    function INFOmoz_glossario_URLs_Rules ( $Rules )
    {

        if ( 0 != $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] )
        {

            $Temporary = get_page_uri ( $GLOBALS['INFOmoz-glossario']['Variables']['Page']['ID'] ) ;

            $Array = Array ( ) ;

            $Array['(' . $Temporary . ')/Key/([0-9]+)/?$'] = 'index.php?pagename=$matches[1]&Key=$matches[2]' ;

            $Array['(' . $Temporary . ')/Title/([^/]+)/Referer/([^/]+)/?$'] = 'index.php?pagename=$matches[1]&Title=$matches[2]&Referer=$matches[3]' ;

            $Rules = array_merge ( $Array , $Rules ) ;

        }
        else
        {
        }

        return $Rules ;

    }

    /*
        MySQL
    */

    function INFOmoz_glossario_MySQL_Result_Get ( $Query )
    {

        $GLOBALS['MySQL']['Queries'][] = $Query ;

        $Result = mysql_query ( $Query ) OR die ( 'Query: ' . $Query . '<br/>Error: ' . mysql_error ( ) ) ;

        return $Result ;

    }

    function INFOmoz_glossario_MySQL_Records_Get ( $Columns , $Table , $Where , $Order_By , $Limit )
    {

        $Query = Array ( ) ;

        $Records = Array ( ) ;

        $Index = 0 ;

        $Query[] = 'SELECT ' . $Columns . ' FROM `' . $Table . '`' ;

        if ( !empty ( $Where ) )
        {
            $Query[] = 'WHERE ' . $Where ;
        }
        else
        {
        }

        if ( !empty ( $Order_By ) )
        {
            $Query[] = 'ORDER BY ' . $Order_By ;
        }
        else
        {
        }

        if ( !empty ( $Limit ) )
        {
            $Query[] = 'LIMIT ' . $Limit ;
        }
        else
        {
        }

        $Query = implode ( ' ' , $Query ) ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        if ( !empty ( $Result ) )
        {
            while ( $Row = mysql_fetch_assoc ( $Result ) )
            {
                $Index = $Index + 1 ;
                $Records[$Index] = $Row ;
            }
        }
        else
        {
        }

        return $Records ;

    }

    function INFOmoz_glossario_MySQL_Record_Get ( $Columns , $Table , $Where , $Order_By , $Limit )
    {

        $Query = Array ( ) ;

        $Record = Array ( ) ;

        $Query[] = 'SELECT ' . $Columns . ' FROM `' . $Table . '`' ;

        if ( !empty ( $Where ) )
        {
            $Query[] = 'WHERE ' . $Where ;
        }
        else
        {
        }

        if ( !empty ( $Order_By ) )
        {
            $Query[] = 'ORDER BY ' . $Order_By ;
        }
        else
        {
        }

        if ( !empty ( $Limit ) )
        {
            $Query[] = 'LIMIT ' . $Limit ;
        }
        else
        {
        }

        $Query = implode ( ' ' , $Query ) ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        if ( !empty ( $Result ) )
        {
            $Record = mysql_fetch_assoc ( $Result ) ;
        }
        else
        {
        }

        return $Record ;

    }

    function INFOmoz_glossario_Get_MySQL_Field_Get ( $Column , $Table , $Where , $Order_By , $Limit )
    {

        $Query = Array ( ) ;

        $Field = NULL ;

        $Query[] = 'SELECT ' . $Column . ' FROM `' . $Table . '`' ;

        if ( !empty ( $Where ) )
        {
            $Query[] = 'WHERE ' . $Where ;
        }
        else
        {
        }

        if ( !empty ( $Order_By ) )
        {
            $Query[] = 'ORDER BY ' . $Order_By ;
        }
        else
        {
        }

        if ( !empty ( $Limit ) )
        {
            $Query[] = 'LIMIT ' . $Limit ;
        }
        else
        {
        }

        $Query = implode ( ' ' , $Query ) ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        if ( !empty ( $Result ) )
        {
            $Row = mysql_fetch_row ( $Result ) ;
            $Field = $Row[0] ;
        }
        else
        {
        }

        return $Field ;

    }

    function INFOmoz_glossario_MySQL_Save ( $Table , $Record )
    {

        $Query = Array ( ) ;

        $Keys = Array ( ) ;

        $Values = Array ( ) ;

        $Query[] = 'INSERT INTO `' . $Table . '`' ;

        $Query[] = '(' ;

        if ( !empty ( $Record ) )
        {
            foreach ( $Record As $Key => $Value )
            {
                $Keys[]   = '`'  . INFOmoz_glossario_MySQL_Value_Get ( $Key   ) . '`'  ;
                $Values[] = '\'' . INFOmoz_glossario_MySQL_Value_Get ( $Value ) . '\'' ;
            }
        }
        else
        {
        }

        $Query[] = implode ( ' , ' , $Keys   ) ;
        $Query[] = ')' ;
        $Query[] = 'VALUES' ;
        $Query[] = '(' ;
        $Query[] = implode ( ' , ' , $Values ) ;
        $Query[] = ')' ;                         ;

        $Query = implode ( ' ' , $Query ) ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        return $Result ;

    }

    function INFOmoz_glossario_MYSQL_Update ( $Table , $Record , $Where )
    {

        $Query = Array ( ) ;

        $Sets = Array ( ) ;

        $Query[] = 'UPDATE `' . $Table . '` SET' ;

        if ( !empty ( $Record ) )
        {
            foreach ( $Record As $Key => $Value )
            {
                $Key   = INFOmoz_glossario_MySQL_Value_Get ( $Key   ) ;
                $Value = INFOmoz_glossario_MySQL_Value_Get ( $Value ) ;
                $Sets[] = '`' . $Key . '` = \'' . $Value . '\'' ;
            }
        }
        else
        {
        }

        $Query[] = implode ( ' , ' , $Sets ) ;

        $Query[] = 'WHERE ' . $Where ;

        $Query = implode ( ' ' , $Query ) ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        return $Result ;

    }

    function INFOmoz_glossario_MYSQL_Delete ( $Table , $Where )
    {

        $Query = 'DELETE FROM `' . $Table . '` WHERE ' . $Where ;

        $Result = INFOmoz_glossario_MySQL_Result_Get ( $Query ) ;

        return $Result ;

    }

    function INFOmoz_glossario_MySQL_Value_Get ( $Variable )
    {

        return $Variable ;

    }

    /*
        Misc. Functions
    */

    function INFOmoz_glossario_SELECT_Options ( $Values , $Indexed = 'Yes' )
    {

        $Options = Array ( ) ;

        if ( empty ( $Values['Default'] ) )
        {
            $Values['Default'] = NULL ;
        }
        else
        {
        }

        foreach ( $Values['All'] As $Key => $Value )
        {

            switch ( $Indexed )
            {
                case 'Yes' :
                    break ;
                case 'No' :
                    $Key = $Value ;
                    break ;
                default :
            }

            if ( $Key == $Values['Default'] )
            {
                $Selected = ' selected="selected"' ;
            }
            else
            {
                $Selected = '' ;
            }

            $Options[] = '<option value="' . $Key . '"' . $Selected . '>' . $Value . '</option>' ;

        }

        $Options = implode ( '' , $Options ) ;

        return $Options ;

    }

    function INFOmoz_glossario_Log ( $Anything )
    {

        $Output = Array ( ) ;

        $Output[] = '<pre class="Log">' ;

        if ( is_array ( $Anything ) OR is_object ( $Anything ) )
        {
            $Output[] = print_r ( $Anything , TRUE ) ;
        }
        else
        {
            $Output[] = $Anything ;
        }

        $Output[] = '</pre>' ;

        $Output = implode ( '' , $Output ) ;

        return $Output ;

    }

    /*
        Initialize
    */

    $GLOBALS['INFOmoz-glossario'] = Array ( ) ;

    if ( function_exists ( 'add_action' ) )
    {
        $Temporary = add_action ( 'init' , 'INFOmoz_glossario_Initialize' ) ;
    }
    else
    {
    }

    if ( function_exists ( 'add_action' ) )
    {

        $Temporary = add_action ( 'admin_menu' , 'INFOmoz_glossario_admin_menu' ) ;

        $Temporary = add_action ( 'simple_edit_form'   , 'INFOmoz_glossario_Permission_Get' ) ;
        $Temporary = add_action ( 'edit_form_advanced' , 'INFOmoz_glossario_Permission_Get' ) ;
        $Temporary = add_action ( 'edit_page_form'     , 'INFOmoz_glossario_Permission_Get' ) ;
        $Temporary = add_action ( 'edit_post'          , 'INFOmoz_glossario_Permission_Set' ) ;
        $Temporary = add_action ( 'save_post'          , 'INFOmoz_glossario_Permission_Set' ) ;
        $Temporary = add_action ( 'publish_post'       , 'INFOmoz_glossario_Permission_Set' ) ;

        $Temporary = add_action ( 'wp_head' , 'INFOmoz_glossario_wp_head' ) ;
        $Temporary = add_action ( 'wp_footer' , 'INFOmoz_glossario_wp_footer' ) ;

    }
    else
    {
    }

    if ( function_exists ( 'add_filter' ) )
    {

        $Temporary = add_filter ( 'query_vars' , 'INFOmoz_glossario_URLs_Variables' ) ;

        $Temporary = add_filter ( 'rewrite_rules_array' , 'INFOmoz_glossario_URLs_Rules' ) ;

        $Temporary = add_filter ( 'the_excerpt' , 'INFOmoz_glossario_Get_Page_Content' , 10 ) ;
        $Temporary = add_filter ( 'the_content' , 'INFOmoz_glossario_Get_Page_Content' , 10 ) ;

        $Temporary = add_filter ( 'the_excerpt' , 'INFOmoz_glossario_Terms_Overview_Public' , 10 ) ;
        $Temporary = add_filter ( 'the_content' , 'INFOmoz_glossario_Terms_Overview_Public' , 10 ) ;

    }
    else
    {
    }

    // Create the function to output the contents of our Dashboard Widget

function infomoz_dashboard_widget_function() {
        require_once(ABSPATH.WPINC.'/rss.php'); 
	// Display whatever it is you want to show
	echo "Este widget indica que você está usando o plugin  infomoz-glossário!<br>This Widget means that you are using infomoz-glossario plugin!";
		if ( $rss = fetch_rss( 'http://feeds.feedburner.com/infomoz' ) ) {
			echo '<div class="rss-widget">';
			if ($image == 'normal') {
				echo '<a href="http://yoast.com/" title="visite o INFOmoz.net"><img src="http://farm4.static.flickr.com/3117/3809231173_8f8508fa44_s.jpg" class="alignright" alt="INFOmoz"/></a>';			
			} else {
				echo '<a href="http://yoast.com/" title="Visite o INFOmoz.net"><img width="80" src="http://farm4.static.flickr.com/3117/3809231173_8f8508fa44_s.jpg" class="alignright" alt="INFOmoz"/></a>';			
			}
			echo '<ul>';
			$rss->items = array_slice( $rss->items, 0, 5 );
			foreach ( (array) $rss->items as $item ) {
				echo '<li>';
				echo '<a class="rsswidget" href="'.clean_url( $item['link'], $protocolls=null, 'display' ).'">'. wp_specialchars($item['title']) .'</a> ';
				if ($showdate)
					echo '<span class="rss-date">'. date('F j, Y', strtotime($item['pubdate'])) .'</span>';
				
				echo '</li>';
			}
			echo '</ul>';
			echo '<div style="border-top: 1px solid #ddd; padding-top: 10px; text-align:center;">';
			echo '<a href="http://feeds.feedburner.com/infomoz"><img src="'.get_bloginfo('wpurl').'/wp-includes/images/rss.png" alt=""/> Subscribe with RSS</a>';
			if ($image == 'normal') {
				echo ' &nbsp; &nbsp; &nbsp; ';
			} else {
				echo '<br/>';
			}
			echo '<a href="http://infomoz.net/subscreva-ao-infomoz/"><img src="http://cdn.yoast.com/email_sub.png" alt=""/> Subscribe by email</a>';
			echo '</div>';
			echo '</div>';
		}
} 

// Create the function use in the action hook

function infomoz_add_dashboard_widgets() {
	wp_add_dashboard_widget('infomoz_dashboard_widget', 'Últimas noticias e dicas de Informática<br>Latest Technology tips and tricks', 'infomoz_dashboard_widget_function');	
} 

// Hoook into the 'wp_dashboard_setup' action to register our other functions

add_action('wp_dashboard_setup', 'infomoz_add_dashboard_widgets' );

?>

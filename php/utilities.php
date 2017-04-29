<?php 

/* Utilities
  -------------------------------------------------------------- */

// Convert Hexadecimal to RGB
function hex2rgb( $hex ) {

    $hex = str_replace( '#' , '' , $hex );

    if( strlen( $hex ) == 3) {
        $r = hexdec( substr( $hex , 0 , 1 ).substr( $hex , 0 , 1 ) );
        $g = hexdec( substr( $hex , 1 , 1 ).substr( $hex , 1 , 1 ) );
        $b = hexdec( substr( $hex , 2 , 1 ).substr( $hex , 2 , 1 ) );
    } else {
        $r = hexdec( substr( $hex , 0 , 2 ) );
        $g = hexdec( substr( $hex , 2 , 2 ) );
        $b = hexdec( substr( $hex , 4 , 2 ) );
    }

    $rgb = array( $r , $g , $b );

    return implode( ',' , $rgb );
}


// Validate email address
function valid_email( $email ) {
    return filter_var( $email , FILTER_VALIDATE_EMAIL ) !== false;
}


// Detect browser's name & OS
function get_the_browser() {
    $u_agent    = $_SERVER[ 'HTTP_USER_AGENT' ];
    $bname      = 'Unknown';
    $ub         = 'Unknown';
    $platform   = 'Unknown';

    // Get platform
    if ( preg_match( '/linux/i' , $u_agent ) ) {
        $platform = 'linux';
    }
    elseif ( preg_match( '/macintosh|mac os x/i' , $u_agent ) ) {
        $platform = 'mac';
    }
    elseif ( preg_match( '/windows|win32/i' , $u_agent ) ) {
        $platform = 'windows';
    }

    // Get Useragent's name
    if( preg_match( '/MSIE/i' , $u_agent ) && !preg_match( '/Opera/i' , $u_agent ) ) {
        $bname = 'Internet Explorer';
        $ub = 'msie';
    }
    elseif( preg_match( '/Firefox/i' , $u_agent ) ) {
        $bname = 'Mozilla Firefox';
        $ub = 'firefox';
    }
    elseif( preg_match( '/Chrome/i' , $u_agent ) ) {
        $bname = 'Google Chrome';
        $ub = 'chrome';
    }
    elseif( preg_match( '/Safari/i' , $u_agent ) ) {
        $bname = 'Apple Safari';
        $ub = 'safari';
    }
    elseif( preg_match( '/Opera/i' , $u_agent ) ) {
        $bname = 'Opera';
        $ub = 'opera';
    }
    elseif( preg_match( '/Netscape/i' , $u_agent ) ) {
        $bname = 'Netscape';
        $ub = 'netscape';
    }

    return array(
        'userAgent' => $u_agent,
        'fullName'  => $bname,
        'name'      => $ub,
        'platform'  => $platform
    );
}

// Detect iPad
function is_iPad() {
    return ( bool ) strpos( $_SERVER[ 'HTTP_USER_AGENT' ] , 'iPad' );
}

// Detect ie old browsers (v. 1-8)
function is_old_ie() {
    return ( bool ) preg_match( '/(?i)msie [2-8]/' , $_SERVER[ 'HTTP_USER_AGENT' ] );
}


// Limit words
function string_limit_words( $string , $word_limit ) {
    $words = explode( ' ' , $string , ( $word_limit + 1 ) );
    if ( count( $words ) > $word_limit ) {
        array_pop( $words );
    }
    return strip_tags( implode( ' ' , $words ) );
}


// Age
function get_years_old( $birth_day ) {
    list( $Y , $m , $d ) = explode( '-' , $birth_day );
    return( date( 'md' ) < $m.$d ? date( 'Y' ) - $Y - 1 : date( 'Y' ) - $Y );
}


// Copy right + year to year
function get_copyright() {
    $create_year = 2017;
    $current_year = date( 'Y' );
    $cp = 'Copyright &copy; ';
    if ( $create_year < $current_year ) {
        $cp.= $create_year.' - ';
    }
    $cp.= $current_year;
    return $cp;
}


// Language control

function get_lang() {
    $lang = ( $_COOKIE[ 'lang' ] ) ? $_COOKIE[ 'lang' ] : 'en' ;
    return $lang;
}

function is_lang( $language ) {
    $selected_language = $_COOKIE[ 'lang' ];

    switch ( $language ) {

        case 'en':
            return ( $language == $selected_language || $selected_language == null ) ? true : false;
            break;

        case 'es':
            return ( $language == $selected_language ) ? true : false;
            break;

        case 'pt':
            return ( $language == $selected_language ) ? true : false;
            break;

        default:
            return false;
            break;
    }
}

function printl( $en , $es , $pt ) {

    $selected_language = $_COOKIE[ 'lang' ];

    switch ( $selected_language ) {
        case 'en':
            echo $en;
            break;

        case 'es':
            echo $es;
            break;

        case 'pt':
            echo $pt;
            break;

        default:
            echo $en;
            break;
    }
}

function get_printl( $en , $es , $pt ) {

    $selected_language = $_COOKIE[ 'lang' ];

    switch ( $selected_language ) {
        case 'en':
            return $en;
            break;

        case 'es':
            return $es;
            break;

        case 'pt':
            return $pt;
            break;

        default:
            return $en;
            break;
    }
}

?>
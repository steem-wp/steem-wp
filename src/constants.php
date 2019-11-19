<?php

    // Define global plguin constants
    
    defined('STEEMWP_AUTH_GROUP') or define('STEEMWP_AUTH_GROUP', 'steemwp_auth_group');
    defined('STEEMWP_OPTIONS_GROUP') or define('STEEMWP_OPTIONS_GROUP', 'steemwp_options_group');
    
    $steemwp_options = unserialize( get_option( STEEMWP_AUTH_GROUP ) );
    
    defined('STEEMWP_SC_AUTH_URL') or define('STEEMWP_SC_AUTH_URL', 'steemwp/auth');
    
    defined('STEEMWP_ACTIVE_ACCOUNT') or define('STEEMWP_ACTIVE_ACCOUNT', $steemwp_options['account']);
    defined('STEEMWP_ACCESS_TOKEN') or define('STEEMWP_ACCESS_TOKEN', $steemwp_options['token']);
    defined('STEEMWP_TOKEN_EXPIRY') or define('STEEMWP_TOKEN_EXPIRY', $steemwp_options['expiry']);
    defined('STEEMWP_TOKEN_SCOPE') or define('STEEMWP_TOKEN_SCOPE', $steemwp_options['scope']);
    
    defined('STEEMWP_CREATED') or define('STEEMWP_CREATED', $steemwp_options['created']);
    defined('STEEMWP_STATE') or define('STEEMWP_STATE', $steemwp_options['state']);
    
    defined('STEEMWP_HOMEPAGE') or define('STEEMWP_HOMEPAGE', 'http://steemwp.com');
    defined('STEEMWP_STEEM_ACCOUNT') or define('STEEMWP_STEEM_ACCOUNT', 'steemwp.com');
    defined('STEEMWP_VERSION') or define('STEEMWP_VERSION', '0.0.1');
    defined('STEEMWP_LOGO_URL') or define('STEEMWP_LOGO_URL', plugins_url('steemwp/assets/img/steem.png'));
    defined('STEEMWP_LOGO_DATA') or define('STEEMWP_LOGO_DATA', 'data:image/svg+xml;base64,' . base64_encode(
        '<?xml version="1.0" standalone="no"?>
        <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
         "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
        <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
         width="2500.000000pt" height="2500.000000pt" viewBox="0 0 2500.000000 2500.000000"
         preserveAspectRatio="xMidYMid meet">
        <metadata>
        Created by potrace 1.15, written by Peter Selinger 2001-2017
        </metadata>
        <g transform="translate(0.000000,2500.000000) scale(0.100000,-0.100000)"
        fill="#000000" stroke="none">
        <path d="M7537 22563 c-159 -213 -207 -284 -200 -296 3 -6 2 -8 -3 -4 -13 8
        -247 -349 -334 -510 -8 -15 -35 -64 -59 -108 -99 -178 -181 -347 -175 -358 4
        -7 4 -9 -1 -5 -4 4 -16 -9 -26 -30 -35 -73 -79 -172 -124 -283 -26 -63 -53
        -127 -60 -144 -16 -37 -116 -321 -139 -393 -9 -29 -14 -57 -11 -62 3 -4 1 -10
        -3 -12 -9 -3 -84 -249 -81 -264 1 -5 0 -16 -4 -24 -17 -44 -38 -134 -33 -146
        3 -8 2 -14 -3 -14 -5 0 -14 -30 -21 -67 -14 -75 -16 -86 -31 -158 -6 -27 -12
        -61 -14 -75 -2 -14 -7 -36 -10 -50 -3 -14 -8 -45 -10 -70 -3 -25 -8 -52 -10
        -60 -2 -8 -7 -40 -10 -70 -3 -30 -8 -70 -11 -87 -10 -66 -21 -179 -20 -216 1
        -20 -1 -37 -4 -37 -3 0 -6 -21 -8 -48 -2 -26 -6 -76 -8 -112 -12 -152 -14
        -703 -4 -715 7 -9 7 -15 1 -19 -5 -4 -8 -16 -6 -29 2 -12 6 -78 10 -147 4 -69
        8 -143 10 -165 2 -22 6 -76 10 -121 6 -72 11 -119 15 -119 0 0 2 -25 5 -55 4
        -69 19 -189 30 -250 2 -8 6 -37 9 -65 4 -27 11 -75 16 -105 5 -30 11 -68 14
        -85 4 -29 41 -233 51 -286 3 -15 14 -71 26 -125 11 -55 22 -108 25 -119 2 -11
        13 -60 24 -110 11 -49 23 -101 26 -115 13 -64 132 -518 169 -645 15 -49 30
        -103 35 -120 5 -16 17 -59 28 -95 11 -36 31 -101 45 -145 60 -196 266 -811
        312 -930 12 -33 62 -168 110 -300 104 -285 376 -999 417 -1095 18 -42 25 -59
        98 -250 39 -102 77 -198 84 -215 7 -16 23 -57 36 -90 12 -33 28 -73 35 -90 7
        -16 25 -61 40 -100 14 -38 31 -81 37 -95 6 -14 13 -29 14 -35 5 -18 145 -379
        163 -420 10 -22 31 -77 47 -122 15 -45 32 -79 38 -76 5 3 6 1 3 -4 -4 -6 24
        -94 62 -194 107 -284 150 -402 157 -431 3 -16 11 -25 17 -21 5 3 7 1 4 -4 -4
        -6 9 -55 29 -109 20 -55 51 -146 71 -204 19 -58 38 -112 42 -120 4 -8 16 -43
        26 -77 10 -35 23 -63 27 -63 5 0 6 -5 2 -11 -3 -6 -2 -21 4 -32 10 -21 128
        -386 137 -424 3 -10 21 -72 41 -138 20 -66 38 -127 40 -135 2 -8 29 -105 59
        -215 31 -110 65 -238 76 -285 27 -111 28 -116 34 -140 9 -37 13 -54 40 -175
        14 -66 30 -138 35 -160 12 -48 38 -180 51 -252 5 -29 14 -79 19 -110 6 -32 13
        -74 16 -93 3 -19 9 -60 14 -90 5 -30 12 -73 15 -95 3 -22 8 -51 10 -65 5 -31
        14 -106 21 -185 3 -33 8 -67 11 -75 3 -8 7 -35 8 -60 2 -25 6 -74 9 -110 12
        -136 18 -216 20 -245 0 -16 4 -34 7 -40 7 -13 3 -793 -4 -900 -3 -44 -8 -100
        -12 -125 -3 -25 -8 -72 -10 -105 -10 -113 -16 -170 -25 -230 -5 -33 -12 -80
        -15 -105 -11 -85 -26 -175 -35 -215 -5 -22 -11 -56 -15 -75 -18 -112 -99 -448
        -136 -569 -107 -344 -176 -537 -265 -738 -8 -17 -14 -33 -14 -36 0 -14 -200
        -426 -243 -502 -13 -22 -43 -76 -66 -120 -119 -223 -374 -613 -571 -875 -64
        -85 -120 -161 -124 -168 -6 -9 964 -12 4833 -12 l4840 0 29 43 c17 23 39 53
        51 66 12 13 21 27 21 30 0 3 14 21 31 39 16 17 28 32 25 32 -6 0 0 7 51 68 13
        15 23 30 23 33 0 3 8 16 18 27 38 47 288 423 300 452 3 8 31 56 62 105 30 50
        66 113 80 140 14 28 27 52 30 55 22 22 230 446 295 600 15 36 32 76 38 90 6
        14 11 27 12 30 1 3 9 23 19 45 10 22 22 51 26 65 5 14 21 57 35 95 14 39 28
        77 30 85 3 8 20 60 40 115 19 55 32 107 29 115 -3 8 -2 11 2 7 9 -9 57 151 49
        163 -3 5 -1 10 5 12 7 2 68 222 86 313 2 11 6 30 9 42 12 53 14 62 19 94 6 35
        9 51 26 134 6 28 12 64 14 80 3 17 7 44 10 60 5 30 10 68 22 160 3 28 8 59 10
        70 4 22 10 82 19 185 3 36 8 81 10 100 2 19 7 89 10 155 4 66 9 123 11 127 3
        5 0 8 -7 8 -8 0 -8 4 -1 12 13 17 13 529 -1 546 -6 8 -6 12 2 12 7 0 10 3 8 8
        -3 4 -8 67 -12 141 -3 73 -8 148 -10 165 -2 17 -6 72 -10 121 -3 50 -8 101
        -10 115 -2 14 -7 54 -11 90 -3 36 -7 72 -9 80 -1 8 -6 42 -10 75 -4 33 -8 69
        -10 80 -1 11 -6 43 -10 70 -3 28 -15 100 -25 160 -17 95 -26 150 -55 310 -7
        41 -24 118 -40 190 -8 33 -17 74 -19 91 -5 28 -44 195 -82 354 -41 169 -197
        728 -214 765 -5 11 -14 40 -20 65 -10 37 -237 728 -257 780 -3 8 -20 56 -38
        105 -18 50 -49 135 -69 190 -21 55 -49 134 -63 175 -14 41 -30 79 -34 85 -5 5
        -9 15 -9 22 0 8 -48 138 -107 291 -59 152 -114 297 -123 322 -9 25 -22 59 -29
        75 -6 17 -19 50 -29 75 -9 25 -22 56 -29 70 -7 14 -13 28 -13 32 0 9 -128 339
        -140 360 -6 10 -10 22 -10 28 0 6 -9 29 -19 53 -10 23 -51 125 -91 227 -39
        102 -75 194 -80 205 -16 36 -135 343 -234 605 -54 140 -101 264 -105 275 -5
        11 -18 47 -31 80 -12 33 -25 69 -30 80 -5 11 -20 52 -34 90 -14 39 -31 84 -37
        100 -7 17 -13 35 -15 40 -1 6 -26 75 -54 155 -29 80 -72 204 -97 275 -25 72
        -49 132 -54 133 -5 2 -7 8 -4 12 8 13 -25 110 -37 110 -5 0 -7 4 -3 9 3 5 -19
        85 -49 178 -95 294 -187 600 -237 788 -67 253 -146 578 -165 680 -2 11 -6 29
        -8 40 -18 83 -55 266 -60 295 -3 19 -8 46 -11 60 -11 55 -25 137 -30 175 -3
        22 -8 56 -11 75 -4 19 -8 46 -10 60 -1 14 -5 39 -8 55 -3 17 -8 53 -11 80 -3
        28 -8 68 -11 90 -3 22 -7 51 -9 65 -2 14 -6 59 -10 100 -7 78 -15 163 -20 215
        -18 161 -27 791 -15 1000 2 44 0 87 -4 94 -6 9 -5 12 1 8 6 -4 11 12 12 41 0
        26 3 63 6 82 2 19 7 69 10 110 3 41 8 86 10 100 2 14 7 50 10 80 4 30 9 64 11
        75 2 11 7 40 10 65 7 62 19 131 50 295 48 251 166 689 239 881 15 38 35 95 46
        128 23 66 125 313 169 409 16 35 34 74 39 88 6 13 15 31 20 39 4 8 28 56 52
        105 35 73 126 245 226 425 84 151 338 530 503 750 64 85 120 161 124 168 6 9
        -963 12 -4832 12 l-4839 0 -126 -167z"/>
        </g>
        </svg>'
        )
    );
    
    defined('SC_VERIFY_URL') or define('SC_VERIFY_URL', 'https://steemconnect.com/api/me');
    defined('SC_BROADCAST_URL') or define('SC_BROADCAST_URL', 'https://steemconnect.com/api/broadcast');
    defined('SC_REVOKE_URL') or define('SC_REVOKE_URL', 'https://steemconnect.com/api/oauth2/token/revoke');
    defined('SC_SCOPE') or define('SC_SCOPE', array("login", "offline"));
    defined('SC_LOGIN_URL') or define('SC_LOGIN_URL', 'https://steemwp.com/steemwp/remote-auth-in?scope=vote,comment&state=' . urlencode( home_url() . '/' . STEEMWP_SC_AUTH_URL ));
    
    defined('STEEMWP_FILE_URL') or define('STEEMWP_FILE_URL', plugins_url('steemwp/index.php'));
    defined('STEEMWP_DIR_URL') or define('STEEMWP_DIR_URL', plugins_url('steemwp') );
    
    defined('STEEMWP_HOOKS_FOLDER') or define('STEEMWP_HOOKS_FOLDER', plugins_url('steemwp/src/hooks') );
    defined('STEEMWP_UI_FOLDER') or define('STEEMWP_UI_FOLDER', plugins_url('steemwp/src/ui') );
    defined('STEEMWP_MODULES_FOLDER') or define('STEEMWP_MODULES_FOLDER', plugins_url('steemwp/src/modules') );
    defined('STEEMWP_LIB_FOLDER') or define('STEEMWP_LIB_FOLDER', plugins_url('steemwp/src/lib') );
    defined('STEEMWP_HELPERS_FOLDER') or define('STEEMWP_HELPERS_FOLDER', plugins_url('steemwp/src/helpers') );
    
    defined('STEEMWP_ASSETS_FOLDER') or define('STEEMWP_ASSETS_FOLDER', plugins_url('steemwp/assets') );
    defined('STEEMWP_VENDOR_FOLDER') or define('STEEMWP_VENDOR_FOLDER', plugins_url('steemwp/vendor') );
    defined('STEEMWP_SRC_FOLDER') or define('STEEMWP_SRC_FOLDER', plugins_url('steemwp/src') );   
    
?>
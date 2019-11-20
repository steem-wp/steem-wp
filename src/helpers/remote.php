<?php
    
    function remote($url, $params) {

        $token = sanitize_text_field ($_GET['access_token'] );
        if (!$token) return false;

        $config = array(
            'method' => $params['method'] ?? "POST",
            'encoding' => $params['encoding'] ?? '',
            'timeout' => $params['timeout'] ?? 40,
            'redirection' => $params['redirects'] ?? 1,
            'httpversion' => $params['http_version'] ?? CURL_HTTP_VERSION_1_1,
            'headers' => $params['header'] ?? array(
                'Content-Type' => 'application/json',
                "Cache-Control" => "no-cache",
                "Authorization" => $token
            ),
            'body' =>  $params['postfields'] ?? '{}',
            'cookies' =>  $params['cookies'] ?? array()
        );

        $response = wp_remote_request( $url, $config);

        if (is_wp_error( $response )) return false;

        return ( gettype($response['body']) == 'string' ) ? json_decode($response['body']) : $response['body'];
    }

?>

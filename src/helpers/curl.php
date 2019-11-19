<?php
    
    function curl($query) {
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $query['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => $query['encoding'] ?? '',
            CURLOPT_MAXREDIRS => $query['redirects'] ?? 1,
            CURLOPT_TIMEOUT => $query['timeout'] ?? 30,
            CURLOPT_HTTP_VERSION => $query['http_version'] ?? CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $query['method'] ?? "POST",
            CURLOPT_POSTFIELDS => $query['postfields'] ?? '{}',
            CURLOPT_HTTPHEADER => $query['header'] ?? array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        
        $result = curl_exec($curl);
        
        if (!$result) {
            die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }
        
        curl_close($curl);
        
        return ( gettype($result) == 'string' ) ? json_decode($result) : result;
        
    }
    
?>
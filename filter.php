<?php
function sanitizeAndFilterXSS($data) {
    // Remove potential script tags
    $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
    
    // Remove potential on* attributes
    $data = preg_replace('/\bon\w+\s*=\s*".*?"/i', '', $data);
    
    // Remove potential JavaScript events
    $data = preg_replace('/\b(?:on(?:click|dblclick|mousedown|mouseup|mouseover|mousemove|mouseout|keypress|keydown|keyup|focus|blur|change|select|submit|reset))\s*=\s*".*?"/i', '', $data);
    
    // Remove potential HTML attributes like "javascript:"
    $data = preg_replace('/\b(?:javascript|vbscript)\b\s*:/i', '', $data);
    
    // Remove any HTML tags except for the allowed tags
    $allowedTags = '<b><strong><i><em><ul><ol><li><a>';
    $data = strip_tags($data, $allowedTags);

    // Convert special characters to HTML entities
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return $data;
}
?>
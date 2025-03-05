<?php

namespace Core;

abstract class Controller
{
    protected function view(string $path, array $data = []): string
    {
        // Değişkenleri extract et
        extract($data);
        
        // Output buffer'ı başlat
        ob_start();
        
        // View dosyasını include et
        include dirname(__DIR__) . '/views/' . $path;
        
        // Buffer'ı al ve temizle
        return ob_get_clean();
    }
    
    protected function json($data)
    {
        header('Content-Type: application/json');
        return json_encode($data);
    }
    
    public function __call($method, $args)
    {
        throw new \Exception("Method {$method} does not exist in " . get_class($this));
    }
} 
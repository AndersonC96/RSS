<?php
    namespace App\feed;
    class tecmundo{
        const FEED_URL = 'https://rss.tecmundo.com.br/feed';// URL do feed
        private $feed = null;// Armazena o feed
        public function __construct(){
            $this->loadFeed();// Carrega o feed
        }
        private function loadFeed(){
            $curl = curl_init();// Inicializa o cURL
            curl_setopt_array($curl, [// Configura o cURL
                CURLOPT_URL => self::FEED_URL,// URL do feed
                CURLOPT_RETURNTRANSFER => true,// Retorna o resultado
                CURLOPT_CUSTOMREQUEST => 'GET',// Requisição GET
            ]);
            $response = curl_exec($curl);// Executa o cURL
            curl_close($curl);// Fecha o cURL
            echo "<pre>";
            print_r($response);
            echo "</pre>";
            exit;
        }
    }
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
            /*echo "<pre>";
            print_r($response);
            echo "</pre>";
            exit;*/
            return $this->parseXML($response);// Retorna o resultado
        }
        private function parseXML($response){
            if(!strlen($response))
                return false;// Se o tamanho da resposta for 0, retorna false
            $this->feed = simplexml_load_string($response);// Carrega o XML
            return true;// Retorna true
        }
        public function getTitle(){
            return $this->feed->channel->title;// Retorna o título do feed
        }
        public function getDescription(){
            return $this->feed->channel->description;// Retorna a descrição do feed
        }
        public function getLastUpdate(){
            return $this->feed->channel->lastBuildDate;// Retorna a data da última atualização do feed
        }
        public function getLogo(){
            return $this->feed->channel->image->url;// Retorna a URL da imagem do feed
        }
        public function getItems(){
            return $this->feed->channel->item;// Retorna os itens do feed
        }
    }
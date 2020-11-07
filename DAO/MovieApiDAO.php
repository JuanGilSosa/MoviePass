<?php

    namespace DAO;

    
    class MovieApiDAO
    {


        function GetMoviesPlaying(){
            
            $get_data = $this->callAPI('GET', 'https://api.themoviedb.org/3/movie/now_playing?api_key=a67565019e2b3ed72b43911ab7692772&language=es-AR', false);
            $response = json_decode($get_data, true);
            //$errors = $response['response']['errors'];
            $data = $response['results'];

            return $data;
            
        }

        function GetMovieById($idMovie){

            $get_data = $this->callAPI('GET', 'https://api.themoviedb.org/3/movie/' . $idMovie .'?api_key=a67565019e2b3ed72b43911ab7692772&language=es-AR', false);
            $response = json_decode($get_data, true);
            //$errors = $response['response']['errors'];
            $data = $response;

            return $data;
        }

        function callAPI($method, $url, $data){
            $curl = curl_init();
            switch ($method){
               case "POST":
                  curl_setopt($curl, CURLOPT_POST, 1);
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
               case "PUT":
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                  if ($data)
                     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                  break;
               default:
                  if ($data)
                     $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            // OPTIONS:
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
               'APIKEY: a67565019e2b3ed72b43911ab7692772',
               'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // EXECUTE:
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            return $result;
         }


         

    }




?>
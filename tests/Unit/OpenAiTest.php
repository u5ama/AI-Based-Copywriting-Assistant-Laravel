<?php

namespace Tests\Unit;

use Tests\TestCase;

class OpenAiTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testOpenApi()
    {
        $authorization = "Authorization: Bearer ".env("OPENAI_API_KEY");
        $curl = curl_init();
        $postValues = array(
          "prompt" => "Software company",
          "max_tokens" => 100,
          "echo" => true,
          "frequency_penalty" => 0,
          "presence_penalty" => 0,
          "top_p" => 1,
          "temperature" => 0.7,
          "stop" => ["-----------"]
        );
        curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/engines/davinci/completions');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postValues));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        $response = curl_exec($curl);
        //print_r(curl_getinfo($curl));
        $result = json_decode($response, true);

        $this->assertArrayHasKey('id', $result);
        $this->assertArrayNotHasKey('error', $result);
    }
}

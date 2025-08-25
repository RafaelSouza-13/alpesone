<?php

namespace App\Console\Commands;

use App\Http\Requests\VehicleRequest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class AtualizarJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:atualizar-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza o banco de dados com o arquivo JSON';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = env('API_URL');
        // $this->line('Executando comando...');
        try{
            $response = Http::get($url);
            $this->line('Status: ' . $response->status());
            if($response->successful()){
                $data = $response->json();
                if (!is_array($data)) {
                    $this->error("O JSON não está no formato esperado.");
                    return;
                }
                
            }
        }catch (ConnectionException $e) {
            $this->error("Erro de conexão com a API: " . $e->getMessage());
        } catch (RequestException $e) {
            $this->error("Erro na resposta da API: " . $e->getMessage());
        } catch (\Exception $e) {
            $this->error("Erro inesperado: " . $e->getMessage());
        }
    }
}

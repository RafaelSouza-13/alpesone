<?php

namespace App\Console\Commands;

use App\Http\Requests\VehicleRequest;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
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
        $vehicleRepository = new VehicleRepository();
        $success = 0;
        $fail = 0;
        try{
            $response = Http::get($url);
            $this->line('Status: ' . $response->status());
            $this->line('Body: ' . json_encode(json_decode($response->body(), true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));


            if($response->successful()){
                $data = $response->json();
                if (!is_array($data)) {
                    $this->error("O JSON não está no formato");
                    return;
                }
                $currentHash = md5(json_encode($data));
                $lastHash = Cache::get('vehicles_json_hash');

                if ($currentHash === $lastHash) {
                    $this->info("O JSON não sofreu alteração, não há nada para atualizar.");
                    return;
                }
                foreach ($data as $item) {
                    $itemMapped = [
                        'json_data_id' => $item['id'],
                        'created_json' => $item['created'],
                        'updated_json' => $item['updated'],
                        'type'         => $item['type'],
                        'brand'        => $item['brand'],
                        'model'        => $item['model'],
                        'version'      => $item['version'],
                        'doors'       => $item['doors'],
                        'board'       => $item['board'],
                        'chassi'      => $item['chassi'],
                        'transmission'=> $item['transmission'],
                        'km'          => $item['km'],
                        'description' => $item['description'],
                        'sold'        => $item['sold'],
                        'category'    => $item['category'],
                        'url_car'     => $item['url_car'],
                        'old_price'   => $item['old_price'],
                        'price'       => $item['price'],
                        'color'      => $item['color'],
                        'fuel'       => $item['fuel'],
                        'year'       => json_encode($item['year']),
                        'optionals'  => json_encode($item['optionals']),
                        'fotos'      => json_encode($item['fotos']),
                    ];

                    $validator = Validator::make($itemMapped, (new VehicleRequest())->rules());

                    if ($validator->fails()) {
                        $this->error("Dados inválidos {$item['id']}: " . json_encode($validator->errors()->all()));
                        $fail++;
                        continue;
                    }
                    $validated = $validator->validated();
                    $vehicleRepository->updateOrCreate($validated);
                    $success++;
                }
              Cache::put('vehicles_json_hash', $currentHash, 3800);
              $this->info("Processamento finalizado. Sucesso: $success, Falhas: $fail");
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

<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class JsonContactRepository
{
    private string $path = 'db.json';

    private function read(): array {
        if (!Storage::exists($this->path)) {
            Storage::put($this->path, json_encode(['contacts' => []], JSON_PRETTY_PRINT));
        }
        return json_decode(Storage::get($this->path), true) ?: ['contacts' => []];
    }

    private function write(array $data): void {
        Storage::put($this->path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function all(): array {
        return $this->read()['contacts'];
    }

    public function find($id): ?array {
        foreach ($this->all() as $c) {
            if ((string)$c['id'] === (string)$id) return $c;
        }
        return null;
    }

    public function create(array $payload): array {
        $db = $this->read();
        $contacts = $db['contacts'];
        $id = count($contacts) ? max(array_column($contacts, 'id')) + 1 : 1;
        $contact = [
            'id'         => $id,
            'first_name' => $payload['first_name'],
            'last_name'  => $payload['last_name'],
            'email'      => $payload['email'],
            'created_at' => now()->toISOString(),
            'updated_at' => now()->toISOString(),
        ];
        $contacts[] = $contact;
        $db['contacts'] = $contacts;
        $this->write($db);
        return $contact;
    }

    public function update($id, array $payload): ?array {
        $db = $this->read();
        foreach ($db['contacts'] as &$c) {
            if ((string)$c['id'] === (string)$id) {
                $c = array_merge($c, $payload);
                $c['updated_at'] = now()->toISOString();
                $this->write($db);
                return $c;
            }
        }
        return null;
    }

    public function delete($id): bool {
        $db = $this->read();
        $before = count($db['contacts']);
        $db['contacts'] = array_values(array_filter($db['contacts'], fn($c)=> (string)$c['id'] !== (string)$id));
        $this->write($db);
        return count($db['contacts']) < $before;
    }
}

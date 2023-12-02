<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $hidden = ['updated_at', 'created_at']; //Significa que esse campo não virá na resposta, estou ocultando o updated_at

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'race_id', 'id');
    }

/*belongsToMany significa relacionamento muitos para muitos
1 - Classe do Modelo de Destino:
Pet::class: Este é o primeiro argumento do método belongsToMany. Ele indica o modelo de destino com o qual
você está estabelecendo o relacionamento. No exemplo, Pet::class é o modelo Pet.

2 - Nome da Tabela Intermediária (Chave Estrangeira do Modelo Atual):
'race_id': Este é o segundo argumento do método belongsToMany. Ele representa o nome do campo na tabela
intermediária que contém a chave estrangeira do modelo atual. Isso indica qual campo na tabela intermediária
guarda as referências para o modelo atual.

3 - Chave Primária do Modelo Atual:
'id': Este é o terceiro argumento do método belongsToMany. Ele indica o nome do campo na tabela do modelo
atual que é referenciado como sua chave primária. Geralmente, é o campo id. */

}

<?php

namespace Database\Seeders;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    private $arrayTareas = array(
        array(
            'nombre' => 'Comprar material de oficina',
            'estado' => 'completada',
            'responsable' => 'Lucía'
        ),
        array(
            'nombre' => 'Terminar proyecto Laravel',
            'estado' => 'incompletada',
            'responsable' => 'Pepe'
        ),
        array(
            'nombre' => 'Enviar correo a cliente',
            'estado' => 'completada',
            'responsable' => 'Ana'
        ),
        array(
            'nombre' => 'Revisar código de compañeros',
            'estado' => 'incompletada',
            'responsable' => 'David'
        ),
        array(
            'nombre' => 'Hacer backup de la base de datos',
            'estado' => 'completada',
            'responsable' => 'María'
        ),
        array(
            'nombre' => 'Actualizar dependencias de Composer',
            'estado' => 'incompletada',
            'responsable' => 'Javier'
        )
    );

    public function run(): void
    {
        // User::factory(10)->create();
        self::seedUsers();
        self::seedTareas();
    }


    function seedUsers()
    {

        $deleted = User::query()->delete();
        $this->command->info('se han eliminado' . $deleted . 'registros');

        for ($i = 0; $i < 2; $i++) {
            $usuario = new User;
            $usuario->name = 'usuario' . $i;
            $usuario->email = 'usuario' . $i . '@gmail.com';
            $usuario->password = bcrypt('123');
            $usuario->save();
        }
    }

    function seedTareas()
    {

        $deleted = Tarea::query()->delete();
        $this->command->info('se han eliminado' . $deleted . 'registros');

        foreach ($this->arrayTareas as $tareas) {
            $t = new Tarea;
            $t->nombre = $tareas['nombre'];
            $t->estado = $tareas['estado'];
            $t->responsable = $tareas['responsable'];
            $t->save();
        }
    }
}

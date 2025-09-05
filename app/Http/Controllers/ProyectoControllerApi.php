<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Proyecto;
//use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;


class ProyectoControllerApi extends Controller
{

//////////////////////////////////////////////////
// Funcion API para obtener todos los proyectos (GET)
    public function get(): JsonResponse
    {
        $proyectos = Proyecto::all(); // Asignar antes de usar

        if($proyectos->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'No se encontraron proyectos'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $proyectos,
            'message' => 'Proyectos obtenidos correctamente'
        ], 200);
    }
///////////////////////////////////////////////////


///////////////////////////////////////////////////
// Funcion API para obtener proyecto por ID (GET)
    public function getById($id): JsonResponse
    {

        $proyecto = Proyecto::find($id);
        if ($proyecto) {
            return response()->json([
                'status' => 'success',
                'data' => $proyecto,
                'message' => 'Proyecto obtenido correctamente'
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'data' => [],
                'message' => 'Proyecto no encontrado'
            ], 404);
        }
    }
///////////////////////////////////////////////////////


///////////////////////////////////////////////////////
// Funcion API para crear un nuevo proyecto (POST) y devolver el JSON del proyecto creado
    public function post(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'fecha_inicio' => 'required|date',
                'estado' => 'required|string|max:50',
                'responsable' => 'required|string|max:255',
                'monto' => 'required|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
                'message' => 'Todos los campos son obligatorios y deben tener un valor válido.'
            ], 422);
        }

        $validatedData['created_by'] = auth()->id();

        try {
            $proyecto = Proyecto::create($validatedData);

            return response()->json([
                'status' => 'success',
                'data' => $proyecto,
                'message' => 'Proyecto creado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Error al crear el proyecto'
            ], 500);
        }
    }
///////////////////////////////////////////////


///////////////////////////////////////////////
// Funcion API para actualizar un proyecto (PATCH)
    public function update(Request $request, $id): JsonResponse
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proyecto no encontrado'
            ], 404);
        }

        try {
            $validatedData = $request->validate([
                'nombre' => 'sometimes|required|string|max:255',
                'fecha_inicio' => 'sometimes|required|date',
                'estado' => 'sometimes|required|string|max:50',
                'responsable' => 'sometimes|required|string|max:255',
                'monto' => 'sometimes|required|numeric|min:0',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
                'message' => 'Error de validación en los campos enviados.'
            ], 422);
        }

        $proyecto->update($validatedData);

        // Mensajes personalizados por campo actualizado
        $mensajes = [];
        foreach ($validatedData as $campo => $valor) {
            switch ($campo) {
                case 'nombre':
                    $mensajes[] = 'Nombre actualizado correctamente';
                    break;
                case 'fecha_inicio':
                    $mensajes[] = 'Fecha de inicio actualizada correctamente';
                    break;
                case 'estado':
                    $mensajes[] = 'Estado actualizado correctamente';
                    break;
                case 'responsable':
                    $mensajes[] = 'Responsable actualizado correctamente';
                    break;
                case 'monto':
                    $mensajes[] = 'Monto actualizado correctamente';
                    break;
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $proyecto,
            'messages' => $mensajes
        ], 200);
    }
///////////////////////////////////////////////


///////////////////////////////////////////////
// Funcion API para eliminar un proyecto (DELETE)
    public function delete($id): JsonResponse
    {
        $proyecto = Proyecto::find($id);
        if (!$proyecto) {
            return response()->json([
                'status' => 'error',
                'message' => 'Proyecto no encontrado'
            ], 404);
        }
        $proyecto->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Proyecto eliminado correctamente'
        ], 204);
    }
}
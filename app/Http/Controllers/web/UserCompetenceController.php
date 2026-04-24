<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use App\Models\Competence;
use App\Models\User_Competence;
use Illuminate\Http\Request;

class UserCompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user-competence');
    }

    /**
     * Obtenir toutes les compétences d'un utilisateur
     */
    public function getCompetencesByUser($codeUser)
    {
        try {
            $utilisateur = Utilisateur::findOrFail($codeUser);
            $competences = $utilisateur->competences()->get();
            return response()->json($competences, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Utilisateur non trouvé', 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Obtenir tous les utilisateurs ayant une compétence donnée
     */
    public function getUsersByCompetence($codeComp)
    {
        try {
            $competence = Competence::findOrFail($codeComp);
            $utilisateurs = $competence->utilisateurs()->get();
            return response()->json($utilisateurs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Compétence non trouvée', 'message' => $e->getMessage()], 404);
        }
    }

    /**
     * Assigner une compétence à un utilisateur
     */
    public function assignCompetence(Request $request)
    {
        $request->validate([
            'code_user' => 'required|string|max:255',
            'code_comp' => 'required|integer',
        ]);

        try {
            // Vérifier que l'utilisateur existe
            $utilisateur = Utilisateur::findOrFail($request->code_user);
            // Vérifier que la compétence existe
            $competence = Competence::findOrFail($request->code_comp);

            // Vérifier si l'association existe déjà
            $exists = User_Competence::where('code_user', $request->code_user)
                ->where('code_comp', $request->code_comp)
                ->first();

            if ($exists) {
                return response()->json(['error' => 'Cette compétence est déjà assignée à cet utilisateur'], 409);
            }

            $userCompetence = User_Competence::create([
                'code_user' => $request->code_user,
                'code_comp' => $request->code_comp
            ]);

            return response()->json([
                'message' => 'Compétence assignée avec succès',
                'data' => $userCompetence
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de l\'assignation', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Retirer une compétence d'un utilisateur
     */
    public function removeCompetence(Request $request)
    {
        $request->validate([
            'code_user' => 'required|string|max:255',
            'code_comp' => 'required|integer',
        ]);

        try {
            $userCompetence = User_Competence::where('code_user', $request->code_user)
                ->where('code_comp', $request->code_comp)
                ->first();

            if (!$userCompetence) {
                return response()->json(['error' => 'L\'association utilisateur-compétence n\'existe pas'], 404);
            }

            $userCompetence->delete();

            return response()->json(['message' => 'Compétence retirée avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur lors de la suppression', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth", "verified"])
    ->name("dashboard");

// * Todos
Route::middleware("auth")->group(function () {
    Route::get("/todos", [TodoController::class, "view"])->name("todos");
    Route::get("/todos/create", [TodoController::class, "show_create"])->name(
        "todos/create"
    );
    Route::post("/todos/create", [TodoController::class, "create_todo"]);

    Route::get("todos/edit/{todo_id}", [TodoController::class, "show_edit"]);
    Route::patch("todos/edit/{todo_id}", [
        TodoController::class,
        "edit_todo",
    ])->name("todos.edit");
    Route::patch("todos/set_todo_as_done/{todo_id}", [
        TodoController::class,
        "set_todo_as_done",
    ])->name("todos.set_todo_as_done");

    Route::delete("todos/delete/{todo_id}", [
        TodoController::class,
        "delete",
    ])->name("todos.delete");
});

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit"
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update"
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy"
    );
});

require __DIR__ . "/auth.php";

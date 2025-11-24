<?php
namespace AuthSystem\Controllers;

class HomeController extends Controller {
    public function index(): void {
        $this->view('home/index', [
            'page_title' => "Главная страница",
        ]);
    }
}
?>
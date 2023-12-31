<?php

namespace App\Controllers;

use App\BaseController;
use App\Request;
use App\Models\FormValidation;
use App\Models\FileValidation;
use App\Models\Post;
use App\Models\User;
use App\Helpers\Session;
use App\Helpers\Exception;
use App\Traits\HasProtectedRoutes;

class PostController extends BaseController {
    use HasProtectedRoutes;


    public function index(Request $request)
    {
        $postId = $request->getParams()['id'];

        $post = new Post($this->db);
        if (!$post->find($postId)) {
            Session::flash('error', '❌ Der Post existiert nicht.');
            $this->response->redirectTo('/dashboard');
        }

        // $this->response->json(200, $post->toArray());

        $this->response->view('/post/index', [
            'post' => $post
        ]);
    }


    public function show()
    {
        $this->redirectAnonymousUsers();
        $this->response->view('/post/create');
    }


    public function create(Request $request)
    {
        $this->redirectAnonymousUsers();

        $postData = $request->getInput('post');
        $formValidation = new FormValidation($postData);

        $formValidation->setRules([
            'title' => 'required|min:4|max:64',
            'body' => 'required|min:10'
        ]);

        $formValidation->validate();

        $imageData = $request->getInput('files');

        $fileValidation = new FileValidation($imageData);

        $fileValidation->setRules([
            'image' => 'required|type:image|maxsize:20297152'
        ]);

        $fileValidation->validate();

        if ($formValidation->fails() || $fileValidation->fails()) {
            $this->response->view('post/create', [
                'errors' => array_merge(
                    $formValidation->getErrors(),
                    $fileValidation->getErrors()
                )
            ]);
        }

        try {
            $post = new Post($this->db);
            $post->create(
                $this->user->getId(),
                $postData['title'],
                $postData['body'],
                $imageData['image']
            );
            Session::flash('success', "✅ Der Post wurde erfolgreich erstellt.");
            $this->response->redirectTo("/post/{$post->getId()}");
        } catch (Exception $e) {
            $this->response->view('post/create', [
                'errors' => $e->getData()
            ]);
        }
    }

    public function list(Request $request)
    {
        $post = new Post($this->db);
        $allPosts = $post->getAllPosts();

        $this->response->view('post/list', [
            'posts' => $allPosts
        ]);
    }
    

    public function delete(Request $request)
    {
       
        $postId = $request->getParams()['id'];

        $this->redirectUnintendedAccess($request, '/dashboard');

        $post = new Post($this->db);

        if (!$post->find($postId)) {
            Session::flash('error', '❌ Dieser Post wurde bereits gelöscht.');
            $this->response->redirectTo('/dashboard');
        }

        $this->redirectAnonymousUsers();

        if (!$this->user->owns($post)) {
            Session::flash('error', '❌ Du hast nicht die Berechtigung, um diesen Post zu löschen.');
            $this->response->redirectTo('/dashboard');
        }

        if (!$post->delete()) {
            Session::flash('error', '❌ Something went wrong');
            return $this->response->redirectTo('/dashboard');
        }

        Session::flash('success', '✅ Der Post wurde erfolgreich gelöscht.');
        return $this->response->redirectTo('/dashboard');
    }

    public function edit(Request $request)
    {
        $postId = $request->getParams()['id'];

        $post = new Post($this->db);
        if (!$post->find($postId)) {
            Session::flash('error', '❌ Der Post, den du bearbeiten möchtest, existiert nicht.');
            $this->response->redirectTo('/dashboard');
        }

        $this->redirectAnonymousUsers();

        $this->response->view('/post/edit', [
            'post' => $post
        ]);
    }

    public function update(Request $request)
    {
        $postId = $request->getParams()['id'];
        $post = new Post($this->db);

        if (!$post->find($postId)) {
            Session::flash('error', 'The post you tried to edit does not exist.');
            $this->response->redirectTo('/dashboard');
        }

        $this->redirectAnonymousUsers();

        if (!$this->user->owns($post)) {
            Session::flash('error', 'You do not have permission to edit this post.');
            $this->response->redirectTo('/dashboard');
        }

        $formInput = $request->getInput();

        $validation = new FormValidation($formInput);

        $validation->setRules([
            'title' => 'required|min:4|max:64',
            'body' => 'required|min:10'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $this->response->view('post/edit', [
                'post' => $post,
                'errors' => $validation->getErrors()
            ], 422);
        }

        if (!$post->edit($formInput['title'], $formInput['body'])) {
            $this->response->view('posts/edit', [
                'post' => $post,
                'errors' => [
                    'root' => ['Something went wrong while trying to update your post.']
                ]
            ]);
        }

        Session::flash('success', '✅ Dein Post wurde erfolgreich bearbeitet');
        $this->response->redirectTo("/post/{$post->getId()}");
    }

}

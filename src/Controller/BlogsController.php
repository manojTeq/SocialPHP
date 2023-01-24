<?php

namespace App\Controller;

class BlogsController extends AppController{

    public function home(){
        
        $this->viewBuilder()->setLayout('blog');

    }

    public function post()
        {
            $article = $this->Articles->newEmptyEntity();
            if ($this->request->is('post')) {
                $article = $this->Articles->patchEntity($article, $this->request->getData());
    
                // Hardcoding the user_id is temporary, and will be removed later
                // when we build authentication out.
                $article->user_id = 1;
    
                if ($this->Articles->save($article)) {
                    $this->Flash->success(__('Your article has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to add your article.'));
            }
            $this->set('article', $article);
        } 
    

}

?>
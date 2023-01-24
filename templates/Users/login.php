<?php

  $this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => ['controller' => 'Users', 'action' => 'registration']],
    ['title' => 'Login', 'url' => ['controller' => 'Users', 'action' => 'login']]
    ]);

  $this->Breadcrumbs->setTemplates([
      'wrapper' => '<nav aria-label="breadcrumb"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></nav>',
      'item' => '<li class="breadcrumb-item" {{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
    ]);

  echo $this->Breadcrumbs->render();

?>


<?= $this->Flash->render() ?>    
    <?= $this->Form->create() ?>    
    
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form>

                <legend><?= __('Please enter your email and password') ?></legend>

                  <div class="form-outline mb-4">
                    <?= $this->Form->control('email', ['required' => true]) ?>
                  </div>

                  <div class="form-outline mb-4">
                    <?= $this->Form->control('password', ['required' => true]) ?>                    
                  </div>

                  <div class="pt-1 mb-4">
                    <?= $this->Form->submit(__('Login')); ?>
                  </div>

                  <a class="small text-muted" href="forgotpassword">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f10;">Don't have an account? <a href="registration"
                      style="color: #393f81;">Register here</a></p>
                 
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->Form->end() ?>
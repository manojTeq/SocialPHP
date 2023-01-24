<?php

    $this->Breadcrumbs->add([
    ['title' => 'Home', 'url' => ['controller' => 'Users', 'action' => 'registration']],
    ['title' => 'Login', 'url' => ['controller' => 'Users', 'action' => 'login']],
    ['title' => 'ForgetPassword', 'url' => ['controller' => 'Users', 'action' => 'forgotpassword']]
    ]);

    $this->Breadcrumbs->setTemplates([
      'wrapper' => '<nav aria-label="breadcrumb"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></nav>',
      'item' => '<li class="breadcrumb-item" {{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>{{separator}}',
    ]);

    echo $this->Breadcrumbs->render();    

?>

<?php echo $this->Flash->render() ?>
<?= $this->Form->create() ?>
<?= $this->Form->control('email'); ?>
<?= $this->Form->submit() ?>
<?= $this->Form->end() ?>
<?php

    $this->Breadcrumbs->add([
      ['title' => 'Home', 'url' => ['controller' => 'Users', 'action' => 'registration']],
      // ['title' => 'Login', 'url' => ['controller' => 'Users', 'action' => 'login']]
      ]);

    $this->Breadcrumbs->setTemplates([
        'wrapper' => '<nav aria-label="breadcrumb"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></nav>',
      ]);

    echo $this->Breadcrumbs->render();
?>

<?= $this->Form->create($user, ['type'=>'file']); ?> 

  <!-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Library</a></li>
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item"><a href="#">login</></li>
    </ol>
  </nav> -->

            <div class="container">
              <h3 class="text-uppercase text-center mt-5 mb-5">Create an account</h3>              
              <div class="row col-sm-12">
                <div class="form-outline col-sm-6 mb-4">
                    <?php echo $this->Form->control('first_name',['id'=>'firstName', 'required' => false]); ?>
                    <span id="uname"></span>
                </div>

                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('last_name',['id'=>'lastName', 'required' => false]); ?>
                  <span id="luname"></span>
                  
                </div>
              </div>

              <div class="row col-sm-12">
                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('email',['id'=>'emailAddress','required' => false]); ?>
                  <span id="uemail"></span>
                </div>

                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('phone_number',['id'=>'phoneNumber','required' => false]); ?>
                  <span id="uphone"></span>
                </div>    
              </div>
                
              <div class="row col-sm-12">
                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('password', ['id'=>'password','required' => false]); ?>     
                  <span id="upass"></span>           
                </div>

                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('confirm_password', 
                  ['id'=>'cpassword', 'type'=>'password','required' => false]); ?>  
                  <span id="conupass"></span>                   
                </div>
                
              </div>
              
              <div class="row col-sm-12">
                <div class="form-outline col-sm-6 mb-4">
                  <?= $this->Form->control('profile.address'); ?>
                </div>
                <div class="form-outline col-sm-6 mb-4">
                  <?= $this->Form->control('skill.name'); ?>                
                </div>
              </div>              
              
              <div class="row col-sm-12">
                <div class="form-outline col-sm-6 mb-4">                  
                  <?php echo $this->Form->control('image_file',['type'=>'file' ,'required' => false]); ?>
                  <span id="uimage"></span>
                </div> 
                                    
                <div class="form-outline col-sm-6 mb-4 gender-category">          
                  <label>Gender:</label>     
                  <?php echo $this->Form->radio('gender',
                  ['Male' => ' Male ', 'Female' => ' Female ', 'other' => ' Other '],

                  ['required' => false]); ?>
                </div>
              </div>


                <div class="d-flex justify-content-center">
                  <span>                      
                    <?= $this->Form->button(__('Submit'),['id'=>'submit']) ?>                    
                  </span>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login"
                    class="fw-bold text-body"><u>Login here</u></a></p>                            
            </div>          
    
</body>
</html>
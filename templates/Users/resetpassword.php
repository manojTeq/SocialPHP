<?php echo $this->Flash->render() ?>
<?= $this->Form->create() ?>
<?= $this->Form->control('password'); ?>
<?= $this->Form->submit() ?>
<!-- <p class="text-center text-muted mt-5 mb-0">Go to login page <a href="login"
        class="fw-bold text-body"><u>Login here</u></a></p> -->

    <!-- <a href="login" class="text-center text-muted mt-5 mb-0"> Go to login page --</a> -->
<?= $this->Form->end() ?>

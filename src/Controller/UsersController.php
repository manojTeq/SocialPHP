<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
// use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

        public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // $this->loadModel('Profiles');
        // $this->loadModel('Skills');
        // $this->loadModel('Model3');
        // ...
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users, ['contain'=>['Profiles']]);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    //* ----Registration method-------//

    public function registration(){


        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!$user->getError){

            $image = $this->request->getData('image_file');

            // debug($image);
            // exit;
            
            $name = $image->getClientFilename();
            $targetPath = WWW_ROOT ."img/".$name;
            if($name)
                $image->moveTo($targetPath);

                $user->image = $name;            
            }                


            if ($this->Users->save($user)) {
                $this->Flash->success(__('The User has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The User could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));                                
    }

    //* ----Login method-------//

    public function login()
        {
            $this->request->allowMethod(['get','post']);
            $result = $this->Authentication->getResult();    
            if ($result->isValid()) {            
                return $this->redirect(['controller'=>'Users', 'action'=>'index']);
            }
            // display error if user submitted and authentication failed
            if ($this->request->is('post') && !$result->isValid()) {
                $this->Flash->error(__('Invalid username or password'));
                // $this->request->is('post');
            }                
        }

    //* ----Logout method-------//

    public function logout()
    {
        $result = $this->Authentication->getResult();        
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function forgotpassword()
    {
        if ($this->request->is('post')) {
                $email = $this->request->getData('email');
                $token = Security::hash(Security::randomBytes(25));
                
                $userTable = TableRegistry::get('Users');
                    if ($email == NULL) {
                        $this->Flash->error(__('Please insert your email address')); 
                    } 
                    if	($user = $userTable->find('all')->where(['email'=>$email])->first()) { 
                        $user->token = $token;
                        if ($userTable->save($user)){
                            $mailer = new Mailer('default');
                            $mailer->setTransport('gmail');
                            $mailer->setFrom(['manojkumaryadav7889@gmail.com' => 'manoj'])
                            ->setTo($email)
                            ->setEmailFormat('html')
                            ->setSubject('Forgot Password Request')
                            ->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="http://localhost:8765/users/resetpassword/'.$token.'">Reset Password</a>');
                        }
                        $this->Flash->success('Reset password link has been sent to your email ('.$email.'), please check your email');
                    }
                    if	($total = $userTable->find('all')->where(['email'=>$email])->count()==0) {
                        $this->Flash->error(__('Email is not registered in system'));
                    }
            }
    }


    public function resetpassword($token)
        {
            if($this->request->is('post')){                
                $newPass = $this->request->getData('password');
                
                $userTable = TableRegistry::get('Users');
                $user = $userTable->find('all')->where(['token'=>$token])->first();
                $user->password = $newPass;
                // $user->token = '';
                if ($userTable->save($user)) {
                    $this->Flash->success('Password successfully reset. Please login using your new password');
                    return $this->redirect(['action'=>'login']);
                }
            }
        }                  
    
}

<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            
            [['username'], 'required','message' => 'Por favor complete el nombre de usuario.'],
            [['password'], 'required','message' => 'Por favor complete la contraseña.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors[] = [
             'class' => '\giannisdag\yii2CheckLoginAttempts\behaviors\LoginAttemptBehavior',
            
            // Amount of attempts in the given time period
            'attempts' => 3,
            
            // the duration, in seconds, for a regular failure to be stored for
            // resets on new failure
            'duration' => 300,
            
            // the duration, in seconds, to disable login after exceeding `attemps`
            'disableDuration' => 900,
            
            // the attribute used as the key in the database
            // and add errors to
            'usernameAttribute' => 'username',
            
            // the attribute to check for errors
            'passwordAttribute' => 'password',
            
            // the validation message to return to `usernameAttribute`
            'message' => Yii::t('app', 'Su cuenta ha sido bloqueda temporalmente por motivos de seguridadf'),
        ];
        
        return $behaviors;
}

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'El usuario o la contraseña no son correctos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}

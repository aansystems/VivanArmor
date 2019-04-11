<?php
namespace frontend\models;
use yii\bootstrap\ActiveForm;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class MatchForm extends Model
{
    public $question;
    public $answer1;
    public $answer2;
    public $answer3;
    public $answer4;
    public $answer5;
     public $i;


    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['answer1','answer2','answer3','answer4','answer5'], 'required'],
            
            // answer is validated by validateAnswer()
            ['answer[i]', 'validateAnswer'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateanswer($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->answer)) {
                $this->addError($attribute, 'Incorrect answer');
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
            return Yii::$app->user->login($this->getUser(), $this->keepMeLoggedIn ? 3600 * 24 * 30 : 0);
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
            // $this->_user = User::findByEmail($this->email);
            $this->_user = Yii::$app->user->identity->id;
        }

        return $this->_user;
    }

    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}

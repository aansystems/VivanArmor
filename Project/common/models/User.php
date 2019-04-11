<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $old_password;
    public $new_password;
    public $confirm_password;
    //public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_code;
    public $phone;
    public $created_by;
    public $update_by;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
                //TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['old_password', 'required'],
            ['new_password', 'required'],
            ['new_password', 'string', 'length' => [6, 18], 'message' => "New Password should be in 6-18 characters"],
            ['confirm_password', 'string', 'length' => [6, 18], 'message' => "Confirm Password should be in 6-18 characters"],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => "Passwords doesn't match"],
            ['confirm_password', 'safe'],
            ['confirm_password', 'required'],
            ['phone_code', 'required'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    //public static function findByUsername($username)
    //{
    //   return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    // }
    public static function findByEmail($email) {
        $user = User::find()->where(['email' => $email])->one();
        return $user;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "keep me login" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public function randomCode($length) {

        $alphabets = range('A', 'Z');
        $numbers = range('0', '9');

        $final_array = array_merge($alphabets, $numbers);

        $accesscode = '';

        while ($length--) {
            $key = array_rand($final_array);
            $accesscode .= $final_array[$key];
        }

        return $accesscode;
    }

    public function getUsers() {
        return $this->_user;
    }

    public function setUser($user) {
        if ($user instanceof User) {
            $this->_user = $user;
        } else if (is_array($user)) {
            $this->_user->setAttributes($user);
        }
    }

    /**
     * phone validations
     * @param type $phone
     */
}

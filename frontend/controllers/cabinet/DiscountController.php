<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 27.10.17
 * Time: 16:57
 */

namespace frontend\controllers\cabinet;

use core\useCases\cabinet\ProfileService;
use yii\web\Controller;
use yii\filters\AccessControl;
use core\entities\User\User;
use yii\web\NotFoundHttpException;
use Yii;

class DiscountController extends Controller
{
    private $profileService;
    public $layout = 'cabinet';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function __construct($id, $module, ProfileService $profileService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->profileService = $profileService;
    }

    public function actionIndex()
    {
        $user = $this->findModel(Yii::$app->user->id);

        return $this->render('index', []);
    }

    public function actionPreposition()
    {
        $user = $this->findModel(Yii::$app->user->id);

        return $this->render('preposition', []);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
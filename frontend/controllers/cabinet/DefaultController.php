<?php

namespace frontend\controllers\cabinet;

use yii\web\Controller;
use yii\filters\AccessControl;
use core\useCases\cabinet\ProfileService;
use core\forms\User\ProfileEditForm;
use core\entities\User\User;
use yii\web\NotFoundHttpException;
use Yii;

class DefaultController extends Controller
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

    /**
     * This method index has functions of Profile Controller
     * and let users to edit their profile information
     * @return mixed
     */
    public function actionIndex()
    {
        $user = $this->findModel(Yii::$app->user->id);

        $form = new ProfileEditForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($user->id, $form);
                return $this->redirect(['/cabinet/default/index', 'id' => $user->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('index', [
            'model' => $form,
            'user' => $user,
        ]);
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
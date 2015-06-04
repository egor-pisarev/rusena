<?php
namespace app\modules\news\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\easyii\modules\page\models\Page;
use yii\web\HttpException;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;

use yii\easyii\components\Controller;
use app\modules\news\models\News;
use yii\easyii\helpers\Image;
use yii\easyii\behaviors\StatusController;
use app\modules\user\models\User;
use yii\easyii\models\Setting;
use yii\bootstrap\Html;

class AController extends \yii\easyii\components\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => StatusController::className(),
                'model' => News::className()
            ]
        ];
    }

    public function actionIndex()
    {
        $data = new ActiveDataProvider([
            'query' => News::find()->desc(),
        ]);

        return $this->render('index', [
            'data' => $data
        ]);
    }

    public function actionCreate()
    {
        $model = new News;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES) && $this->module->settings['enableThumb']){
                    $model->thumb = UploadedFile::getInstance($model, 'thumb');
                    if($model->thumb && $model->validate(['thumb'])){
                        $model->thumb = Image::upload($model->thumb, 'news', $this->module->settings['thumbWidth'], $this->module->settings['thumbHeight'], $this->module->settings['thumbCrop']);
                    }
                    else{
                        $model->thumb = '';
                    }
                }
                $model->status = News::STATUS_ON;

                if($model->save()){
                    $this->flash('success', Yii::t('news', 'News created'));
                    return $this->redirect(['/admin/protectednews']);
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Create error. {0}', $model->formatErrors()));
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    public function actionEdit($id)
    {
        $model = News::findOne($id);
        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/protectednews']);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES) && $this->module->settings['enableThumb']){
                    $model->thumb = UploadedFile::getInstance($model, 'thumb');
                    if($model->thumb && $model->validate(['thumb'])){
                        $model->thumb = Image::upload($model->thumb, 'news', $this->module->settings['thumbWidth'], $this->module->settings['thumbHeight'], $this->module->settings['thumbCrop']);
                    }
                    else{
                        $model->thumb = $model->oldAttributes['thumb'];
                    }
                }

                if($model->save()){
                    $this->flash('success', Yii::t('news', 'News updated'));
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model
            ]);
        }
    }

    public function actionDelete($id)
    {
        if(($model = News::findOne($id))){
            $model->delete();
        } else{
            $this->error = Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse(Yii::t('news', 'News deleted'));
    }

    public function actionClearImage($id)
    {
        $model = News::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        else{
            $model->thumb = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->thumb);
                $this->flash('success', Yii::t('news', 'News image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    public function actionOn($id)
    {
        return $this->changeStatus($id, News::STATUS_ON);
    }

    public function actionOff($id)
    {
        return $this->changeStatus($id, News::STATUS_OFF);
    }

    public function actionSendMails($id)
    {
        $page = Page::find()->where(['slug'=>'news-email'])->one();
        if(!$page){
            $this->flash('error', 'Не найдена страница с slug "news-email". Для отправки сообщений необходимо создать страницу в разделе "Страницы".
            В поле Текст необходимо написать текст письма. В тексте можно использовать заменители: <br>
             {{user.username}}<br>
            {{user.name}}<br>
            {{news.titleLink}}<br>
            {{news.readMoreLink}}<br>
            {{news.short}}<br>
            ');
            return $this->redirect(['/admin/protectednews']);
        }

        $model = News::findOne($id);
        if(!$model){
            throw new HttpException(404);
        }

        $sentCount = 0;
        $totalCount = 0;
        foreach(User::findAll(['blocked_at'=>null]) as $user){
            $totalCount++;
            if($this->_sendEmail($user, $model, $page)){
                $sentCount++;
            }
        }

        $this->flash('success', 'Отправлено '.$sentCount.' сообщений из '.$totalCount);
        return $this->redirect(['/admin/protectednews']);
    }

    protected function _sendEmail($user, $news, $page)
    {

        $placeholders = [
            '{{user.username}}'=>$user->username,
            '{{user.name}}'=>$user->profile->name,
            '{{news.titleLink}}'=>Html::a($news->title,['/site/news','slug'=>$news->slug]),
            '{{news.readMoreLink}}'=>Html::a('Читать подробнее',['/site/news','slug'=>$news->slug]),
            '{{news.short}}'=>$news->short
        ];

        $text = str_replace(array_keys($placeholders),$placeholders,$page->text);

        $sent = Yii::$app->mailer->compose()
            ->setHtmlBody($text)
            ->setFrom(Setting::get('robot_email'))
            ->setTo($user->email)
            ->setSubject(strtoupper(Yii::$app->request->serverName).' Добавлена новость на сайте')
            ->setReplyTo(Setting::get('admin_email'))
            ->send();

        return $sent;

    }
}
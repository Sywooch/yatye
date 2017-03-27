<?php

namespace backend\controllers;



use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\Helpers\FacebookRedirectLoginHelper;
use Facebook\GraphNodes\GraphUser;
use backend\components\AdminController as BackendAdminController;
class FacebookController extends BackendAdminController
{
    public function actionIndex()
    {
//        /* PHP SDK v5.0.0 */
//        /* make the API call */
//        $request = new FacebookRequest(
//            $session,
//            'GET',
//            '/{user-id}/events'
//        );
//        $response = $request->execute();
//        $graphObject = $response->getGraphObject();
//        /* handle the result */
        return $this->render('index');
    }

}

<?php

namespace uzdevid\HeaderChecker;

use Yii;
use yii\base\Behavior;
use yii\base\Controller as ControllerAlias;
use yii\web\BadRequestHttpException;

class HeaderCheckerFilter extends Behavior {
    public array $actions = [];

    public function events(): array {
        return [ControllerAlias::EVENT_BEFORE_ACTION => 'beforeAction'];
    }

    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($event): bool {
        $actionId = $event->action->id;

        $missingHeaders = [];

        if (isset($this->actions[$actionId])) {
            foreach ($this->actions[$actionId] as $header) {
                if (!Yii::$app->request->headers->has($header)) {
                    $missingHeaders[] = $header;
                }
            }
        }

        if (!empty($missingHeaders)) {
            $stringNames = implode(', ', $missingHeaders);
            throw new BadRequestHttpException("Missing required headers '$stringNames' for this action");
        }

        return true;
    }
}

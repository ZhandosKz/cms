<?php
class ContentUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route == 'content/view' && isset($params['url']))
        {
            return $params['url'];
        }
        return FALSE;
    }
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        if (preg_match('%^(\w+)%', $pathInfo, $matches))
        {
            $content = Content::model()->find('url = :url AND published = :published', array(':url' => $matches[1], ':published' => TRUE));

            if (!$content instanceof Content)
            {
                return FALSE;
            }
            $_GET['url'] = $content->url;
            return 'content/view';
        }
        return FALSE;
    }
}
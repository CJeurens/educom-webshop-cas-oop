<?php 
class PageController
{
    private $request;
    private $response;
    private $val_data;
    
    public function handleRequest()
    {
        $this->getRequest();
        $this->validateRequest();
        $this->showResponse();
    }
    
    private function getRequest()
    {
        $posted = ($_SERVER['REQUEST_METHOD']==='POST');
        $this->request = 
            [
                'posted' => $posted,
                'page'   => $this->getRequestVar('page', $posted, 'home')    
            ];
    }
    
    private function validateRequest()
    {
        $this->response = $this->request; // getoond == gevraagd
        $this->val_data = $val_data = "";
        if ($this->request['posted'])
        {
            switch ($this->request['page'])
            {
                case "contact":
                    $fields = array("name", "email", "msg");

                    require_once "DataSanitizer.php";
                    $sanitize = new DataSanitizer;

                    require_once "PostRetriever.php";
                    $post = new PostRetriever($fields, $sanitize);
                    $san_data = $post->retrieve();

                    require_once "Validator.php";
                    $validate = new Validator($san_data);   //valid of invalid
                    $this->val_data = $validate->validate();
                    break;

                case "login":
                    $fields = array("email", "password");

                    require_once "DataSanitizer.php";
                    $sanitize = new DataSanitizer;

                    require_once "PostRetriever.php";
                    $post = new PostRetriever($fields, $sanitize);
                    $san_data = $post->retrieve();

                    require_once "Validator.php";
                    $validate = new Validator($san_data);
                    $this->val_data = $validate->validate();

                    require_once "UserManager.php";
                    $user = new UserManager($this->val_data);
                    $username = $user->loginChecker();
                    $username = empty($username) ? "" : $username;
                    foreach ($this->val_data as $key => $value)
                    {
                        if(isset($user->errors[$key]))
                        {
                            $this->val_data[$key]["error"] = $user->errors[$key];
                        }
                    }

                    require_once "SessionManager.php";
                    $session = new SessionManager;
                    $session->doLoginSession($username);

                    //$this->request['page'] = "home";
                    //$this->request = $_SESSION["prev_page"];

                    //redirect
                    break;

                case "register":
                    $fields = array("email", "username", "password", "rpassword");

                    require_once "DataSanitizer.php";
                    $sanitize = new DataSanitizer;

                    require_once "PostRetriever.php";
                    $post = new PostRetriever($fields, $sanitize);
                    $san_data = $post->retrieve();

                    require_once "Validator.php";
                    $validate = new Validator($san_data);
                    $this->val_data = $validate->validate();

                    require_once "UserManager.php";
                    $user = new UserManager($this->val_data);
                    $username = $user->registerChecker();
                    $username = empty($username) ? "" : $username;
                    foreach ($this->val_data as $key => $value)
                    {
                        if(isset($user->errors[$key]))
                        {
                            $this->val_data[$key]["error"] = $user->errors[$key];
                        }
                    }

                    require_once "SessionManager.php";
                    $session = new SessionManager;
                    $session->doLoginSession($username);

                    //redirect
                    break;
                case "logout":
                    $this->request['page'] = ($this->getRequestVar("page", FALSE, "home") == "cart") ? "home" : $this->getRequestVar("page", FALSE, "home");

                    require_once "SessionManager.php";
                    $session = new SessionManager;
                    $session->doLogoutSession();
                    break;
            }
        }
        else
        {
            switch ($this->request['page'])
            {
            // get request afhandelingen die meerdere antwoorden kunnen genereren....
            // zie uitleg Request-Response overview
            }
        }
    }
    
    private function showResponse()
    {
        require_once "PageModel.php";
        $model = new PageModel();
        $content = $model->getPageContent($this->request);

        if (!empty($this->val_data))
        {
            foreach ($this->val_data as $field=>$value)
            {
                $content["fields"][$field] = array_merge($content["fields"][$field],$this->val_data[$field]);
            }
        }

        if ($content)
        {
            require_once "PageView.php";
            $view = new PageView;
            $view->displayPage($content);
        }

        $_SESSION["prev_page"]=$_GET;
    }
    
    private function getRequestVar(string $key, bool $frompost, $default="", bool $asnumber=FALSE)
    {
        $filter = $asnumber ? FILTER_SANITIZE_NUMBER_FLOAT : FILTER_SANITIZE_STRING;
        $result = filter_input(($frompost ? INPUT_POST : INPUT_GET), $key, $filter);
        return ($result===FALSE) ? $default : $result;
    }  
}    
?>
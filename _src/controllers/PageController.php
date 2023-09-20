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
            require_once "_src/tools/DataSanitizer.php";
            $sanitize = new DataSanitizer;

            require_once "_src/tools/PostRetriever.php";
            $post = new PostRetriever($sanitize);
            
            require_once "_src/tools/Validator.php";
            $validate = new Validator();

            switch ($this->request['page'])
            {
                case "contact":
                    $fields = array("name", "email", "msg");
                    $san_data = $post->retrieve($fields);
                    $this->val_data = $validate->validate($san_data);
                    break;

                case "login":
                    $fields = array("email", "password");
                    $san_data = $post->retrieve($fields);
                    $this->val_data = $validate->validate($san_data);

                    require_once "_src/dal/UserManager.php";
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

                    require_once "_src/dal/SessionManager.php";
                    $session = new SessionManager;
                    $session->doLoginSession($username);

                    require_once "_src/tools/GetRetriever.php";
                    $get = new GetRetriever($sanitize);
                    $get_info = $get->get();

                    //$this->request['page'] = isset($get_info["referral"]) ? $get_info["referral"] : "home";
                    //$this->validateRequest();   //submit en valideert ook meteen contactform als referral = contact
                    break;

                case "register":
                    $fields = array("email", "username", "password", "rpassword");
                    $san_data = $post->retrieve($fields);
                    $this->val_data = $validate->validate($san_data);

                    require_once "_src/dal/UserManager.php";
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

                    require_once "_src/dal/SessionManager.php";
                    $session = new SessionManager;
                    $session->doLoginSession($username);

                    //$this->request['page'] = "home";
                    //$this->validateRequest();
                    break;
                case "logout":
                    $this->request['page'] = ($this->getRequestVar("page", FALSE, "home") == "cart") ? "home" : $this->getRequestVar("page", FALSE, "home");

                    require_once "_src/dal/SessionManager.php";
                    $session = new SessionManager;
                    $session->doLogoutSession();
                    break;
            }

        }
        else
        {
            switch ($this->request['page'])
            {
                case "shop":
                    if(isset($_GET["product"]))
                    {
                        //$content
                    }
                    break;

            // get request afhandelingen die meerdere antwoorden kunnen genereren....
            // zie uitleg Request-Response overview
            }
        }
    }
    
    private function showResponse()
    {
        require_once "_src/models/PageModel.php";
        $model = new PageModel();
        $content = $model->getPageContent($this->request);

        if (!empty($this->val_data))    //TODO: check of val_data ook hoort bij page die getoond moet worden
        {                               
            foreach ($this->val_data as $field=>$value)
            {
                $content["fields"][$field] = array_merge($content["fields"][$field],$this->val_data[$field]);
            }
        }

        if ($content)
        {
            require_once "_src/views/PageView.php";
            $view = new PageView;
            $view->displayPage($content);
        }
    }
    
    private function getRequestVar(string $key, bool $frompost, $default="", bool $asnumber=FALSE)
    {
        $filter = $asnumber ? FILTER_SANITIZE_NUMBER_FLOAT : FILTER_SANITIZE_STRING;
        $result = filter_input(($frompost ? INPUT_POST : INPUT_GET), $key, $filter);
        return ($result===FALSE) ? $default : $result;
    }  
}    
?>